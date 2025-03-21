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
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary" data-toggle="modal"
                    data-target="#exampleModal">
                    <i class=""></i> Ajouter un chantier
                </button>

            </div>
            {{-- <div class="table-responsive m-t-20">
                <table id="example23" class="tablesaw table-striped table-hover table-bordered table tablesaw-columntoggle"
                    cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">



                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example23" rowspan="1" colspan="1"
                                style="width: 135px;" aria-sort="ascending"
                                aria-label="Office: activate to sort column ascending">Chantier</th>
                            <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1"
                                style="width: 66px;" aria-label="Age: activate to sort column ascending">Responsable</th>
                            <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1"
                                style="width: 117px;" aria-label="Start date: activate to sort column ascending">Description
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1"
                                style="width: 66px;" aria-label="Age: activate to sort column ascending">Objectif</th>
                            <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1"
                                style="width: 66px;" aria-label="Age: activate to sort column ascending">Situation Actuelle
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1"
                                style="width: 66px;" aria-label="Age: activate to sort column ascending">Prochaines étapes
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1"
                                style="width: 117px;" aria-label="Start date: activate to sort column ascending">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chantier as $chantier)
                            <tr class=" align-items-center">

                                <td>{{ $chantier->Nom_chantier }}</td>
                                <td>{{ $chantier->Nom_responsable }}</td>
                                <td>{{ $chantier->Description }}</td>

                                <td>{{ $chantier->Objectif }}</td>
                                <td>{{ $chantier->Situation_actuelle }}</td>
                                <td>{{ $chantier->Prochaines_etapes }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <form class="" action="{{ route('chantier.show', $chantier->id) }}"
                                            method="GET">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="bt btn-primary mx-2">
                                                <i class="ti-eye"></i>
                                            </button>
                                        </form>

                                        <form class="" action="{{ route('chantier.destroy', $chantier->id) }}"
                                            method="POST">
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
            </div> --}}




            <div class="row g-4">
                @foreach ($chantier as $chantier)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 animate__animated animate__zoomIn animate__delay-1s">
                            <img src="/image/prea.png"
                                class="card-img-top animate__animated animate__fadeInUp animate__delay-1s" alt="Logo PREA">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title animate__animated animate__fadeIn animate__delay-2s">
                                    {{ $chantier->Nom_chantier }}
                                </h5>
                                <p class="card-text text-muted animate__animated animate__fadeIn animate__delay-2s">
                                    {{ $chantier->Description }}</p>
                                <div class="mt-auto">
                                    <p class="fw-bold mb-1 animate__animated animate__fadeInUp animate__delay-3s">
                                        Responsable : <span class="text-success">{{ $chantier->Nom_responsable }} </span>
                                    </p>
                                    <p class="card-text animate__animated animate__fadeInUp animate__delay-3s">Taux
                                        avancement :
                                    <h5>35%</h5>
                                    </p>
                                    <a href="#"
                                        class="btn btn-primary btn-sm mt-2 animate__animated animate__pulse animate__infinite">Statut
                                        : en cours</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



        </div>





    </div>
    </div>





    @include('chantier.ajoutChantier')
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: 'fermer'
            });
        @elseif (session('error'))
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
