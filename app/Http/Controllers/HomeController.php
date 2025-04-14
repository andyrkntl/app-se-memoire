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




        // === Données pour le graphique dynamique ===
        [$data, $frequence, $projet, $projetsDisponibles] = $this->getEvolutionTauxData($request);



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
            'listeProjetsRisques',
            'data',
            'frequence',
            'projet',
            'projetsDisponibles' //données pour le test
        ));
    }



    // private function getEvolutionTauxData(Request $request)
    // {
    //     $frequence = $request->input('frequence', 'mois');
    //     $projetFiltre = $request->input('projet');
    //     $dateFormat = match ($frequence) {
    //         'jour' => '%Y-%m-%d',
    //         'semaine' => '%x-%v',
    //         'mois' => '%Y-%m',
    //         'annee' => '%Y',
    //         default => '%Y-%m',
    //     };

    //     $data = [];

    //     // Filtrage conditionnel : tous les projets ou un seul
    //     $query = Projet::with('jalon');
    //     if ($projetFiltre) {
    //         $query->where('nom_projet', $projetFiltre);
    //     }

    //     $allProjets = $query->get();

    //     foreach ($allProjets as $projet) {
    //         $grouped = $projet->jalon->groupBy(function ($jalon) use ($dateFormat) {
    //             return $jalon->created_at->formatLocalized($dateFormat);
    //         });

    //         $serie = [];

    //         foreach ($grouped as $period => $jalons) {
    //             $avg = $jalons->avg('taux_avancement');
    //             $serie[] = [
    //                 'x' => $period,
    //                 'y' => round($avg, 2),
    //             ];
    //         }

    //         $data[] = [
    //             'name' => $projet->nom_projet,
    //             'data' => $serie,
    //         ];
    //     }

    //     return [$data, $frequence, $projetFiltre];
    // }



    //c'est pour tester graphique
    private function getEvolutionTauxData(Request $request)
    {
        $frequence = $request->input('frequence', 'mois');
        $projetFiltre = $request->input('projet'); // Récupère le projet à filtrer
        $projetsDisponibles = ['Projet Alpha', 'Projet Beta'];


        $data = [];

        switch ($frequence) {
            case 'jour':
                $data = [
                    [
                        'name' => 'Projet Alpha',
                        'data' => [
                            ['x' => '2025-04-10', 'y' => 10],
                            ['x' => '2025-04-11', 'y' => 20],
                            ['x' => '2025-04-12', 'y' => 30],
                            ['x' => '2025-04-13', 'y' => 35],
                            ['x' => '2025-04-14', 'y' => 45],
                        ]
                    ],
                    [
                        'name' => 'Projet Beta',
                        'data' => [
                            ['x' => '2025-04-10', 'y' => 15],
                            ['x' => '2025-04-11', 'y' => 25],
                            ['x' => '2025-04-12', 'y' => 40],
                            ['x' => '2025-04-13', 'y' => 50],
                            ['x' => '2025-04-14', 'y' => 60],
                        ]
                    ]
                ];
                break;

            case 'semaine':
                $data = [
                    [
                        'name' => 'Projet Alpha',
                        'data' => [
                            ['x' => '2025-W13', 'y' => 20],
                            ['x' => '2025-W14', 'y' => 35],
                            ['x' => '2025-W15', 'y' => 50],
                            ['x' => '2025-W16', 'y' => 60],
                        ]
                    ],
                    [
                        'name' => 'Projet Beta',
                        'data' => [
                            ['x' => '2025-W13', 'y' => 25],
                            ['x' => '2025-W14', 'y' => 45],
                            ['x' => '2025-W15', 'y' => 65],
                            ['x' => '2025-W16', 'y' => 80],
                        ]
                    ]
                ];
                break;

            case 'annee':
                $data = [
                    [
                        'name' => 'Projet Alpha',
                        'data' => [
                            ['x' => '2022', 'y' => 15],
                            ['x' => '2023', 'y' => 35],
                            ['x' => '2024', 'y' => 55],
                            ['x' => '2025', 'y' => 70],
                        ]
                    ],
                    [
                        'name' => 'Projet Beta',
                        'data' => [
                            ['x' => '2022', 'y' => 20],
                            ['x' => '2023', 'y' => 40],
                            ['x' => '2024', 'y' => 60],
                            ['x' => '2025', 'y' => 80],
                        ]
                    ]
                ];
                break;

            case 'mois':
            default:
                $data = [
                    [
                        'name' => 'Projet Alpha',
                        'data' => [
                            ['x' => '2025-01', 'y' => 10],
                            ['x' => '2025-02', 'y' => 25],
                            ['x' => '2025-03', 'y' => 45],
                            ['x' => '2025-04', 'y' => 60],
                        ]
                    ],
                    [
                        'name' => 'Projet Beta',
                        'data' => [
                            ['x' => '2025-01', 'y' => 15],
                            ['x' => '2025-02', 'y' => 30],
                            ['x' => '2025-03', 'y' => 55],
                            ['x' => '2025-04', 'y' => 75],
                        ]
                    ]
                ];
                break;
        }

        // 🔍 Si un projet est sélectionné, filtrer les données
        if ($projetFiltre) {
            $data = array_filter($data, function ($projet) use ($projetFiltre) {
                return $projet['name'] === $projetFiltre;
            });
            $data = array_values($data); // Réindexer le tableau
        }

        return [$data, $frequence, $projetFiltre, $projetsDisponibles];
    }
}
