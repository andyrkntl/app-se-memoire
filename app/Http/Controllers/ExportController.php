<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class ExportController extends Controller
{
    public function exportWord(Request $request)
    {
        $synthese = $request->input('synthese', 'Pas de synthèse fournie.');
        $question = $request->input('question', '');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();

        if (!empty($question)) {
            $section->addText('Question posée :', ['bold' => true]);
            $section->addText(html_entity_decode(strip_tags($question)));
            $section->addTextBreak();
        }

        $section->addText(' Synthèse :', ['bold' => true]);
        $section->addText(html_entity_decode(strip_tags($synthese)));

        $fileName = 'synthese_gemini_' . now()->format('Ymd_His') . '.docx';
        $filePath = storage_path("app/{$fileName}");

        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
