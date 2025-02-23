@extends('layouts.layouts')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Indicateur</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Indicateur</li>
            <li class="breadcrumb-item active">Modifier un indicateur</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-success">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Modifier l'indicateur : {{ $kpsi->name }} </h4>
            </div>
            <div class="card-body">
                <form action="{{route('kpsi.update', $kpsi->id)}}" method="POST" class="form-horizontal form-bordered">
                    @method('PUT')
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Nom</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $kpsi->name }}" required >
                                <small class="form-control-feedback"> </small> </div>
                        </div>


                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Description</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $kpsi->description }}" required >
                                <small class="form-control-feedback"> </small> </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Objectif</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $kpsi->target_value }}" required >
                                <small class="form-control-feedback"> </small> </div>
                        </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Type</label>
                                <div class="col-md-9">
                                <select class="form-control" id="type" name="type" required>
                                    <option value="qualitatif" {{ $kpsi->type == 'qualitatif' ? 'selected' : '' }}>Qualitatif</option>
                                    <option value="quantitatif" {{ $kpsi->type == 'quantitatif' ? 'selected' : '' }}>Quantitatif</option>
                                </select>
                            </div>
                        </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Statut</label>
                                <div class="col-md-9">
                                <select class="form-control" id="statut" name="statut" required>
                                    <option value="atteint" {{ $kpsi->statut == 'atteint' ? 'selected' : '' }}>Atteint</option>
                                    <option value="non_atteint" {{ $kpsi->statut == 'non_atteint' ? 'selected' : '' }}>Non atteint</option>
                                </select>
                                </div>
                             </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="offset-sm-3 col-md-9">

                                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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

