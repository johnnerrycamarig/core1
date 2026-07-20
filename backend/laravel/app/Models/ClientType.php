<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'label',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
