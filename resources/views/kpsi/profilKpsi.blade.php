@extends('layouts.layouts')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Indicateur</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Indicateur</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Détails de l'indicateur : {{ $kpsi->name }} </h4>
            </div>
            <div class="card-body">

                    <div class="form-body">
                            <div class="col-md-9">
                                <strong>Description :</strong>
                                 <p>{{ $kpsi->description }}</p>
                            </div>

                            <div class="col-md-9">
                                <strong>Ojectif :</strong>
                                <p>{{ $kpsi->target_value }}</p>
                            </div>

                            <div class="col-md-9">
                                <strong>Type :</strong>
                                <p>{{ $kpsi->type }}</p>
                            </div>

                            <div class="col-md-9">
                                <strong>Statut :</strong>
                                <p>{{ $kpsi->achieved }}</p>
                            </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="offset-sm-3 col-md-9">
                                        <a href="{{ route('kpsi.edit', $kpsi->id) }}" class="btn btn-secondary mt-3">Modifier</a>
                                        <a href="{{ route('kpsi.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
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
