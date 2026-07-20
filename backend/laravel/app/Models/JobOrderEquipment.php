<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_order_id',
        'equipment_id',
        'quantity',
        'rate',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'rate' => 'decimal:2',
    ];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
