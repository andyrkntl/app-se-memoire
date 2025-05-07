<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Activite;
use Carbon\Carbon;
use Illuminate\Http\Request;


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
    public function index(Request $request)
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
        $projetId = $request->input('projet_id');

        $query = Activite::query();

        if ($projetId) {
            $query->whereHas('jalon.projet', function ($q) use ($projetId) {
                $q->where('id', $projetId);
            });
        }

        $totalActivites = $query->count();

        $pourcentageEnCours = $totalActivites > 0
            ? round($query->clone()->where('statut_activite', 'En cours')->count() / $totalActivites * 100)
            : 0;

        $pourcentageEnRetard = $totalActivites > 0
            ? round($query->clone()->where('statut_activite', 'En retard')->count() / $totalActivites * 100)
            : 0;

        $pourcentageAchevees = $totalActivites > 0
            ? round($query->clone()->where('statut_activite', 'Achevé')->count() / $totalActivites * 100)
            : 0;

        $projets = Projet::all(); // pour la liste déroulante




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

        // Logique du Burn-down chart
        $projetSelectionne = null;
        $burndownData = null;

        // Vérifier si un projet spécifique est demandé pour le burn-down chart
        $projet_id = $request->input('projet_id');

        if ($projet_id) {
            // Charger le projet spécifique avec ses jalons et activités
            $projetSelectionne = Projet::with(['jalon.activite'])->findOrFail($projet_id);
            $burndownData = $this->prepareBurndownData($projetSelectionne);
        } else {
            // Préparer des données pour un burn-down chart global (tous les projets)
            // On prend le plus ancien projet comme date de début et le plus récent comme date de fin
            $premiereDate = Projet::min('date_debut');
            $derniereDate = Projet::max('date_fin');

            if ($premiereDate && $derniereDate) {
                $burndownData = $this->prepareBurndownDataGlobal($premiereDate, $derniereDate);
            } else {
                $burndownData = [
                    'labels' => [],
                    'ideal' => [],
                    'actual' => [],
                    'remainingWork' => 0,
                    'totalDays' => 0,
                    'elapsedDays' => 0,
                ];
            }
        }

        return view('accueil', compact(
            'totalProjets',
            'avancementGlobal',
            'activitesSemaine',
            'projetsRisques',
            'totalActivites',
            'pourcentageEnCours',
            'pourcentageEnRetard',
            'pourcentageAchevees',
            'projets',
            'projetId',
            'listeProjets',
            'listeActivitesSemaine',
            'listeProjetsRisques',
            'projetSelectionne',
            'burndownData'
        ));
    }

    /**
     * Prépare les données pour le burn-down chart d'un projet spécifique
     */
    private function prepareBurndownData(Projet $projet)
    {
        // Vérifier si les dates du projet sont définies
        if (!$projet->date_debut || !$projet->date_fin) {
            return [
                'labels' => [],
                'ideal' => [],
                'actual' => [],
                'remainingWork' => 0,
                'totalDays' => 0,
                'elapsedDays' => 0,
            ];
        }

        $startDate = Carbon::parse($projet->date_debut);
        $endDate = Carbon::parse($projet->date_fin);
        $today = Carbon::today();

        // Si le projet est terminé, utiliser la date de fin comme date actuelle
        if ($today->isAfter($endDate)) {
            $today = $endDate->copy();
        }

        // Calculer la durée totale du projet en jours
        $totalDays = $startDate->diffInDays($endDate) + 1;
        $elapsedDays = $startDate->diffInDays($today) + 1;

        // Récupérer toutes les activités du projet
        $activites = $projet->activite;
        $totalActivites = $activites->count();

        if ($totalActivites === 0) {
            return [
                'labels' => [],
                'ideal' => [],
                'actual' => [],
                'remainingWork' => 0,
                'totalDays' => $totalDays,
                'elapsedDays' => $elapsedDays,
            ];
        }

        // Ligne idéale (théorique)
        $labels = [];
        $ideal = [];
        $actual = [];

        // Calculer les activités terminées par jour
        $activitesTermineesParJour = [];
        foreach ($activites as $activite) {
            if ($activite->date_fin) {
                $finDate = Carbon::parse($activite->date_fin)->format('Y-m-d');
                if (!isset($activitesTermineesParJour[$finDate])) {
                    $activitesTermineesParJour[$finDate] = 0;
                }
                $activitesTermineesParJour[$finDate]++;
            }
        }

        // Générer les données pour chaque jour du projet
        $currentDate = $startDate->copy();
        $workRemaining = $totalActivites;
        $cumulativeCompleted = 0;

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $dateFormatted = $currentDate->format('Y-m-d');
            $labels[] = $currentDate->format('d/m/Y');

            // Ligne idéale : diminution linéaire
            $daysElapsed = $startDate->diffInDays($currentDate);
            $idealRemaining = $totalActivites - ($totalActivites * ($daysElapsed / $totalDays));
            $ideal[] = round($idealRemaining, 1);

            // Ligne réelle : basée sur les activités terminées
            if (isset($activitesTermineesParJour[$dateFormatted])) {
                $cumulativeCompleted += $activitesTermineesParJour[$dateFormatted];
            }
            $actualRemaining = $totalActivites - $cumulativeCompleted;
            $actual[] = $actualRemaining;

            // Si nous sommes à aujourd'hui, enregistrer le travail restant
            if ($currentDate->equalTo($today)) {
                $workRemaining = $actualRemaining;
            }

            $currentDate->addDay();
        }

        return [
            'labels' => $labels,
            'ideal' => $ideal,
            'actual' => $actual,
            'remainingWork' => $workRemaining,
            'totalDays' => $totalDays,
            'elapsedDays' => $elapsedDays,
        ];
    }

    /**
     * Prépare les données pour un burn-down chart global de tous les projets
     */
    private function prepareBurndownDataGlobal($premiereDate, $derniereDate)
    {
        $startDate = Carbon::parse($premiereDate);
        $endDate = Carbon::parse($derniereDate);
        $today = Carbon::today();

        // Si on a dépassé la date de fin, utiliser la date de fin comme date actuelle
        if ($today->isAfter($endDate)) {
            $today = $endDate->copy();
        }

        // Calculer la durée totale en jours
        $totalDays = $startDate->diffInDays($endDate) + 1;
        $elapsedDays = $startDate->diffInDays($today) + 1;

        // Récupérer toutes les activités
        $totalActivites = Activite::count();

        if ($totalActivites === 0) {
            return [
                'labels' => [],
                'ideal' => [],
                'actual' => [],
                'remainingWork' => 0,
                'totalDays' => $totalDays,
                'elapsedDays' => $elapsedDays,
            ];
        }

        // Ligne idéale (théorique)
        $labels = [];
        $ideal = [];
        $actual = [];

        // Calculer les activités terminées par jour (statut "Achevé")
        $activitesTermineesParJour = [];
        $activitesAchevees = Activite::where('statut_activite', 'Achevé')
            ->whereNotNull('date_fin')
            ->get();

        foreach ($activitesAchevees as $activite) {
            $finDate = Carbon::parse($activite->date_fin)->format('Y-m-d');
            if (!isset($activitesTermineesParJour[$finDate])) {
                $activitesTermineesParJour[$finDate] = 0;
            }
            $activitesTermineesParJour[$finDate]++;
        }

        // Générer les données pour chaque jour
        $currentDate = $startDate->copy();
        $workRemaining = $totalActivites;
        $cumulativeCompleted = 0;

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $dateFormatted = $currentDate->format('Y-m-d');
            $labels[] = $currentDate->format('d/m/Y');

            // Ligne idéale : diminution linéaire
            $daysElapsed = $startDate->diffInDays($currentDate);
            $idealRemaining = $totalActivites - ($totalActivites * ($daysElapsed / $totalDays));
            $ideal[] = round($idealRemaining, 1);

            // Ligne réelle : basée sur les activités terminées
            if (isset($activitesTermineesParJour[$dateFormatted])) {
                $cumulativeCompleted += $activitesTermineesParJour[$dateFormatted];
            }
            $actualRemaining = $totalActivites - $cumulativeCompleted;
            $actual[] = $actualRemaining;

            // Si nous sommes à aujourd'hui, enregistrer le travail restant
            if ($currentDate->equalTo($today)) {
                $workRemaining = $actualRemaining;
            }

            $currentDate->addDay();
        }

        return [
            'labels' => $labels,
            'ideal' => $ideal,
            'actual' => $actual,
            'remainingWork' => $workRemaining,
            'totalDays' => $totalDays,
            'elapsedDays' => $elapsedDays,
        ];
    }
}
