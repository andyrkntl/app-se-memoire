<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Synthèse Gemini</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
        }

        .question {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .synthese {
            white-space: pre-wrap;
            /* Conserve les sauts de ligne */
        }
    </style>
</head>

<body>
    @if (!empty($question))
        <p class="question"> Question posée : {{ $question }}</p>
    @endif

    <p class="synthese">{{ $synthese }}</p>
</body>

</html>
