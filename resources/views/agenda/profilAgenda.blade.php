@extends('layouts.layouts')

@section('content')
<div class="container">
    <h2>Détails de l'événement</h2>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $evenement->Objet_evenement }}</h3>
            <p><strong>Début :</strong> {{ \Carbon\Carbon::parse($evenement->Debut_evenement)->format('d/m/Y H:i') }}</p>
            <p><strong>Fin :</strong> {{ \Carbon\Carbon::parse($evenement->Fin_evenement)->format('d/m/Y H:i') }}</p>
            <p><strong>Type :</strong> {{ $evenement->type }}</p>
            <p><strong>Statut :</strong> {{ ucfirst($evenement->Statut_evenement) }}</p>
            <p><strong>Commentaires :</strong> {{ $evenement->Commentaires_evenement }}</p>
            <a href="{{ route('agenda.edit', $evenement->id) }}" class="btn btn-warning btn-sm">Modifier</a>
            <form action="{{ route('agenda.destroy', $evenement->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
