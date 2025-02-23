<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    use HasFactory;
    protected $table = 'chantiers';

    protected $fillable = [
        'Nom_chantier',
        'Description',
        'Objectif',
        'Situation_actuelle',
        'Prochaines_etapes',
         'status'
    ];


    public function projet() {
        return $this->hasMany(Projet::class, 'chantier_id');
    }

}
