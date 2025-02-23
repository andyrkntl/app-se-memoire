@extends('layouts.layouts')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Partie Prenante</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Partie Prenante</li>
                <li class="breadcrumb-item active">Modifier une partie prenante</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-success">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Modifier une partie prenante</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('partiePrenante.update', $partieprenante->id) }}" method="POST"
                        class="form-horizontal from-border">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nom Partie prenante</label>
                                <div class="col-md-9">
                                    <input type="text" name="Nom_partie" value="{{ $partieprenante->Nom_partie }}"
                                        class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Acronyme</label>
                                <div class="col-md-9">
                                    <input type="text" name="Acronyme" value="{{ $partieprenante->Acronyme }}"
                                        class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Type</label>
                                <div class="col-md-9">
                                    <input type="text" name="Type" value="{{ $partieprenante->Type }}"
                                        class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Contact</label>
                                <div class="col-md-9">
                                    <input type="text" name="Contact" value="{{ $partieprenante->Contact }}"
                                        class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="offset-sm-3 col-md-9">
                                            <a href="{{ route('partiePrenante.index') }}"
                                                class="btn btn-secondary">Fermer</a>
                                            <button type="submit" class="btn btn-success">Enregistrer les
                                                modifications</button>
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
