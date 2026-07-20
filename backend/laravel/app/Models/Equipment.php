<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'serial_number',
        'description',
        'status_id',
        'hourly_rate',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'purchased_at',
        'warranty_expires',
    ];

    protected $casts = [
        'category_id' => 'string',
        'status_id' => 'integer',
        'hourly_rate' => 'decimal:2',
        'daily_rate' => 'decimal:2',
        'weekly_rate' => 'decimal:2',
        'monthly_rate' => 'decimal:2',
        'purchased_at' => 'date',
        'warranty_expires' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(EquipmentCategory::class, 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(EquipmentStatus::class, 'status_id');
    }

    public function images()
    {
        return $this->hasMany(EquipmentImage::class);
    }

    public function maintenanceRecords()
    {
        return $this->hasMany(EquipmentMaintenance::class);
    }

    public function jobOrderEquipment()
    {
        return $this->hasMany(JobOrderEquipment::class);
    }

    public function rentalEquipment()
    {
        return $this->hasMany(RentalEquipment::class);
    }

    public function scopeAvailable($query)
    {
        return $query->whereHas('status', fn ($query) => $query->where('code', 'available'));
    }

    public function getPrimaryImageUrlAttribute(): ?string
    {
        return $this->images()->where('is_primary', true)->value('path');
    }
}
