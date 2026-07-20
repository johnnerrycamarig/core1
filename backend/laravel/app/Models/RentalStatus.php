<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'label',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'status_id');
    }
}
