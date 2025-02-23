<?php

namespace App\Observers;

use App\Models\Evenement;

class EvenementObserver
{
    /**
     * Handle the Evenement "retrieved" event.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return void
     */
    public function retrieved(Evenement $evenement)
    {
        $evenement->updateStatut();
    }

    // Vous pouvez également utiliser d'autres événements comme "creating", "updating", etc.
}
