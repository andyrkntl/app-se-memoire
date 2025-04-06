<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activite;
use App\Models\Jalon;
use App\Models\Projet;
use Carbon\Carbon;


class ActiviteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jalon_id' => 'required|exists:jalons,id',
            'nom_activite' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_prevue' => 'required|date|after_or_equal:date_debut',
            'lieu_reunion' => 'nullable|string|max:255',
            'heure_reunion' => 'nullable|date_format:H:i',
            'description_reunion' => 'nullable|string',
        ]);


        $activite = Activite::create($validated + ['statut_activite' => 'En cours']);

        return response()->json([
            'success' => true,
            'activity' => [
                'id' => $activite->id,
                'nom_activite' => $activite->nom_activite,
                'date_debut_formatted' => $activite->date_debut_formatted,
                'date_prevue_formatted' => $activite->date_prevue_formatted,
                'date_fin_formatted' => $activite->date_fin_formatted,
                'statut_activite' => $activite->statut_activite,
                'lieu_reunion' => $activite->lieu_reunion,
                'heure_reunion' => optional($activite->heure_reunion)->format('H:i'),
                'description_reunion' => $activite->description_reunion,
                'color' => $activite->color, // Utilise l'accesseur du modèle
                'raw_dates' => [ // Pour l'édition future
                    'debut' => $activite->date_debut->format('Y-m-d'),
                    'prevue' => $activite->date_prevue->format('Y-m-d'),
                    'fin' => optional($activite->date_fin)->format('Y-m-d')
                ]
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activite $activite)
    {
        return response()->json($activite);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activite $activite)
    {
        $jalons = Jalon::all();
        return view('activites.edit', compact('activite', 'jalons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activite $activite)
    {
        $validated = $request->validate([
            'nom_activite' => 'required|string|max:255',
            'date_debut' => 'required|date_format:d/m/Y',
            'date_prevue' => 'required|date_format:d/m/Y|after_or_equal:date_debut',
            'date_fin' => 'nullable|date_format:d/m/Y|after_or_equal:date_debut',
            'statut_activite' => 'required|in:En cours,Achevé,En retard',
            'lieu_reunion' => 'nullable|string|max:255',
            'heure_reunion' => 'nullable|date_format:H:i',
            'description_reunion' => 'nullable|string',
        ]);

        try {
            $activite->update([
                'nom_activite' => $validated['nom_activite'],
                'date_debut' => Carbon::createFromFormat('d/m/Y', $validated['date_debut']),
                'date_prevue' => Carbon::createFromFormat('d/m/Y', $validated['date_prevue']),
                'date_fin' => $validated['date_fin']
                    ? Carbon::createFromFormat('d/m/Y', $validated['date_fin'])
                    : null,
                'statut_activite' => $validated['statut_activite'],
                'lieu_reunion' => $validated['lieu_reunion'],
                'heure_reunion' => $validated['heure_reunion'],
                'description_reunion' => $validated['description_reunion'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['date_error' => 'Format de date invalide']
            ], 422);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $activite = Activite::find($id);

        if (!$activite) {
            return redirect()->route('projets.index')->with('error', 'Activité non trouvée');
        }

        $activite->delete();

        return redirect()->back()->with('success', 'Activité supprimée avec succès');
    }

    public function filter(Request $request, $projetId)
    {

        // Récupérer le projet avec ses jalons et activités
        $projet = Projet::with(['jalon.activite'])->find($projetId);

        if (!$projet) {
            return redirect()->back()->withErrors('Projet non trouvé');
        }

        $statutActivite = $request->input('statut_activite');
        $dateActivite = $request->input('date_activite');
        $jalonId = $request->input('jalon_id');

        // Filtrer les activités pour chaque jalon
        foreach ($projet->jalon as $jalon) {
            // Filtrage d'activités par statut
            if (!empty($statutActivite)) {
                $jalon->activite = $jalon->activite->where('statut_activite', $statutActivite);
            }

            // Filtrage d'activités par date
            if (!empty($dateActivite)) {
                $jalon->activite = $jalon->activite->sortBy(function ($activite) {
                    return $activite->date_debut;
                });

                if ($dateActivite === 'desc') {
                    $jalon->activite = $jalon->activite->reverse();
                }
            }

            // Filtrage par id de jalon si nécessaire
            if ($jalonId && $jalon->id != $jalonId) {
                // Ne pas afficher ce jalon si l'id ne correspond pas
                $jalon->activite = collect(); // Réinitialise les activités du jalon
            }
        }

        // Retourner la vue avec le projet et les jalons/activités filtrées
        return view('projet.profilProjet', compact('projet'));
    }
}
