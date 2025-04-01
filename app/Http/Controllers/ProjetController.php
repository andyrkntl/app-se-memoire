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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'chantier_id' => 'required|integer|exists:chantiers,id',
            'lead_id' => 'required|integer|exists:leads,id',
            'nom_projet' => 'required|string|max:255',
            'objectifs' => 'required|string',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
        ]);

        Projet::create($validated);

        return redirect()->back()->with('success', 'Projet ajouté avec succès.');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {
        $validated = $request->validate([
            'chantier_id' => 'required|integer|exists:chantiers,id',
            'lead_id' => 'required|integer|exists:leads,id',
            'nom_projet' => 'required|string|max:255',
            'objectifs' => 'required|string',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
        ]);

        $projet->update($validated);

        return redirect()->back()->with('success', 'Projet modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->delete();

        return redirect()->back()->with('success', 'Projet supprimé avec succès !');
    }
}
