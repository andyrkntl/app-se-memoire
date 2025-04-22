<?php

namespace App\Observers;

use App\Models\Activite;
use Carbon\Carbon;

class ActiviteObserver
{
    // App\Observers\ActiviteObserver.php
    public function retrieved(Activite $activite)
    {
        if (
            $activite->statut_activite !== 'Achevé' &&
            Carbon::now()->greaterThan(Carbon::parse($activite->date_prevue)->endOfDay())
        ) {
            $activite->statut_activite = 'En retard';
            $activite->saveQuietly(); // évite boucle infinie avec l’observer
        }
    }
}
