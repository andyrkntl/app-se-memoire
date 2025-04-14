<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Activite;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Total Projets
        $totalProjets = Projet::count();

        // Avancement Global (moyenne du taux d'avancement des projets)
        $avancementGlobal = Projet::avg('taux_avancement');

        // Activités cette semaine (entre lundi et dimanche)
        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();
        $activitesSemaine = Activite::whereBetween('date_prevue', [$startWeek, $endWeek])->count();

        // Projets à risques :
        $projetsRisques = Projet::where(function ($query) {
            $query->where(function ($q) {
                // Critère 1 : date dépassée + avancement < 50%
                $q->whereDate('date_fin', '<', now())
                    ->where('taux_avancement', '<', 50);
            })
                ->orWhere(function ($q) {
                    // Critère 2 : date prévue dans le mois à venir + avancement < 50%
                    $q->whereBetween('date_fin', [now(), now()->addMonth()])
                        ->where('taux_avancement', '<', 50);
                });
        })->count();

        // Activités par statut
        // Total activités
        $totalActivites = Activite::count();

        $pourcentageEnCours = $totalActivites > 0
            ? round((Activite::where('statut_activite', 'En cours')->count() / $totalActivites) * 100)
            : 0;

        $pourcentageEnRetard = $totalActivites > 0
            ? round((Activite::where('statut_activite', 'En retard')->count() / $totalActivites) * 100)
            : 0;

        $pourcentageAchevees = $totalActivites > 0
            ? round((Activite::where('statut_activite', 'Achevé')->count() / $totalActivites) * 100)
            : 0;


        $listeProjets = Projet::all();



        $listeActivitesSemaine = Activite::with('jalon.projet')
            ->whereBetween('date_prevue', [$startWeek, $endWeek])
            ->get();



        $listeProjetsRisques = Projet::where(function ($query) {
            $query->where(function ($q) {
                $q->whereDate('date_fin', '<', now())
                    ->where('taux_avancement', '<', 50);
            })->orWhere(function ($q) {
                $q->whereBetween('date_fin', [now(), now()->addMonth()])
                    ->where('taux_avancement', '<', 50);
            });
        })->get();



        return view('accueil', compact(
            'totalProjets',
            'avancementGlobal',
            'activitesSemaine',
            'projetsRisques',
            'totalActivites',
            'pourcentageEnCours',
            'pourcentageEnRetard',
            'pourcentageAchevees',
            'listeProjets',
            'listeActivitesSemaine',
            'listeProjetsRisques'
        ));
    }
}
