<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'mfa_enabled',
        'mfa_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'mfa_code',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mfa_enabled' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class, 'created_by');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'created_by');
    }

    public function createdProjects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasRole(string $role): bool
    {
        return $this->roles->contains('name', $role);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }
}
