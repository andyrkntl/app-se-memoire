<?php

namespace App\Http\Controllers;

use App\Models\Kpsi;
use Illuminate\Http\Request;

class KpsiController extends Controller
{
    public function index()
    {
        $kpsis = Kpsi::all();
        return view('kpsi.indexKpsi', compact('kpsis'));
    }

    public function create()
    {
        return view('kpsi.ajoutKpsi'); // Nom correct de la vue pour créer
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'target_value' => 'required|string',
           'type' => 'required|in:qualitatif,quantitatif',  // Validation du champ "type" (seulement "qualitatif" ou "quantitatif")
           'achieved' => 'required|in:0,1',  // Validation avec des entiers pour 'achieved'
        ]);

        // Convertir 'atteint' ou 'non_atteint' en 1 ou 0
        $validatedData['achieved'] = ($validatedData['achieved'] === 'atteint') ? 1 : 0;

        Kpsi::create($validatedData);

        return redirect()->route('kpsi.index')->with('success', 'Indicateur créé avec succès.');
    }

    public function edit($id)
    {
        $kpsi = Kpsi::findOrFail($id); // Singularisé
        return view('kpsi.modifierKpsi', compact('kpsi')); // Nom correct de la vue pour modifier
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'target_value' => 'required|numeric',
            'type' => 'required|in:qualitatif,quantitatif',  // Validation du champ "type" (seulement "qualitatif" ou "quantitatif")
            'achieved' => 'required|in:0,1',  // Validation avec des entiers pour 'achieved'
        ]);

        // Convertir 'atteint' ou 'non_atteint' en 1 ou 0
        $validatedData['achieved'] = ($validatedData['achieved'] === 'atteint') ? 1 : 0;

        $kpsi = Kpsi::findOrFail($id); // Singularisé
        $kpsi->update($validatedData);

        return redirect()->route('kpsi.index')->with('success', 'Indicateur mis à jour avec succès.');
    }

    public function show($id)
    {
        $kpsi = Kpsi::findOrFail($id); // Singularisé
        return view('kpsi.profilKpsi', compact('kpsi')); // Nom correct de la vue pour afficher un profil
    }

    public function destroy($id)
    {
        $kpsi = Kpsi::findOrFail($id); // Singularisé
        $kpsi->delete();

        return redirect()->route('kpsi.index')->with('success', 'Indicateur supprimé avec succès.');
    }
}
