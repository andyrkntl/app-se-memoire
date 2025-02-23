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
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">

            </div>
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">


            </div>

        </div>
    </div>
</div>


    <!-- Column
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="../assets/images/users/5.jpg" class="img-circle" width="150">
                    <h4 class="card-title m-t-10">Rado</h4>
                    <h6 class="card-subtitle">Directeur de réformes</h6>
                </center>
            </div>
        <div class="card-body">
            <div class="row text-center justify-content-md-center">
                <div class="col-2"><a href="#" class="whatsapp"><i class="fa fa-whatsapp"></i></a></div>
                <div class="col-2"><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></div>
                <div class="col-2"> <a href="#" class="gmail"><i class="fa fa-envelope"></i></a></div>
            </div>
        </div>
        </div>
    </div>
     -->
    <!-- Column -->


    <div class="card">
        <div class="card-body">
            <div class="d-flex no-block">
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class=""></i> Ajouter un indicateur
                </button>

            </div>
            <div class="table-responsive m-t-20">
                <table id="example23" class="tablesaw table-striped table-hover table-bordered table tablesaw-columntoggle" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">



                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 135px;" aria-sort="ascending" aria-label="Office: activate to sort column ascending">ID</th>
                                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 66px;"  aria-label="Age: activate to sort column ascending">Nom </th>
                                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 117px;"  aria-label="Start date: activate to sort column ascending">Description</th>
                                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 117px;" aria-label="Start date: activate to sort column ascending">Objectif</th>
                                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 117px;" aria-label="Start date: activate to sort column ascending">Type</th>
                                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 117px;" aria-label="Start date: activate to sort column ascending">Statut</th>
                                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" style="width: 117px;" aria-label="Start date: activate to sort column ascending">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kpsis as $kpsi)
                            <tr class="align-items-center">
                                <td>{{ $kpsi->id }}</td>
                                <td>{{ $kpsi->name }}</td>
                                <td>{{ $kpsi->description }}</td>
                                <td>{{ $kpsi->target_value }}</td>

                                <!-- Ajouter le type d'indicateur -->
                                <td>{{ $kpsi->type }}</td> <!-- Qualitatif ou Quantitatif -->

                                <!-- Ajouter un champ pour l'objectif atteint -->
                                <td>
                                    @if($kpsi->achieved)
                                        <span class="badge badge-success">Atteint</span>
                                    @else
                                        <span class="badge badge-danger">Non atteint</span>
                                    @endif
                                </td>

                                <!-- Actions pour afficher et supprimer -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('kpsi.show', $kpsi->id) }}" method="GET">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="bt btn-primary mx-2">
                                                <i class="ti-eye"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('kpsi.destroy', $kpsi->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bt btn-danger mx-2">
                                                <i class="mdi mdi-delete-empty"></i>
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
    </div>





@include('kpsi.ajoutKpsi')


@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: 'fermer'
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: 'fermer'
            });
        @endif
    });
</script>

