<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'label',
    ];

    public function maintenanceRecords()
    {
        return $this->hasMany(EquipmentMaintenance::class, 'maintenance_type_id');
    }
}
