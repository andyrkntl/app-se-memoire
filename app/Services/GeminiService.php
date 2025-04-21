<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $certPath;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateContent';
        $this->certPath = storage_path('cacert.pem');
    }

    public function generate(string $prompt): string
    {
        $response = Http::withOptions([
            'verify' => $this->certPath,
        ])->post("{$this->baseUrl}?key={$this->apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Réponse vide';
        }

        return "Erreur : " . $response->body();
    }
}
