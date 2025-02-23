<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Evenement extends Model
{
    use HasFactory;

    protected $table = 'evenements';

    protected $fillable = [
        'evenement_id',
        'Objet_evenement',
        'Heure_evenement',
        'Debut_evenement',
        'Fin_evenement',
        'type',
        'Statut_evenement',
        'Commentaires_evenement'
    ];

    /**
     * Met à jour le statut de l'événement en fonction des dates de début et de fin.
     */

public function updateStatut()
    {
        if ($this->Statut_evenement == 'annulé' || $this->Statut_evenement == 'reporté') {
            // Si l'événement est déjà annulé ou reporté, ne pas modifier le statut
            return;
        }

        if (Carbon::now()->between($this->Debut_evenement, $this->Fin_evenement)) {
            $this->Statut_evenement = 'en cours';
        } elseif (Carbon::now()->greaterThan($this->Fin_evenement)) {
            $this->Statut_evenement = 'achevé';
        }

        $this->save();
    }
}



