<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Activite;

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
    public function show(string $id)
    {
        // Récupérer l'activité par son ID
        $activite = Activite::findOrFail($id);




        $activite = DB::table('activites')

            ->join('jalons', 'jalons.id', '=', 'activites.jalon_id')
            ->join('projets', 'projets.id', '=', 'activites.projet_id')
            ->leftJoin('leads', 'leads.id', '=', 'projets.lead_id') // Jointure avec la table leads
            ->leftJoin('partie_prenantes', 'partie_prenantes.id', '=', 'projets.partiePrenante_id') // Jointure avec la table partie_prenantes
            ->leftJoin('chantiers', 'chantiers.id', '=', 'projets.chantier_id')

            ->select('jalons.*', 'leads.*', 'partie_prenantes.*', 'chantiers.*', 'projets.*', 'activites.*')
            ->where('activites.id', $id)
            ->first();

        return view('activite.profilActivite', compact('activite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activite = activite::find($id);

        if (!$activite) {
            return redirect()->route('activite.index')->with('error', 'activite introuvable');
        }

        return view('activite.modifierActivite', compact('activite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Nom_activite' => 'required|string|max:50',
            'Statut_activite' => 'nullable|string|in:En cours,Achevé,En retard',
            'Date_debut' => 'required|date',
            'Date_fin' => 'required|date|after_or_equal:Debut_evenement',
            'Valeur_cible' => 'required|string',
            'Valeur_actuel' => 'required|string',
            'Prochaine_etape' => 'nullable|string',
        ]);
        $activite = activite::find($id);

        if (!$activite) {
            return redirect()->route('activite.index')->with('error', 'activite introuvable');
        }

        $activite->update([
            'Nom_activite' => $validatedData['Nom_activite'],
            'Statut_activite' => $validatedData['Statut_activite'],
            'Date_debut' => $validatedData['Date_debut'],
            'Date_fin' => $validatedData['Date_fin'],
            'Valeur_cible' => $validatedData['Valeur_cible'],
            'Valeur_actuel' => $validatedData['Valeur_actuel'],
            'Prochaine_etape' => $validatedData['Prochaine_etape'],
        ]);

        return redirect()->route('activite.index')->with('success', 'Votre modification a été enregistrée avec succès.');
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
