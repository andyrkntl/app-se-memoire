<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Evenement;

class UpdateEvenementStatut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evenements:update-statut';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Met à jour le statut des événements en fonction des dates actuelles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mise à jour des statuts des événements...');

        Evenement::all()->each(function ($evenement) {
            $evenement->updateStatut();
        });

        $this->info('Mise à jour terminée.');
    }
}
