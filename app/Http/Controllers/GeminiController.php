<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GeminiDataController;
use Illuminate\Support\Facades\Http;
use Smalot\PdfParser\Parser;

class GeminiController extends Controller
{
    private $apiKey = 'AIzaSyDiaTtfRUMp1Du_fWlO50jU6JMT-x0ZC0o';
    private $model = 'models/gemini-1.5-pro'; // modèle valide

    private function callGemini($prompt)
    {
        $response = Http::withOptions([
            'verify' => storage_path('cacert.pem'),
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key={$this->apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? ' Erreur de réponse Gemini';
    }

    public function synthese()
    {

        set_time_limit(300); // 300 secondes = 5 minutes

        $dataController = new GeminiDataController();
        $data = $dataController->collectData()->getData();

        // Lire le plan stratégique PDF
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/plan/ps_prea.pdf'));
        $pdfText = $pdf->getText();

        // Construire le prompt
        $prompt = "Voici les données d'une application Laravel de suivi de chantiers et projets :\n\n" . $data->rapport;
        $prompt .= "\n\nVoici également un extrait du plan stratégique PREA à utiliser comme référence :\n\n";
        $prompt .= substr($pdfText, 0, 50000); // On limite à 5000 caractères pour éviter que Gemini dépasse

        $prompt .= "\n\nPeux-tu me faire une synthèse intelligente (comme un rapport d'activités de tous les chantiers de réforme de PREA) qui combine les données de projet et les orientations du plan stratégique PREA ?";

        $synthese = $this->callGemini($prompt);

        return view('gemini.synthese', compact('synthese'));
    }

    public function question(Request $request)
    {

        set_time_limit(300); // 300 secondes = 5 minutes

        $dataController = new GeminiDataController();
        $data = $dataController->collectData()->getData();

        // Lire le plan stratégique PDF
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/plan/ps_prea.pdf'));
        $pdfText = $pdf->getText();


        $question = $request->input('question');

        $prompt = "Voici les données de mon application Laravel de gestion de chantiers :\n\n" . $data->rapport;
        $prompt .= "\n\nVoici un extrait du plan stratégique PREA :\n\n" . substr($pdfText, 0, 50000);
        $prompt .= "\n\nVoici la question : {$question}";


        $reponse = $this->callGemini($prompt);

        return view('gemini.synthese', [
            'synthese' => $reponse,
            'question' => $question
        ]);
    }
}
