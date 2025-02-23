<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chantier=DB::table('chantiers')->get();

        $lead=DB::table('leads')->get();
        $partie=DB::table('partie_prenantes')->get();
        $projets = DB::table('projets')
            ->join('leads', 'leads.id', '=', 'projets.lead_id') // Jointure avec la table leads
            ->join('partie_prenantes', 'partie_prenantes.id', '=', 'projets.partiePrenante_id') // Jointure avec la table partie_prenantes
            ->join('chantiers', 'chantiers.id', '=', 'projets.chantier_id')
            ->select('leads.*', 'partie_prenantes.*', 'chantiers.*', 'projets.*')
            ->get();
            foreach ($projets as $projet) {
                $projet->activites = DB::table('activites')
                    ->where('projet_id', $projet->id) // Filtrer les activités par projet_id
                    ->get();
            }
        return view('projet.indexProjet',[
            'projets'=>$projets,
            'chantier'=>$chantier,
            'lead'=>$lead,
            'partie'=>$partie,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $projet=DB::table('projets')->insert([
            'lead_id' => $request['lead_id'],
            'partiePrenante_id' => $request['partiePrenante_id'],
            'chantier_id' => $request['chantier_id'],
            'Nom_projet' => $request['Nom_projet'],
            'Description' => $request['Description'],
            'Historiques' => $request['Historiques'],
            'Ressources' => $request['Ressources'],
            'Objectif' => $request['Objectif'],
            'Duree_projet' => $request['Duree_projet'],
            'statut' => $request['statut'],

        ]);

        if($projet){
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    // Vérification de l'ID du projet
    $projet = DB::table('projets')
        ->join('leads', 'leads.id', '=', 'projets.lead_id') // Jointure avec la table leads
        ->join('partie_prenantes', 'partie_prenantes.id', '=', 'projets.partiePrenante_id') // Jointure avec la table partie_prenantes
        ->join('chantiers', 'chantiers.id', '=', 'projets.chantier_id') // Jointure avec la table chantiers
        ->where('projets.id', $id) // Filtrage par l'ID du projet
        ->select('leads.*', 'partie_prenantes.*', 'chantiers.*', 'projets.*') // Sélection des colonnes nécessaires
        ->first(); // Récupère le premier résultat correspondant

    if ($projet) {
        return view('projet.profilProjet', [
            'projet' => $projet,
        ]);
    } else {
        // En cas de projet non trouvé, redirige ou affiche un message d'erreur
        return redirect()->back()->withErrors('Projet non trouvé');
    }
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projet = DB::table('projets')
        ->where('projets.id', $id)
        ->delete();

        if($projet){
            return back();
        }
    }
}
