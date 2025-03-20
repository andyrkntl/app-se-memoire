<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class chantierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chantier = DB::table('chantiers')->get();

        return view('chantier.testChantier', [
            'chantier' => $chantier,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nom_chantier' => 'required',
            'Nom_responsable' => 'required',
            'Description' => 'required',  // Assurez-vous que 'Description' est bien fourni
            'Objectif' => 'required',
            'Situation_actuelle' => 'required',
            'Prochaines_etapes' => 'required',
        ]);
        $projet = DB::table('projets')->get();
        DB::table('chantiers')->insert([
            'Nom_chantier' => $request->Nom_chantier,
            'Nom_responsable' => $request->Nom_responsable,
            'Description' => $request->Description,
            'Objectif' => $request->Objectif,
            'Situation_actuelle' => $request->Situation_actuelle,
            'Prochaines_etapes' => $request->Prochaines_etapes,
        ]);
        return redirect()->route('chantier.index')->with('success', 'Chantier ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chantier $chantier)
    {
        return view('chantier.profilChantier', [
            'chantier' => $chantier,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chantier = chantier::find($id);
        if (!$chantier) {
            return redirect()->route('chantier.index')->with('error', 'chantier introuvable');
        }

        return view('chantier.modifierChantier', compact('chantier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chantier $chantier)
    {
        try {
            $chantier = DB::table('chantiers')
                ->where('id', $chantier->id)
                ->update([
                    'Nom_chantier' => $request->Nom_chantier,
                    'Nom_responsable' => $request->Nom_responsable,
                    'Description' => $request->Description,
                    'Objectif' => $request->Objectif,
                    'Situation_actuelle' => $request->Situation_actuelle,
                    'Prochaines_etapes' => $request->Prochaines_etapes,
                ]);
            $request->validate([
                'Nom_chantier' => 'required|string',
                'Nom_responsable' => 'required|string',
                'Description' => 'required|string|max:1000',
                'Objectif' => 'required|string',
                'Situation_actuelle' => 'required|string',
                'Prochaines_etapes' => 'required|string',
            ]);
            return redirect()->route('chantier.index')->with('success', 'Chantier modifié avec succès!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chantier $chantier)
    {
        $chantier->delete();
        if ($chantier) {
            return redirect()->route('chantier.index')->with('success', 'Lead supprimé avec succès!');
        } else {
            return back()->with('error', 'Échec de l\'ajout du Lead. Veuillez réessayer.');
        }
    }
}
