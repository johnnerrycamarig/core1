<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'client_id',
        'invoiceable_type',
        'invoiceable_id',
        'amount_due',
        'amount_paid',
        'due_date',
        'issued_at',
        'status_id',
        'created_by',
        'notes',
    ];

    protected $casts = [
        'client_id' => 'string',
        'invoiceable_id' => 'string',
        'amount_due' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'due_date' => 'date',
        'issued_at' => 'datetime',
        'status_id' => 'integer',
        'created_by' => 'integer',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(InvoiceStatus::class, 'status_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoiceable()
    {
        return $this->morphTo();
    }

    public function getBalanceAttribute(): float
    {
        return (float) $this->amount_due - (float) $this->amount_paid;
    }
}
