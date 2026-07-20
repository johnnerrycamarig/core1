<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTask extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'parent_task_id',
        'title',
        'description',
        'assigned_to',
        'status_id',
        'priority',
        'due_date',
        'started_at',
        'completed_at',
        'created_by',
    ];

    protected $casts = [
        'project_id' => 'string',
        'parent_task_id' => 'string',
        'assigned_to' => 'integer',
        'status_id' => 'integer',
        'priority' => 'integer',
        'due_date' => 'date',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'created_by' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function parent()
    {
        return $this->belongsTo(ProjectTask::class, 'parent_task_id');
    }

    public function children()
    {
        return $this->hasMany(ProjectTask::class, 'parent_task_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeOverdue($query)
    {
        return $query->whereNotNull('due_date')->where('due_date', '<', now());
    }

    public function getIsCompleteAttribute(): bool
    {
        return $this->status && $this->status->code === 'done';
    }
}
