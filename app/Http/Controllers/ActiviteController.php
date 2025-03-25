<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Activite;
use App\Models\Jalon;
use Carbon\Carbon;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projet = DB::table('projets')->get();
        $jalon = DB::table('jalons')->get();
        $partie = DB::table('partie_prenantes')->get();
        $activite = DB::table('activites')
            ->join('jalons', 'jalons.id', '=', 'activites.jalon_id')
            ->join('projets', 'projets.id', '=', 'activites.projet_id')
            ->leftJoin('leads', 'leads.id', '=', 'projets.lead_id') // Jointure avec la table leads
            ->join('partie_prenantes', 'partie_prenantes.id', '=', 'projets.partiePrenante_id') // Jointure avec la table partie_prenantes
            ->leftJoin('chantiers', 'chantiers.id', '=', 'projets.chantier_id')
            ->select('jalons.*', 'leads.*', 'partie_prenantes.*', 'chantiers.*', 'projets.*', 'activites.*')
            ->get();

        if ($activite) {
            return view('activite.indexActivite', [
                'activite' => $activite,
                'projet' => $projet,
                'jalon' => $jalon,
                'partie' => $partie
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activite.ajoutActivite');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $activite = DB::table('activites')->insert([
            'projet_id' => $request[('projet_id')],
            'jalon_id' => $request[('jalon_id')],
            'Nom_activite' => $request[('Nom_activite')],
            'Description_activite' => $request[('Description_activite')],
            'Statut_activite' => $request[('Statut_activite')],
            'Valeur_cible' => $request[('Valeur_cible')],
            'Valeur_actuel' => $request[('Valeur_actuel')],
            'Date_debut' => $request[('Date_debut')],
            'Date_fin' => $request[('Date_fin')],
            'Prochaine_etape' => $request[('Prochaine_etape')],

        ]);

        if ($activite) {
            return redirect()->route('activite.index');
        }
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
            'statut_activite' => 'required|in:En cours,Achevé,En retard'
        ]);

        try {
            $activite->update([
                'nom_activite' => $validated['nom_activite'],
                'date_debut' => Carbon::createFromFormat('d/m/Y', $validated['date_debut']),
                'date_prevue' => Carbon::createFromFormat('d/m/Y', $validated['date_prevue']),
                'date_fin' => $validated['date_fin']
                    ? Carbon::createFromFormat('d/m/Y', $validated['date_fin'])
                    : null,
                'statut_activite' => $validated['statut_activite']
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
    public function destroy(Activite $activite)
    {
        if ($activite) {
            $activite->delete();
            return redirect()->route('activite.index')->with('success', 'Activité supprimée avec succès');
        }

        return redirect()->route('activite.index')->with('error', 'Activité introuvable');
    }
}
