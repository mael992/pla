<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    protected $fillable = ['nom', 'localite'];

    public function incidents()
    {
        return $this->hasMany(Incident::class, 'chantier_id');
    }
}
