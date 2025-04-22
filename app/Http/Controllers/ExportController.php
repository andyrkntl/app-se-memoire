<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $synthese = $request->input('synthese', 'Pas de synthèse fournie.');
        $question = $request->input('question', '');

        // On prépare les données à envoyer dans la vue PDF
        $data = [
            'question' => $question,
            'synthese' => $synthese,
        ];

        // On génère le PDF à partir d'une vue Blade
        $pdf = Pdf::loadView('gemini.pdf_synthese', $data);

        $fileName = 'synthese_gemini_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }
}
