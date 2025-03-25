<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Projet;
use Carbon\Carbon;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Projet::with('chantier', 'lead');


        // Filtrer par chantier
        if ($request->filled('chantier_id')) {
            $query->where('chantier_id', $request->chantier_id);
        }

        // Filtrer par responsable (lead)
        if ($request->filled('lead_id')) {
            $query->where('lead_id', $request->lead_id);
        }

        // Filtrer par statut d'avancement
        if ($request->filled('statut_projet')) {
            $query->where('statut_projet', $request->statut_projet);
        }

        $projets = $query->get();

        // Récupérer les valeurs possibles pour les filtres
        $chantiers = Chantier::all();
        $leads = Lead::all();
        $statut_projet = ['En cours', 'Achevé', 'En retard']; // Si les statuts sont fixes

        return view('projet.indexProjet', compact('projets', 'chantiers', 'leads', 'statut_projet'));
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
        $projet = DB::table('projets')->insert([
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

        if ($projet) {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupération du projet avec ses relations
        $projet = Projet::with(['lead', 'chantier', 'jalon.activite'])->find($id);

        if ($projet) {
            return view('projet.profilProjet', compact('projet'));
        } else {
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

        if ($projet) {
            return back();
        }
    }
}
