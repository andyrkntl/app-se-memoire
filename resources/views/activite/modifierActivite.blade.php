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
                <h4 class="m-b-0 text-white">Modifier une activité</h4>
            </div>
            <div class="card-body">
<form action="{{ route('activite.update', $activite->id) }}" method="POST" class="form-horizontal from-border">
    @method('PUT')
    @csrf
    <div class="form-body">
        <h3 class="box-title">Informations sur l'activité</h3>
        <hr class="m-t-0 m-b-40">

        <!-- Nom de l'activité -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Activité</label>
                    <div class="col-md-9">
                        <input type="text" name="Nom_activite" class="form-control" value="{{ $activite->Nom_activite }}">
                    </div>
                </div>
            </div>

            <!-- Statut -->
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Statut</label>
                    <div class="col-md-9">
                        <select name="Statut_activite" class="form-control">
                            <option value="En cours" {{ $activite->Statut_activite == 'En cours' ? 'selected' : '' }}>En cours</option>
                            <option value="Achevé" {{ $activite->Statut_activite == 'Achevé' ? 'selected' : '' }}>Achevé</option>
                            <option value="En retard" {{ $activite->Statut_activite == 'En retard' ? 'selected' : '' }}>En retard</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dates -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Date Début</label>
                    <div class="col-md-9">
                        <input type="date" name="Date_debut" class="form-control" value="{{ $activite->Date_debut }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Date Fin</label>
                    <div class="col-md-9">
                        <input type="date" name="Date_fin" class="form-control" value="{{ $activite->Date_fin }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Valeurs -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Valeur Cible</label>
                    <div class="col-md-9">
                        <textarea name="Valeur_cible" class="form-control">{{ $activite->Valeur_cible }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Valeur Actuelle</label>
                    <div class="col-md-9">
                        <textarea name="Valeur_actuel" class="form-control">{{ $activite->Valeur_actuel }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prochaines étapes -->
        <div class="row">
            <div class="col-md-10">
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Prochaines Étapes</label>
                    <div class="col-md-9">
                        <textarea name="Prochaine_etape" class="form-control">{{ $activite->Prochaine_etape }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <!-- Boutons -->
    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="offset-sm-3 col-md-9">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer les changements</button>
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
@endsection
