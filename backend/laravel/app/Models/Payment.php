<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'paymentable_type',
        'paymentable_id',
        'amount',
        'method_id',
        'paid_at',
        'created_by',
        'notes',
    ];

    protected $casts = [
        'paymentable_id' => 'string',
        'amount' => 'decimal:2',
        'method_id' => 'integer',
        'paid_at' => 'datetime',
        'created_by' => 'integer',
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'method_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeRecent($query)
    {
        return $query->orderByDesc('paid_at');
    }
}
