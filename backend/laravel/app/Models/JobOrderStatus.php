<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'label',
    ];

    public function orders()
    {
        return $this->hasMany(JobOrder::class, 'status_id');
    }
}
