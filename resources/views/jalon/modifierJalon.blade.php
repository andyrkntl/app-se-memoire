@extends('layouts.layouts')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Jalon</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Jalon</li>
                <li class="breadcrumb-item active">Modifier un jalon</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-success">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Modifier un jalon</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jalon.update', $jalon->id) }}" method="POST"
                        class="form-horizontal form-bordered">
                        @method('PUT')
                        @csrf
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nom Jalon</label>
                                <div class="col-md-9">
                                    <input type="text" name="Nom_jalon" value="{{ old('Nom_jalon', $jalon->Nom_jalon) }}"
                                        required class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Statut Jalon</label>
                                <div class="col-md-9">
                                    <select name="Statut_jalon" class="form-control">
                                        <option value="En cours" {{ $jalon->Statut_jalon == 'En cours' ? 'selected' : '' }}>
                                            En cours</option>
                                        <option value="Achevé" {{ $jalon->Statut_jalon == 'Achevé' ? 'selected' : '' }}>
                                            Achevé</option>
                                        <option value="En retard"
                                            {{ $jalon->Statut_jalon == 'En retard' ? 'selected' : '' }}>En retard</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="Description">{{ old('Description', $jalon->Description) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Projet</label>
                                <div class="col-md-9">
                                    <select name="projet_id" class="form-control">
                                        @foreach ($projet as $p)
                                            <!-- Liste des projets disponibles -->
                                            <option value="{{ $p->id }}"
                                                {{ $jalon->projet_id == $p->id ? 'selected' : '' }}>
                                                {{ $p->Nom_projet }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="offset-sm-3 col-md-9">
                                            <a href="{{ route('jalon.index') }}" class="btn btn-secondary">Fermer</a>
                                            <button type="submit" class="btn btn-primary">Enregistrer les
                                                changements</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
