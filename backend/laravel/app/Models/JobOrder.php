<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrder extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number',
        'client_id',
        'project_id',
        'created_by',
        'scheduled_at',
        'status_id',
        'total_amount',
        'notes',
    ];

    protected $casts = [
        'client_id' => 'string',
        'project_id' => 'string',
        'created_by' => 'integer',
        'scheduled_at' => 'datetime',
        'status_id' => 'integer',
        'total_amount' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status()
    {
        return $this->belongsTo(JobOrderStatus::class, 'status_id');
    }

    public function equipment()
    {
        return $this->hasMany(JobOrderEquipment::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function scopeOpen($query)
    {
        return $query->whereHas('status', fn ($query) => $query->where('code', 'open'));
    }

    public function getIsScheduledAttribute(): bool
    {
        return ! is_null($this->scheduled_at);
    }
}
