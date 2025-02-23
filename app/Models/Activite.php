<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $table = 'activites';

    protected $fillable = [
        'Nom_activite',
        'Description_activite',
        'Statut_activite',
        'Valeur_cible',
        'Valeur_actuel',
        'Date_debut',
        'Date_fin',
        'Prochaine_etape'

    ];

    public function jalon() {
        return $this->belongsTo(Jalon::class, 'jalon_id');
    }
    public function getColorAttribute()
    {
        return match ($this->Statut_activite) {
            'en_cours' => 'green',
            'Inactif' => 'red',
            'en_attente' => 'orange',
            'acheve' => 'blue',
            'Annulé' => 'gray',
            default => 'black',
        };
    }

}
