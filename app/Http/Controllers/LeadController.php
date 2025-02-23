<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lead = DB::table('leads')->get();

        return view('Lead.indexLead', [
            'lead' => $lead,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lead.ajoutLead');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lead = DB::table('leads')
            ->insert([
                'Nom_lead' => $request['Nom_lead'],
                'Poste' => $request['Poste'],
                'Contact' => $request['Contact'],
                'Email' => $request['Email'],
            ]);

        if ($lead) {
            return redirect()->route('lead.index')->with('success', 'Lead ajouté avec succès!');
        } else {
            return back()->with('error', 'Échec de l\'ajout du Lead. Veuillez réessayer.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return view('Lead.profilLead', [
            'lead' => $lead,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit(string $id)
    {
        // Recherche du lead par son ID
        $lead = Lead::find($id);

        if (!$lead) {
            return redirect()->route('lead.index')->with('error', 'Lead introuvable.');
        }

        // Retourner la vue avec le lead trouvé
        return view('lead.modifierLead', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'Nom_lead' => 'required|string',
            'Poste' => 'required|string',
            'Contact' => 'required|string',
            'Email' => 'required|email',
        ]);

        $lead = Lead::find($id);

        if (!$lead) {
            return redirect()->route('lead.index')->with('error', 'responsable introuvable');
        }

        $lead->update([
            'Nom_lead' => $validatedData['Nom_lead'],
            'Poste' => $validatedData['Poste'],
            'Contact' => $validatedData['Contact'],
            'Email' => $validatedData['Email'],

        ]);

        return redirect()->route('lead.index')->with('success', 'Votre modification a été enregistrée avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        if ($lead) {
            return redirect()->route('lead.index')->with('success', 'Lead supprimé avec succès!');
        } else {
            return back()->with('error', 'Échec de l\'ajout du Lead. Veuillez réessayer.');
        }
    }
}
