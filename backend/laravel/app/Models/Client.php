<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    protected $fillable = [
        'client_type_id',
        'name',
        'company_name',
        'contact_person',
        'phone',
        'mobile',
        'tin',
        'email',
        'address',
        'notes',
    ];

    protected $casts = [
        'client_type_id' => 'integer',
    ];

    public function type()
    {
        return $this->belongsTo(ClientType::class, 'client_type_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function scopeCompanies($query)
    {
        return $query->whereHas('type', function ($query) {
            $query->where('code', 'company');
        });
    }

    public function scopeIndividuals($query)
    {
        return $query->whereHas('type', function ($query) {
            $query->where('code', 'individual');
        });
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->company_name ?: $this->name;
    }
}
