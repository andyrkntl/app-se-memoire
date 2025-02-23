@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ajouter une nouvelle formulaire</h3>
    <form action="{{ route('formulaires.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom_chantier">Nom du Chantier</label>
            <input type="text" class="form-control" id="nom_chantier" name="nom_chantier" placeholder="Entrez le nom du chantier" required>
        </div>
        <div class="form-group">
            <label for="pourcentage_realisation">Pourcentage de Réalisation</label>
            <input type="number" class="form-control" id="pourcentage_realisation" name="pourcentage_realisation" placeholder="Entrez le pourcentage de réalisation" required>
        </div>
        <div class="form-group">
            <label for="commentaires">Commentaires</label>
            <textarea class="form-control" id="commentaires" name="commentaires" rows="4" placeholder="Ajoutez vos commentaires"></textarea>
        </div>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Fermer</button>
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </div>
    </form>
</div>
@endsection
