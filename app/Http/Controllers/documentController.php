<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Projet;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    //Affichage documents
    public function index(Request $request, $projet_id)
    {
        $projet = Projet::findOrFail($projet_id);

        // Récupérer les filtres depuis la requête (si présents)
        $type_docs_filter = $request->get('type_docs');
        $extension_filter = $request->get('extension');
        $search_filter = $request->get('search');

        // Construire la requête
        $documents = Document::where('projet_id', $projet_id)
            ->when($type_docs_filter, function ($query) use ($type_docs_filter) {
                return $query->where('type_docs', $type_docs_filter);
            })
            ->when($extension_filter, function ($query) use ($extension_filter) {
                return $query->whereRaw('LOWER(file_path) LIKE ?', ['%' . strtolower($extension_filter)]);
            })
            ->when($search_filter, function ($query) use ($search_filter) {
                return $query->where('nom_docs', 'like', '%' . $search_filter . '%');
            })
            ->paginate(10); // Limiter à 10 documents par page

        return view('documents.indexDocument', compact('projet', 'documents'));
    }




    //Ajout d'un document
    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'commentateur'])) {
            abort(403, 'Accès non autorisé.');
        }
        // Validation des champs
        $validated = $request->validate([
            'nom_docs' => 'required|string|max:255',
            'type_docs' => 'required|in:rapport,fiche de présence,livrable,compte rendu,manuel,autres',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240', // 10 Mo max
            'projet_id' => 'required|exists:projets,id',
        ]);

        // Stocker le fichier dans le dossier public "documents" et récupérer le chemin relatif
        $filePath = $request->file('file')->store('documents', 'public');

        // Créer le document
        Document::create([
            'nom_docs' => $validated['nom_docs'],
            'type_docs' => $validated['type_docs'],
            'projet_id' => $validated['projet_id'],
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Document ajouté avec succès.');
    }

    //modification document
    public function update(Request $request, Document $document)
    {
        if (!in_array(auth()->user()->role, ['admin', 'commentateur'])) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'nom_docs' => 'required|string|max:255',
            'type_docs' => 'required|in:rapport,fiche de présence,livrable,compte rendu,manuel,autres'
        ]);

        $document->update($validated);

        return redirect()->route('document.index', $document->projet_id)
            ->with('success', 'Document modifié avec succès');
    }

    //suppression document
    public function destroy(Document $document)
    {
        if (!in_array(auth()->user()->role, ['admin', 'commentateur'])) {
            abort(403, 'Accès non autorisé.');
        }
        Storage::delete($document->file_path);
        $document->delete();

        return redirect()->back()->with('success', 'Document supprimé avec succès');
    }
}
