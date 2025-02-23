<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Affiche tous les événements du calendrier.
     */
    public function index()
    {
        $evenements = Evenement::all();
        return view('agenda.indexAgenda', compact('evenements'));
    }

    /**
     * Crée un nouvel événement.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Objet_evenement' => 'required|string|max:255',
            'Heure_evenement' => 'required',
            'Debut_evenement' => 'required|date',
            'Fin_evenement' => 'required|date|after_or_equal:Debut_evenement',
            'Commentaires' => 'nullable|string|max:255',
            'type' => 'required|in:lead,chantier',
        ]);

        Evenement::create($request->all());

        return redirect()->route('calendar.index')->with('success', 'Événement créé avec succès !');
    }

    /**
     * Affiche les détails d'un événement spécifique.
     */
    public function show($id)
    {
        $evenement = Evenement::findOrFail($id);
        return view('evenements.show', compact('evenement'));
    }

    /**
     * Met à jour un événement existant.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Objet_evenement' => 'required|string|max:255',
            'Heure_evenement' => 'required',
            'Debut_evenement' => 'required|date',
            'Fin_evenement' => 'required|date|after_or_equal:Debut_evenement',
            'Commentaires' => 'nullable|string|max:255',
            'type' => 'required|in:lead,chantier',
        ]);

        $evenement = Evenement::findOrFail($id);
        $evenement->update($request->all());

        return redirect()->route('calendar.index')->with('success', 'Événement modifié avec succès !');
    }

    /**
     * Supprime un événement.
     */
    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();

        return redirect()->route('calendar.index')->with('success', 'Événement supprimé avec succès !');
    }

    /**
     * Filtre les événements en fonction de critères.
     */
    public function filter(Request $request)
    {
        $criteria = $request->input('filter_criteria');
        $evenements = Evenement::query();

        if ($criteria) {
            $evenements->where('type', $criteria);
        }

        return view('agenda.indexAgenda', ['evenements' => $evenements->get()]);
    }
}
