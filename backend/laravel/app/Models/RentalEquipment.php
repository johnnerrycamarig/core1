<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'equipment_id',
        'quantity',
        'rate',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'rate' => 'decimal:2',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
