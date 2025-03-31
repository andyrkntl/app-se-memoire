<?php

namespace App\Http\Controllers;

use App\Models\Jalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Projet;

class jalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projet = DB::table('projets')->get();
        $jalon = DB::table('jalons')
            ->leftJoin('projets', 'projets.id', '=', 'jalons.projet_id') //jointure avec la table projets
            ->select('jalons.*', 'projets.Nom_projet as projet_nom')
            ->get();

        if ($jalon) {
            return view('jalon.indexJalon', [
                'jalon' => $jalon,
                'projet' => $projet
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jalon.ajoutJalon');
    }

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
     * Display the specified resource.
     */
    public function show(Projet $projet) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jalon = Jalon::find($id);
        $projet = DB::table('projets')->get(); // Récupérer tous les projets

        if (!$jalon) {
            return redirect()->route('jalon.index')->with('error', 'Jalon introuvable');
        }

        return view('jalon.modifierJalon', compact('jalon', 'projet'));
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
