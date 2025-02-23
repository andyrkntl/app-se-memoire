@extends('layouts.layouts')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Evaluation</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Evaluation</li>
        </ol>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex no-block">
            <form action="{{ route('evaluation.create') }}">
                @csrf
                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary">
                    Evaluer un projet
                </button>
            </form>
        </div>

        <div class="table-responsive m-t-20">
            <table id="example23" class="tablesaw table-striped table-hover table-bordered table" cellspacing="0" width="100%" role="grid">
                <thead>
                    <tr role="row">
                        <th>Chantier de réformes</th>
                        <th>Projet</th>
                        <th>Avancement en %</th>
                        <th>Problème de financement</th>
                        <th>Problème de coordination</th>
                        <th>Problème de passation de marché</th>
                        <th>Problème d'ordre juridique</th>
                        <th>Problème d'ordre technique</th>
                        <th>Problème sur le remplissage de source de vérification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evaluation as $eval)
                        <tr>
                            <td>{{ $eval->Nom_chantier }}</td>
                            <td>{{ $eval->Nom_projet }}</td>
                            <td>{{ $eval->Avancement }}%</td>
                            <td>{{ $eval->Pro1 }}</td>
                            <td>{{ $eval->Pro2 }}</td>
                            <td>{{ $eval->Pro3 }}</td>
                            <td>{{ $eval->Pro4 }}</td>
                            <td>{{ $eval->Pro5 }}</td>
                            <td>{{ $eval->Pro6 }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('evaluation.show', $eval->id) }}" method="GET">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-primary mx-2">
                                            <i class="ti-eye"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
