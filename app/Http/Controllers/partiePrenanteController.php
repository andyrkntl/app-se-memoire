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
        $pivotEntries = $query->paginate(15);

        // Données pour les filtres
        $entites = PartiePrenante::distinct()->pluck('entite');
        $fonctions = ProjetPartiePrenante::distinct()->pluck('fonction');
        $projets = Projet::all();

        return view('partiePrenante.indexPartiePrenante', compact('pivotEntries', 'entites', 'fonctions', 'projets'));
    }








    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partiePrenante.ajoutPartiePrenante');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
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
     * Display the specified resource.
     */
    public function show(PartiePrenante $partiePrenante)
    {
        return view('partiePrenante.profilPartiePrenante', [
            'partiePrenante' => $partiePrenante,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partieprenante = partieprenante::find($id);

        if (!$partieprenante) {
            return redirect()->route('partiePrenante.index')->with('error', 'activite introuvable');
        }

        return view('partiePrenante.modifierPartiePrenante', compact('partieprenante'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation des données envoyées
        $request->validate([
            'projet_id' => 'required|exists:projets,id', // Validation du projet
            'entite' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'nom_partie' => 'required|string|max:255',
            'email_partie' => 'nullable|email|max:255',
            'contact_partie' => 'nullable|string|max:255',
        ]);

        // Trouver la partie prenante par son id
        $partiePrenante = PartiePrenante::findOrFail($id);

        // Mettre à jour l'entité de la partie prenante
        $partiePrenante->update([
            'entite' => $request->entite,
        ]);

        // Trouver l'entrée dans la table pivot en fonction des deux clés étrangères
        $projetPartiePrenante = ProjetPartiePrenante::where('partie_prenante_id', $id)
            ->where('projet_id', $request->projet_id)
            ->first(); // Trouver l'association existante

        if ($projetPartiePrenante) {
            // Mettre à jour l'entrée pivot avec les nouvelles données
            $projetPartiePrenante->update([
                'fonction' => $request->fonction,
                'nom_partie' => $request->nom_partie,
                'email_partie' => $request->email_partie,
                'contact_partie' => $request->contact_partie,
            ]);
        } else {
            // Si aucune entrée pivot n'existe, en créer une
            ProjetPartiePrenante::create([
                'projet_id' => $request->projet_id,
                'partie_prenante_id' => $partiePrenante->id,
                'fonction' => $request->fonction,
                'nom_partie' => $request->nom_partie,
                'email_partie' => $request->email_partie,
                'contact_partie' => $request->contact_partie,
            ]);
        }

        return redirect()->route('partiePrenante.index')->with('success', 'Partie prenante et projet mis à jour avec succès!');
    }










    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PartiePrenante $partiePrenante)
    {

        $partiePrenante->delete();
        if ($partiePrenante) {
            return redirect()->route('partiePrenante.index')->with('success', 'partie prenante supprimé avec succès!');
        } else {
            return back()->with('error', 'Échec du suppression du partie prenante. Veuillez réessayer.');
        }
    }
}
