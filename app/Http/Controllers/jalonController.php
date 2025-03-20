<?php

namespace App\Http\Controllers;

use App\Models\Jalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'projet_id' => 'required|integer|exists:projets,id',
            'Nom_jalon' => 'required|string|max:255',
            'Description' => 'nullable|string|max:100',
            'Statut_jalon' => 'nullable|string|in:En cours,Achevé,En retard',
        ]);

        // Insérer directement dans la table 'jalons' sans utiliser de modèle
        $inserted = DB::table('jalons')->insert($validatedData);

        if ($inserted) {
            return redirect()->route('jalon.index')->with('success', 'Jalon ajouté avec succès');
        } else {
            return back()->with('error', 'Une erreur est survenue lors de l’ajout du jalon.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Jalon $jalon)
    {
        return view('jalon.profilJalon', [
            'jalon' => $jalon,
        ]);
    }

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
    public function update(Request $request, $id)
    {
        try {
            $jalon = Jalon::findOrFail($id);

            // Log des données reçues
            logger('Données du formulaire :', $request->all());

            $request->validate([
                'Nom_jalon' => 'required|string|max:255',
                'Statut_jalon' => 'required|string',
                'Description' => 'nullable|string',
                'projet_id' => 'nullable|integer|exists:projets,id',
            ]);

            $jalon->update([
                'Nom_jalon' => $request->input('Nom_jalon'),
                'Statut_jalon' => $request->input('Statut_jalon'),
                'Description' => $request->input('Description'),
                'projet_id' => $request->input('projet_id'),

            ]);

            return redirect()->route('jalon.index')->with('success', 'Jalon modifié avec succès !');
        } catch (\Exception $e) {
            logger('Erreur lors de la mise à jour du jalon :', ['message' => $e->getMessage()]);
            return back()->withErrors('Une erreur est survenue lors de la mise à jour du jalon.');
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jalon = Jalon::find($id);

        if ($jalon) {
            $jalon->delete();
            return redirect()->route('jalon.index')->with('success', 'Jalon supprimé avec succès');
        }

        return redirect()->route('jalon.index')->with('error', 'Jalon introuvable');
    }
}
