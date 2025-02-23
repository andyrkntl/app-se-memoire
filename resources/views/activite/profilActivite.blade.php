@extends('layouts.layouts')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Tableau de bord par activité</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Tableau de bord par activité</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Détails activité</h4>
                </div>
                <div class="card-body">
                    <form action="#" class="form-horizontal">
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Activite</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                value="{{ $activite->Nom_activite }}">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Statut</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                value="{{ $activite->Statut_activite }}">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>


                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Date Debut</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" value="{{ $activite->Date_debut }}">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Date fin</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" value="{{ $activite->Date_fin }}">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Valeur Cible</label>
                                        <div class="col-md-9">
                                            <textarea name="" class="form-control" multiple="">{{ $activite->Valeur_cible }}</textarea>

                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Valeur Actuel</label>
                                        <div class="col-md-9">
                                            <textarea name="" class="form-control" multiple="">{{ $activite->Valeur_actuel }}</textarea>
                                        </div>
                                    </div>
                                </div> <!--/span-->
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Prochaines Etapes</label>
                                        <div class="col-md-9">
                                            <textarea name="" class="form-control" multiple="">{{ $activite->Prochaine_etape }}</textarea>

                                        </div>
                                    </div>
                                </div>

                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                        <hr>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="offset-sm-3 col-md-9">
                                            <a href="{{ route('activite.edit', $activite->id) }}" class="btn btn-success">
                                                <i class="fa fa-pencil-square-o"></i> Modifier</a>

                                            <a href="{{ route('activite.index') }}" class="btn btn-inverse">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
