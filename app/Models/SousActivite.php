<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousActivite extends Model
{

    use HasFactory;
    protected $table = 'sous_activites';

    protected $fillable = [
        'sousActivite_id',
        'Description_sousActivite',
        'Statut_sousActivite',
        'Debut_sousActivite',
        'Fin_sousActivite',
    ];
}
