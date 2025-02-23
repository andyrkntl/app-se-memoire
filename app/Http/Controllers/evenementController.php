<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class evenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $evenements = Evenement::all();
        return view('agenda.indexAgenda', [
            'evenements' => $evenements,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validation des données
        $request->validate([
            'Objet_evenement' => 'required|string|max:255',
            'Heure_evenement' => 'required',
            'Debut_evenement' => 'required|date',
            'Fin_evenement' => 'required|date|after_or_equal:Debut_evenement',
            'Commentaires' => 'nullable|string|max:255',
            'type' => 'required|in:lead,chantier',
        ]);

        // Création de l'événement
        $evenement = new Evenement();
        $evenement->Objet_evenement = $request->input('Objet_evenement');
        $evenement->Heure_evenement = $request->input('Heure_evenement');
        $evenement->Debut_evenement = $request->input('Debut_evenement');
        $evenement->Fin_evenement = $request->input('Fin_evenement');
        $evenement->Commentaires = $request->input('Commentaires', null);
        $evenement->type = $request->input('type');
        $evenement->save();

        return redirect()->route('agenda.indexAgenda')->with('success', 'Événement créé avec succès !');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->updateStatut(); // Met à jour le statut avant de l'afficher
        return view('evenements.show', compact('evenement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evenement $evenement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */  // Modifier un événement
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'Objet_evenement' => 'required|string|max:255',
            'Heure_evenement' => 'required',
            'Debut_evenement' => 'required|date',
            'Fin_evenement' => 'required|date|after_or_equal:Debut_evenement',
            'Commentaires' => 'nullable|string|max:255',
            'type' => 'required|in:lead,chantier',
        ]);

        // Récupérer l'événement
        $evenement = Evenement::findOrFail($id);
        $evenement->Objet_evenement = $request->input('Objet_evenement');
        $evenement->Heure_evenement = $request->input('Heure_evenement');
        $evenement->Debut_evenement = $request->input('Debut_evenement');
        $evenement->Fin_evenement = $request->input('Fin_evenement');
        $evenement->Commentaires = $request->input('Commentaires', null);
        $evenement->type = $request->input('type');
        $evenement->save();

        return redirect()->route('agenda.indexAgenda')->with('success', 'Événement modifié avec succès !');
    }

    public function filter(Request $request)
{
    $criteria = $request->input('filter_criteria');

    if ($criteria == 'lead') {
        $evenements = Evenement::where('type', 'lead')->get();
    } elseif ($criteria == 'chantier') {
        $evenements = Evenement::where('type', 'chantier')->get();
    } else {
        $evenements = Evenement::all();
    }

    return view('agenda.indexAgenda', compact('evenements'));
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();

        return redirect()->route('agenda.indexAgenda')->with('success', 'Événement supprimé avec succès !');
    }
}


