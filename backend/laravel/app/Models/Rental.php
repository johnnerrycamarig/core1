<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Rental extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    protected $fillable = [
        'rental_number',
        'client_id',
        'project_id',
        'created_by',
        'start_date',
        'end_date',
        'status_id',
        'total_amount',
        'notes',
    ];

    protected $casts = [
        'client_id' => 'string',
        'project_id' => 'string',
        'created_by' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'status_id' => 'integer',
        'total_amount' => 'decimal:2',
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

    public function status()
    {
        return $this->belongsTo(RentalStatus::class, 'status_id');
    }

    public function equipment()
    {
        return $this->hasMany(RentalEquipment::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function scopeActive($query)
    {
        return $query->whereHas('status', fn ($query) => $query->where('code', 'active'));
    }

    public function getDurationAttribute(): ?int
    {
        if ($this->start_date instanceof Carbon && $this->end_date instanceof Carbon) {
            return $this->end_date->diffInDays($this->start_date);
        }

        return null;
    }
}
