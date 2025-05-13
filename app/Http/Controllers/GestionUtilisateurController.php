<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class GestionUtilisateurController extends Controller
{
    public function index(Request $request)
    {
        $utilisateurs = User::select('id', 'name', 'email', 'role')->paginate(2); // ← ajout 'id'
        return view('administrateur.indexUtilisateur', compact('utilisateurs'));
    }



    public function update(Request $request, User $utilisateur)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        if ($utilisateur->id == auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas vous modifier vous-même.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:191|unique:users,email,' . $utilisateur->id,
            'role' => 'required|in:admin,lecteur,commentateur',
        ]);

        $utilisateur->update($request->only('name', 'email', 'role'));

        return redirect()->route('utilisateur.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $utilisateur)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        if ($utilisateur->id == auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas vous supprimer vous-même.');
        }

        $utilisateur->delete();

        return redirect()->route('utilisateur.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
