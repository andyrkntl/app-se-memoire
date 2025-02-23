<?php

namespace App\Http\Controllers;

use App\Models\Formulaire;
use App\Models\Chantier; // Modèle Chantier pour récupérer les chantiers existants
use Illuminate\Http\Request;

class FormulaireController extends Controller
{
    // Afficher la liste des formulaires
    public function index()
    {
        $formulaires = Formulaire::all(); // Récupère tous les formulaires
        return view('formulaire.indexFormulaire', compact('formulaires'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $chantiers = Chantier::all(); // Récupère tous les chantiers existants
        return view('formulaire.ajoutFormulaire', compact('chantiers'));

    }

    // Enregistrer un nouveau formulaire
    public function store(Request $request)

    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'nom_chantier' => 'required|string|max:50',
            'pourcentage_realisation' => 'required|integer|min:0|max:100',
            'commentaires' => 'nullable|string',
        ]);

        // Insérer les données dans la table formulaire
        Formulaire::create($validated);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Formulaire ajouté avec succès.');
    }
    public function destroy($id)
    {
        $formulaire = Formulaire::findOrFail($id); // Trouve le formulaire ou génère une erreur 404
        $formulaire->delete(); // Supprime l'entrée

        return redirect()->route('formulaires.index')->with('success', 'Formulaire supprimé avec succès.');
    }

    // Modifier un formulaire (ajouter les méthodes pour éditer et supprimer si nécessaire)
}
