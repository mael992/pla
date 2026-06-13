<?php

namespace App\Models;

use App\Models\Chantier;
use App\Models\Concerns\HasReference;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasReference;

    protected $primaryKey = 'id_incident';
    public $incrementing  = true;
    protected $keyType    = 'int';
    public $timestamps    = false;

    protected $fillable = [
        'reference',
        'date_emis', 'photo_ouverte', 'photo_fermee', 'date_maj',
        'date_cloture', 'discipline', 'systeme', 'lot_travail',
        'zone_id', 'chantier_id', 'etiquette', 'description', 'categorie',
        'interne', 'statut', 'responsabilite', 'emis_par',
        'qfc_ouvert', 'qfc_ferme', 'cloture_prevue',
    ];

    public function zoneObj()
    {
        return $this->belongsTo(Zone::class, 'zone_id', 'id');
    }

    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'chantier_id');
    }

    public const CATEGORIES = [
        'A' => 'A — Avant Pre-commissioning',
        'B' => 'B — Avant la Mechanical Completion',
        'C' => 'C — Après la Mechanical Completion',
        'D' => 'D — Après la Mise en route',
    ];

    public function getCategorieLabelAttribute()
    {
        return self::CATEGORIES[$this->categorie] ?? $this->categorie;
    }

    /**
     * Limite la requête aux incidents visibles par un utilisateur.
     *
     * Règles :
     *  - admin                          → tout
     *  - chef de chantier / créateur    → tous les incidents de SES chantiers
     *  - membre rattaché à une discipline → uniquement les incidents de cette
     *    discipline (corps de métier) sur les chantiers où il est membre.
     *    Ex : un VRD ne voit pas le Génie civil, et inversement.
     */
    public function scopeVisibleTo($query, $user)
    {
        if ($user->isAdmin()) {
            return $query;
        }

        $fullIds   = [];   // chantiers où l'user voit tout (chef / créateur)
        $byChantier = [];  // chantier_id => [libellés de disciplines autorisés]

        foreach ($user->chantiers()->get() as $ch) {
            $pivot = $ch->pivot;
            if ($pivot->role_chantier === 'chef_chantier' || $pivot->is_creator) {
                $fullIds[] = $ch->id;
            } else {
                $label = Chantier::DISCIPLINES[$pivot->role_chantier] ?? $pivot->role_chantier;
                $byChantier[$ch->id][] = $label;
            }
        }

        return $query->where(function ($q) use ($fullIds, $byChantier) {
            $hasClause = false;

            if (!empty($fullIds)) {
                $q->orWhereIn('chantier_id', $fullIds);
                $hasClause = true;
            }

            foreach ($byChantier as $cid => $labels) {
                $q->orWhere(function ($qq) use ($cid, $labels) {
                    $qq->where('chantier_id', $cid)
                       ->whereIn('discipline', array_values(array_unique($labels)));
                });
                $hasClause = true;
            }

            // Aucun chantier → aucun incident visible
            if (!$hasClause) {
                $q->whereRaw('1 = 0');
            }
        });
    }
}