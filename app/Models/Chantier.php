<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    protected $fillable = ['nom', 'localite'];

    public const ROLES = [
        'chef_chantier'        => 'Chef Chantier',
        'vrd'                  => 'VRD',
        'genie_civil'          => 'Génie civil',
        'structure_metallique' => 'Structure métallique',
        'structure_batiment'   => 'Structure bâtiment',
        'equipement'           => 'Équipement',
        'tuyauterie'           => 'Tuyauterie',
        'calorifuge'           => 'Calorifuge',
        'electricite'          => 'Électricité',
        'instrumentation'      => 'Instrumentation',
        'automatisme'          => 'Automatisme',
    ];

    public function incidents()
    {
        return $this->hasMany(Incident::class, 'chantier_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chantier_user')
                    ->withPivot('role_chantier', 'is_creator')
                    ->withTimestamps();
    }

    public function creator()
    {
        return $this->users()->wherePivot('is_creator', true)->first();
    }
}
