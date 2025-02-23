@extends('layouts.layouts')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Jalon</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Jalon</li>
                <li class="breadcrumb-item active">Détails d'un jalon</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Détail d'un jalon</h4>
                </div>
                <div class="card-body">
                    <form action="#" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nom Jalon</label>
                                <div class="col-md-9">
                                    <input type="text" name="Nom_activite" value="{{ $jalon->Nom_jalon }}"
                                        class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Statut Jalon</label>
                                <div class="col-md-9">
                                    <select id=""name="Statut_activite" value="{{ $jalon->Statut_jalon }}"
                                        class="form-control">>
                                        <option value="">En cours</option>
                                        <option value="">Achevé</option>
                                        <option value="">En retard</option>


                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="Description_activite" value="{{ $jalon->Description }}">{{ $jalon->Description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Projet</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="Projet" value="{{ $jalon->Projet }}">{{ $jalon->Projet }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="offset-sm-3 col-md-9">
                                            <a href="{{ route('jalon.edit', $jalon->id) }}" class="btn btn-success"> <i
                                                    class="fa fa-pencil-square-o"></i> Modifier</a>

                                            <a href="{{ route('jalon.index') }}" class="btn btn-inverse">Cancel</a>
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
