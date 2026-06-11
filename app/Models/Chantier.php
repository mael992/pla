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

    /** Disciplines attribuables (ROLES sans le chef de chantier). */
    public const DISCIPLINES = [
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

    public function disciplines()
    {
        return $this->hasMany(ChantierDiscipline::class, 'chantier_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chantier_user')
                    ->withPivot('role_chantier', 'is_creator', 'chantier_discipline_id')
                    ->withTimestamps();
    }

    public function creator()
    {
        return $this->users()->wherePivot('is_creator', true)->first();
    }

    /**
     * Couples discipline/entreprise du chantier, avec un libellé numéroté
     * lorsqu'une même discipline a plusieurs entreprises (VRD 1, VRD 2...).
     * Retourne un tableau d'objets {id, discipline, discipline_label, entreprise, label}.
     */
    public function disciplineOptions()
    {
        $couples = $this->disciplines()
            ->orderBy('discipline')
            ->orderBy('id')
            ->get();

        $countByDiscipline = $couples->groupBy('discipline')->map->count();
        $seen = [];

        return $couples->map(function ($c) use ($countByDiscipline, &$seen) {
            $base = self::DISCIPLINES[$c->discipline] ?? $c->discipline;

            $label = $base;
            if (($countByDiscipline[$c->discipline] ?? 1) > 1) {
                $seen[$c->discipline] = ($seen[$c->discipline] ?? 0) + 1;
                $label = $base . ' ' . $seen[$c->discipline];
            }

            return (object) [
                'id'               => $c->id,
                'discipline'       => $c->discipline,
                'discipline_label' => $base,
                'entreprise'       => $c->entreprise,
                'label'            => $label,
            ];
        });
    }
}
