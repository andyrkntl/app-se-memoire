@extends('layouts.layouts')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Chantier</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Chantier</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Détail chantier</h4>
                </div>
                <div class="card-body">
                    <form action="#" class="form-horizontal form-bordered">

                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nom chantier</label>
                                <div class="col-md-9">
                                    <input type="text" value="{{ $chantier->Nom_chantier }}" class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nom Responsable</label>
                                <div class="col-md-9">
                                    <input type="text" value="{{ $chantier->Nom_responsable }}" class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Description</label>
                                <div class="col-md-9">
                                    <input type="text" value="{{ $chantier->Description }}" class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Objectif</label>
                                <div class="col-md-9">
                                    <input type="text"value="{{ $chantier->Objectif }}" required class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Situation actuelle</label>
                                <div class="col-md-9">
                                    <input type="text" value="{{ $chantier->Situation_actuelle }}" class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Prochaines étapes</label>
                                <div class="col-md-9">
                                    <input type="text" value="{{ $chantier->Prochaines_etapes }}" class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>



                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="offset-sm-3 col-md-9">
                                            <a href="{{ route('chantier.edit', $chantier->id) }}" class="btn btn-success">
                                                <i class="fa fa-pencil-square-o"></i> Modifier</a>

                                            <a href="{{ route('chantier.index') }}" class="btn btn-inverse">Cancel</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
