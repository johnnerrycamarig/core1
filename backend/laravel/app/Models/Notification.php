<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasUuid, HasFactory;

    protected $fillable = [
        'recipient_id',
        'actor_id',
        'verb',
        'target_type',
        'target_id',
        'data',
        'read_at',
        'sent_at',
    ];

    protected $casts = [
        'recipient_id' => 'integer',
        'actor_id' => 'integer',
        'data' => 'array',
        'read_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function target()
    {
        return $this->morphTo();
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
