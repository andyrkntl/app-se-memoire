@extends('layouts.layouts')


@section('content')
    <div class="container">
        <h2 class="mb-4">🧠 Synthèse par Gemini</h2>

        @if (isset($question))
            <p><strong>💬 Question posée :</strong> {{ $question }}</p>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                {!! nl2br(e($synthese)) !!}
            </div>
        </div>


        {{-- Bouton d’export Word --}}
        <form action="{{ route('export.word') }}" method="POST">
            @csrf
            <input type="hidden" name="synthese" value="{{ $synthese ?? '' }}">
            <input type="hidden" name="question" value="{{ $question ?? '' }}">
            <button type="submit" class="btn btn-success mb-4"><i class="fa-solid fa-file-export"></i> Exporter en
                Word</button>
        </form>

        <h4>Poser une autre question 👇</h4>
        <form method="POST" action="{{ url('/gemini-question') }}">
            @csrf
            <div class="form-group">
                <textarea name="question" class="form-control" rows="3" placeholder="Ex : Quels projets sont en retard ?"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Poser la question</button>
        </form>
    </div>
@endsection
