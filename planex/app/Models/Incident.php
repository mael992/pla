<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $primaryKey = 'id_incident';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'date_incident',
        'photo',
        'date_maj',
        'departement',
        'systeme',
        'lot_travail',
        'zone',
        'etiquette',
        'description',
        'categorie',
        'interne',
        'statut',
        'responsabilite',
        'emis_par'
        ];
}
