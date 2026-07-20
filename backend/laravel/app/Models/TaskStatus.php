<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'label',
    ];

    public function projectTasks()
    {
        return $this->hasMany(ProjectTask::class, 'status_id');
    }
}
