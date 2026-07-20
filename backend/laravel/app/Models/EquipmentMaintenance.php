<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentMaintenance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'equipment_id',
        'maintenance_type_id',
        'performed_by',
        'scheduled_at',
        'performed_at',
        'notes',
        'cost',
        'next_due_at',
        'created_by',
    ];

    protected $casts = [
        'performed_by' => 'integer',
        'scheduled_at' => 'datetime',
        'performed_at' => 'datetime',
        'cost' => 'decimal:2',
        'next_due_at' => 'datetime',
        'created_by' => 'integer',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function type()
    {
        return $this->belongsTo(MaintenanceType::class, 'maintenance_type_id');
    }

    public function performer()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeUpcoming($query)
    {
        return $query->whereNotNull('next_due_at')->where('next_due_at', '>', now());
    }
}
