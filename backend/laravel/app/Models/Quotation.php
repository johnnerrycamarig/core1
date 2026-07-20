<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Quotation extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    protected $fillable = [
        'quotation_number',
        'client_id',
        'project_id',
        'total_amount',
        'valid_until',
        'created_by',
        'notes',
    ];

    protected $casts = [
        'client_id' => 'string',
        'project_id' => 'string',
        'total_amount' => 'decimal:2',
        'valid_until' => 'date',
        'created_by' => 'integer',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function getIsValidAttribute(): bool
    {
        if (! $this->valid_until) {
            return true;
        }

        return $this->asDateTime('valid_until')->isFuture();
    }
}
