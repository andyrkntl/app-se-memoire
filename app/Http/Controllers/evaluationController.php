<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Evaluation;

class evaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $evaluation = DB::table('evaluations')
        ->join('activites', 'activites.id', '=', 'evaluations.activite_id')
        ->leftJoin('projets', 'projets.id', '=', 'activites.projet_id')
        ->leftJoin('leads', 'leads.id', '=', 'projets.lead_id') // Jointure avec la table leads
        ->leftJoin('partie_prenantes', 'partie_prenantes.id', '=', 'projets.partiePrenante_id') // Jointure avec la table partie_prenantes
        ->leftJoin('chantiers', 'chantiers.id', '=', 'projets.chantier_id')
        ->leftJoin('jalons', 'jalons.id', '=', 'activites.jalon_id')
        ->select('partie_prenantes.*', 'chantiers.*', 'leads.*', 'projets.*', 'jalons.*', 'activites.*', 'evaluations.*')
        ->get();

    return view('evaluation.indexEvaluation', [
        'evaluation' => $evaluation,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activite = DB::table('activites')->get();
    $chantier = DB::table('chantiers')->get(); // Récupérer les chantiers

    return view('evaluation.ajoutEvaluation', [
        'activite' => $activite,
        'chantier' => $chantier, // Transmettre les chantiers à la vue
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $evaluation=DB::table('evaluations')->insert([
            'activite_id' => $request['activite_id'],
            'Avancement' => $request['Avancement'],
            'Pro1' => $request['Pro1'],
            'Pro2' => $request['Pro2'],
            'Pro3' => $request['Pro3'],
            'Pro4' => $request['Pro4'],
            'Pro5' => $request['Pro5'],
            'Pro6' => $request['Pro6'],
            'Autres' => $request['Autres'],
        ]);

        if($evaluation){
            return redirect()->route('evaluation.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evaluation=DB::table('evaluations')
        ->join('activites','activites.id','=','evaluations.activite_id')
        ->leftjoin('projets', 'projets.id', '=', 'activites.projet_id')
            ->leftJoin('leads', 'leads.id', '=', 'projets.lead_id') // Jointure avec la table leads
            ->leftJoin('partie_prenantes', 'partie_prenantes.id', '=', 'projets.partiePrenante_id') // Jointure avec la table partie_prenantes
            ->leftJoin('chantiers', 'chantiers.id', '=', 'projets.chantier_id')
        ->leftjoin('jalons', 'jalons.id', '=', 'activites.jalon_id')
        ->where('evaluations.id',$id)
        ->select('partie_prenantes.*','chantiers.*','leads.*','projets.*','jalons.*','activites.*','evaluations.*')
            ->first();

            return view('evaluation.profilEvaluation',[
                'evaluation'=>$evaluation,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evaluation=DB::table('evaluations')
            ->where('evaluations.id',$id)
            ->delete();

            return back();
    }
}
