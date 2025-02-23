<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chantier;
use App\Models\Activite;
class AccueilController extends Controller
{
    public function index()
    {
        $totalChantier = Chantier::count(); // Total des chantiers
        $activitesEnCours = Activite::where('Statut_activite', 'en_cours')->count();
        $activitesRealisees = Activite::where('Statut_activite', 'acheve')->count();
        $activitesNonRealisees = Activite::where('Statut_activite', 'en_attente')->count();

        // Passer ces données à la vue
        return view('accueil', compact('totalChantier', 'activitesEnCours', 'activitesRealisees', 'activitesNonRealisees'));

    }

}
