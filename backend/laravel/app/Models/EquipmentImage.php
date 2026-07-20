<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentImage extends Model
{
    use HasUuid, HasFactory;

    protected $fillable = [
        'equipment_id',
        'filename',
        'path',
        'mime_type',
        'size',
        'is_primary',
    ];

    protected $casts = [
        'size' => 'integer',
        'is_primary' => 'boolean',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
