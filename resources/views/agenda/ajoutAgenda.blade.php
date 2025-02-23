@extends('layouts.layouts')

@section('content')
<div class="container">
    <h2>Ajouter un nouvel événement</h2>
    <form action="{{ route('agenda.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="Objet_evenement">Objet de l'événement</label>
            <input type="text" class="form-control" id="Objet_evenement" name="Objet_evenement" required>
        </div>
        <div class="form-group">
            <label for="Debut_evenement">Début de l'événement</label>
            <input type="datetime-local" class="form-control" id="Debut_evenement" name="Debut_evenement" required>
        </div>
        <div class="form-group">
            <label for="Fin_evenement">Fin de l'événement</label>
            <input type="datetime-local" class="form-control" id="Fin_evenement" name="Fin_evenement" required>
        </div>
        <div class="form-group">
            <label for="type">Type d'événement</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="form-group">
            <label for="Statut_evenement">Statut de l'événement</label>
            <input type="text" class="form-control" id="Statut_evenement" name="Statut_evenement" required>
        </div>
        <div class="form-group">
            <label for="Commentaires_evenement">Commentaires</label>
            <textarea class="form-control" id="Commentaires_evenement" name="Commentaires_evenement"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
