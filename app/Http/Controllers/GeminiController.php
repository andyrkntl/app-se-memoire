<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GeminiDataController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Smalot\PdfParser\Parser;

class GeminiController extends Controller
{
    private $apiKey = 'AIzaSyDLQHOvyXSmg87z3u7PtCLvVwBHIRSOj_U';
    private $model = 'models/gemini-1.5-pro';

    private function callGemini($prompt)
    {
        try {
            $response = Http::withOptions([
                'verify' => storage_path('cacert.pem'),
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            // Log de la requête et de la réponse pour débogage
            Log::info('Requête envoyée à Gemini : ', [
                'url' => "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent",
                'payload' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]
            ]);
            Log::info('Réponse de Gemini : ', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    return $data['candidates'][0]['content']['parts'][0]['text'];
                } else {
                    Log::error('Réponse inattendue de Gemini : ' . json_encode($data));
                    return 'Erreur : Réponse inattendue de Gemini.';
                }
            } else {
                Log::error('Erreur HTTP Gemini : ' . $response->status() . ' - ' . $response->body());
                return 'Erreur : Problème de communication avec l\'API Gemini.';
            }
        } catch (\Exception $e) {
            Log::error('Exception lors de l\'appel à Gemini : ' . $e->getMessage());
            return 'Erreur : Une exception s\'est produite lors de l\'appel à Gemini.';
        }
    }

    public function synthese()
    {

        set_time_limit(350); // 300 secondes = 5 minutes

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

        $prompt .= "\n\nAgis en tant qu'assistant expert en analyse de données et en reporting stratégique. Sur la base des données d'activité de l'application de suivi et d'évaluation des chantiers de reforme de l'administration malagasy et du document PDF contenant le plan stratégique de PREA, génère un rapport d'activités intelligent pour les chantiers de réforme de PREA.

                        Ce rapport doit :

                        1.  **Synthétiser les principales réalisations et l'avancement** de chaque chantier de réforme, en utilisant les données de l'application.
                        2.  **Évaluer la contribution de chaque chantier** aux objectifs et orientations stratégiques définis dans le plan stratégique. Indique clairement comment les activités menées s'alignent ou contribuent à la réalisation des priorités stratégiques.
                        3.  **Identifier les points saillants, les succès et les défis** rencontrés pour chaque chantier, en te basant sur les données disponibles.
                        4.  **Fournir une vue d'ensemble synthétique** de l'avancement global des réformes par rapport au plan stratégique.
                        5.  ** Suggérer des recommandations** ou des points d'attention pour les prochaines étapes, en tenant compte des données et du plan stratégique, soyez direct et donner des solutions concrètes et palpables.

                        Assure-toi que le rapport est clair, concis et met en évidence les liens entre les activités opérationnelles et les objectifs stratégiques de PREA.";

        $synthese = $this->callGemini($prompt);

        return view('gemini.synthese', compact('synthese'));
    }

    public function question(Request $request)
    {

        set_time_limit(350); // 300 secondes = 5 minutes

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
