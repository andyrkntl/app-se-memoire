<?php

namespace App\Http\Middleware;

use Illuminate\Console\Command;
use App\Models\Evenement;

class UpdateEvenementStatut extends Command
{
    protected $signature = 'evenements:update-statut';
    protected $description = 'Met à jour le statut des événements en fonction des dates actuelles';

    public function handle()
    {
        $this->info('Mise à jour des statuts des événements...');

        Evenement::all()->each(function ($evenement) {
            $evenement->updateStatut();
        });

        $this->info('Mise à jour terminée.');
    }
}
