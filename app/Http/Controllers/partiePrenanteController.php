<?php

namespace App\Http\Controllers;

use App\Models\PartiePrenante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class partiePrenanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partiePrenante = DB::table('partie_prenantes')->get();

        return view('partiePrenante.indexPartiePrenante', [
            'partiePrenante' => $partiePrenante,
        ]);
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
        $partiePrenante = DB::table('partie_prenantes')
            ->insert([
                'Nom_partie' => $request['Nom_partie'],
                'Acronyme' => $request['Acronyme'],
                'Type' => $request['Type'],
                'Contact' => $request['Contact'],

            ]);

        if ($partiePrenante) {
            return redirect()->route('partiePrenante.index')->with('success', 'Partie prenante ajouté avec succès!');
        } else {
            return back()->with('error', 'Échec de l\'ajout du partie prenante. Veuillez réessayer.');
        }
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
    public function update(Request $request, PartiePrenante $partiePrenante)
    {
        // Validation des données envoyées
        $validated = $request->validate([
            'Nom_partie' => 'required|string',
            'Acronyme' => 'required|string',
            'Type' => 'required|string',
            'Contact' => 'required|string',
        ]);

        // Mise à jour de l'enregistrement dans la base de données
        $partiePrenante->Nom_partie = $request->Nom_partie;
        $partiePrenante->Acronyme = $request->Acronyme;
        $partiePrenante->Type = $request->Type;
        $partiePrenante->Contact = $request->Contact;

        // Enregistrement des modifications
        if ($partiePrenante->save()) {
            // Redirection avec message de succès
            return redirect()->route('partiePrenante.index')->with('success', 'Partie prenante modifiée avec succès!');
        } else {
            // Si la mise à jour échoue, retourner avec message d'erreur
            return back()->with('error', 'Échec de la modification de la partie prenante. Veuillez réessayer.');
        }
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
