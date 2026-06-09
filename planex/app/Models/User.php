<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'temp_password',
        'temp_password_expires_at',
        'must_change_password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password'                 => 'hashed',
            'temp_password_expires_at' => 'datetime',
            'must_change_password'     => 'boolean',
        ];
    }

    /** Le mot de passe provisoire a-t-il expiré ? */
    public function tempPasswordExpired(): bool
    {
        return $this->temp_password_expires_at !== null
            && $this->temp_password_expires_at->isPast();
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isIncident()
    {
        return $this->role === 'incident';
    }

    public function chantiers()
    {
        return $this->belongsToMany(Chantier::class, 'chantier_user')
                    ->withPivot('role_chantier', 'is_creator')
                    ->withTimestamps();
    }
}