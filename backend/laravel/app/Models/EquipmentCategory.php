<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentCategory extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'category_id');
    }
}
