<?php

namespace App\Http\Controllers;

use App\Models\PartiePrenante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Projet;
use App\Models\ProjetPartiePrenante;

class partiePrenanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProjetPartiePrenante::query()->with(['projet', 'partiePrenante']);

        // Filtre par projet
        if ($request->filled('projet_id')) {
            $query->where('projet_id', $request->projet_id);
        }

        // Filtre par entités multiples
        if ($request->filled('entites')) {
            $query->whereHas('partiePrenante', function ($q) use ($request) {
                $q->whereIn('entite', $request->entites);
            });
        }

        // Filtre par fonctions multiples
        if ($request->filled('fonctions')) {
            $query->whereIn('fonction', $request->fonctions);
        }

        // Pagination
        $pivotEntries = $query->paginate(3);

        // Données pour les filtres
        $entites = PartiePrenante::distinct()->pluck('entite');
        $fonctions = ProjetPartiePrenante::distinct()->pluck('fonction');
        $projets = Projet::all();

        // Récupération des emails (nouveau code)
        $emailQuery = clone $query;
        $emails = $emailQuery->get()
            ->pluck('email_partie')
            ->filter()
            ->unique()
            ->implode('; ');

        return view('partiePrenante.indexPartiePrenante', compact('pivotEntries', 'entites', 'fonctions', 'projets', 'emails'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'commentateur'])) {
            abort(403, 'Accès non autorisé.');
        }
        // Vérifier si l'entité existe déjà
        $partiePrenante = PartiePrenante::firstOrCreate(['entite' => $request->entite]);

        // Ajouter l'association dans la table projet_partie_prenante
        ProjetPartiePrenante::create([
            'projet_id' => $request->projet_id,
            'partie_prenante_id' => $partiePrenante->id,
            'fonction' => $request->fonction,
            'nom_partie' => $request->nom_partie,
            'email_partie' => $request->email_partie,
            'contact_partie' => $request->contact_partie,
        ]);

        return redirect()->back()->with('success', 'Partie prenante ajoutée avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Affiche le formulaire de modification
    public function edit($partiePrenanteId)
    {
        if (!in_array(auth()->user()->role, ['admin', 'commentateur'])) {
            abort(403, 'Accès non autorisé.');
        }
        // Récupère la partie prenante
        $partiePrenante = PartiePrenante::findOrFail($partiePrenanteId);

        // Récupère les données liées à cette partie prenante dans la table pivot
        $pivotData = ProjetPartiePrenante::where('partie_prenante_id', $partiePrenanteId)->first();

        if ($pivotData) {
            // Récupère les informations du projet lié à cette partie prenante
            $projet = $pivotData->projet; // C'est la relation qui récupère le projet

            // Passe les données à la vue
            return view('partiePrenante.editPartiePrenante', compact('partiePrenante', 'pivotData', 'projet'));
        } else {
            // Si aucune donnée de pivot n'est trouvée, on redirige vers la liste avec un message d'erreur
            return redirect()->route('partiePrenante.index')->with('error', 'Aucune partie prenante associée à ce projet.');
        }
    }


    // Méthode pour mettre à jour la partie prenante
    public function update(Request $request, $id)
    {
        if (!in_array(auth()->user()->role, ['admin', 'commentateur'])) {
            abort(403, 'Accès non autorisé.');
        }

        $pivotEntry = ProjetPartiePrenante::findOrFail($id);
        $pivotEntry->update([
            'fonction' => $request->fonction,
            'nom_partie' => $request->nom_partie,
            'email_partie' => $request->email_partie,
            'contact_partie' => $request->contact_partie,
        ]);

        return redirect()->back()->with('success', 'Modification effectuée avec succès !');
    }












    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pivotEntry = ProjetPartiePrenante::findOrFail($id);
        $pivotEntry->delete();

        return redirect()->back()
            ->with('success', 'La partie prenante a été supprimée avec succès !');
    }
}
