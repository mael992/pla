<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChantierDiscipline extends Model
{
    protected $fillable = ['chantier_id', 'discipline', 'entreprise'];

    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'chantier_id');
    }

    /** Libellé lisible de la discipline (ex: "VRD"). */
    public function getDisciplineLabelAttribute(): string
    {
        return Chantier::DISCIPLINES[$this->discipline] ?? $this->discipline;
    }
}
