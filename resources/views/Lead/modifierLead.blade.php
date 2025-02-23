@extends('layouts.layouts')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Responsable</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Responsable</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Informations sur le responsabble

                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('lead.update', $lead->id) }}" method="POST"
                        class="form-horizontal form-bordered">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nom responsable</label>
                                <div class="col-md-9">
                                    <input type="text" name="Nom_lead" value="{{ $lead->Nom_lead }}"
                                        class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Contact</label>
                                <div class="col-md-9">
                                    <input type="text" name="Contact" value="{{ $lead->Contact }}" class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Poste</label>
                                <div class="col-md-9">
                                    <input type="text" name="Poste" value="{{ $lead->Poste }}" class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input type="text" name="Email" value="{{ $lead->Email }}" class="form-control">
                                    <small class="form-control-feedback"> </small>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="offset-sm-3 col-md-9">
                                            <button type="submit" class="btn btn-success"> <i
                                                    class="fa fa-pencil-square-o"> </i> Enregistrer les changements</button>
                                            <button type="button" class="btn btn-inverse">Annuler</button>
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
