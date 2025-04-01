<?php

namespace App\Http\Controllers;

use App\Models\Jalon;
use Illuminate\Http\Request;
use App\Models\Projet;

class jalonController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Projet $projet)
    {
        $validated = $request->validate([
            'projet_id' => 'required|exists:projets,id',
            'nom_jalon' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_prevue' => 'required|date|after_or_equal:date_debut'
        ]);

        Jalon::create($validated);

        return redirect()->back()->with('success', 'Jalon créé avec succès !');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jalon $jalon)
    {
        $validated = $request->validate([
            'nom_jalon' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $jalon->update($validated);

        return response()->json(['success' => true]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Trouver le jalon par son ID
        $jalon = Jalon::find($id);

        // Vérifier si le jalon existe
        if (!$jalon) {
            return redirect()->route('projet.show')->with('error', 'Jalon non trouvé');
        }

        // Supprimer toutes les activités liées au jalon
        $jalon->activite()->delete();

        // Supprimer le jalon
        $jalon->delete();

        // Retourner avec un message de succès
        return redirect()->back()->with('success', 'Jalon et ses activités supprimés avec succès');
    }
}
