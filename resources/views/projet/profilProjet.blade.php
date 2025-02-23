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
                <h4 class="m-b-0 text-white">With Border at Bottom (<small>Use class form-bordered</small>)</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" class="form-horizontal form-bordered">
                    @method('PUT')
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Nom Projet</label>
                            <div class="col-md-9">
                                <input type="text" name="Nom_activite" value="{{$projet->Nom_projet}}" class="form-control">
                                <small class="form-control-feedback"> </small> </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Duree</label>
                            <div class="col-md-9">
                                <input type="text" name="Duree_projet" value="{{$projet->Duree_projet ?? 'pas de partie  correspendant'}}" class="form-control">
                                <small class="form-control-feedback"> </small> </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Statut</label>
                            <div class="col-md-9">
                                <input type="text" name="statut" value="{{$projet->statut ?? 'pas de partie  correspendant'}}" class="form-control">
                                <small class="form-control-feedback"> </small> </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Objectif</label>
                            <div class="col-md-9">
                                <input type="text" name="statut" value="{{$projet->Objectif ?? 'pas de partie  correspendant'}}" class="form-control">
                                <small class="form-control-feedback"> </small> </div>
                        </div>




                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Lead</label>
                            <div class="col-md-9">
                                <input type="text" name="Objectif" value="{{$projet->Nom_lead ?? 'pas de partie  correspendant'}}" class="form-control">
                                <small class="form-control-feedback"> </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Point Focal</label>
                            <div class="col-md-9">
                                <input type="text" name="PF" value="{{$projet->PF ?? 'pas de partie  correspendant'}}" class="form-control">
                                <small class="form-control-feedback"> </small> </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Chantier</label>
                            <div class="col-md-9">
                                <input type="text" name="Objectif" value="{{ $projet->Nom_chantier ?? 'pas de partie  correspendant'}}" class="form-control">
                                <small class="form-control-feedback"> </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Partie Prenante</label>
                            <div class="col-md-9">
                                <input type="text" name="Objectif" value="{{ $projet->Nom_partie ?? 'pas de partie  correspendant'}}" class="form-control">
                                <small class="form-control-feedback"> </small>
                            </div>
                        </div>




                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="Description_projet" value="{{$projet->Description_projet }}">{{$projet->Description_projet ?? 'pas de partie  correspendant'}}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="offset-sm-3 col-md-9">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-pencil-square-o">  </i>   Modifier</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
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

