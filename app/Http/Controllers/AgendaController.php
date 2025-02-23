<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    // Afficher la page de l'agenda
    public function index()
    {
        $evenements = Evenement::all(); // Récupère tous les événements
        return view('agenda.indexAgenda', compact('evenements')); // Passe les événements à la vue
    }

    // Afficher le formulaire d'ajout d'un événement
    public function create()
    {
        return view('agenda.ajoutAgenda');
    }

    // Enregistrer un nouvel événement (AJAX)
    public function store(Request $request)
    {
        $request->validate([
            'Objet_evenement' => 'required',
            'Debut_evenement' => 'required|date',
            'Fin_evenement' => 'required|date|after:Debut_evenement',
            'type' => 'required',
            'Statut_evenement' => 'required',
            'Commentaires_evenement' => 'nullable',
        ]);

        $evenement = Evenement::create($request->all());

        return response()->json([
            'id' => $evenement->id,
            'title' => $evenement->Objet_evenement,
            'start' => $evenement->Debut_evenement,
            'end' => $evenement->Fin_evenement,
            'type' => $evenement->type,
            'statut' => $evenement->Statut_evenement,
            'commentaires' => $evenement->Commentaires_evenement,
        ]);
    }

    // Afficher les détails d'un événement
    public function show($id)
    {
        $evenement = Evenement::findOrFail($id);
        return view('agenda.show', compact('evenement'));
    }

    // Afficher le formulaire de modification d'un événement
    public function edit($id)
    {
        $evenement = Evenement::findOrFail($id);
        return view('agenda.edit', compact('evenement'));
    }

    // Mettre à jour un événement (AJAX)
    public function update(Request $request, $id)
    {
        $request->validate([
            'Objet_evenement' => 'required',
            'Debut_evenement' => 'required|date',
            'Fin_evenement' => 'required|date|after:Debut_evenement',
            'type' => 'required',
            'Statut_evenement' => 'required',
            'Commentaires_evenement' => 'nullable',
        ]);

        $evenement = Evenement::findOrFail($id);
        $evenement->update($request->all());

        return response()->json([
            'id' => $evenement->id,
            'title' => $evenement->Objet_evenement,
            'start' => $evenement->Debut_evenement,
            'end' => $evenement->Fin_evenement,
            'type' => $evenement->type,
            'statut' => $evenement->Statut_evenement,
            'commentaires' => $evenement->Commentaires_evenement,
        ]);
    }

    // Supprimer un événement (AJAX)
    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();

        return response()->json(['success' => true]);
    }

    // API pour FullCalendar (retourne les événements au format JSON)
        public function getEvents()
{
    // Récupérer tous les événements depuis la base de données
    $evenements = Evenement::all();

    // Transformer les événements en format JSON compatible avec FullCalendar
    $events = $evenements->map(function ($evenement) {
        return [
            'id' => $evenement->id,
            'title' => $evenement->Objet_evenement,
            'start' => $evenement->Debut_evenement,
            'end' => $evenement->Fin_evenement,
            'type' => $evenement->type,
            'statut' => $evenement->Statut_evenement,
            'commentaires' => $evenement->Commentaires_evenement,
        ];
    });

    // Retourner les événements au format JSON
    return response()->json($events);
}
}
