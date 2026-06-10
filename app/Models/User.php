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

    /**
     * Génère un identifiant unique au format "Prénom.Nom".
     * En cas de doublon, suffixe incrémental : Prénom.Nom1, Prénom.Nom2, ...
     */
    public static function generateUsername(string $prenom, string $nom): string
    {
        $cap = fn (string $s) => mb_strtoupper(mb_substr($s, 0, 1)) . mb_substr($s, 1);

        $prenom = $cap(trim($prenom));
        $nom    = $cap(trim($nom));

        $base = $prenom . '.' . $nom;

        if (!self::where('username', $base)->exists()) {
            return $base;
        }

        $i = 1;
        while (self::where('username', $base . $i)->exists()) {
            $i++;
        }

        return $base . $i;
    }
}