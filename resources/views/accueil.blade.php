@extends('layouts.layouts')

@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v21.0&appId=1326305115204042"></script>
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Accueil</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Accueil</li>
            </ol>
        </div>
        {{-- <div class="col-md-6 col-4 align-self-center">
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-info d-none d-lg-block m-l-15">
                    <i class="fa fa-plus-circle"></i> Nouvelle Activité
                </a>
                <a href="#" class="btn btn-info d-none d-lg-block m-l-15">
                    <i class="fa fa-plus-circle"></i> Formulaire de suivi
                </a>
            </div>
        </div> --}}
    </div>
    @include('dashboard.cardDashboard')

    @include('dashboard.burndownChart')





    <div class="row">
        <!-- Dernière actualité -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="text-white">Dernières Actualités</h4>
                </div>
                <div class="card-body">

                    @if (isset($dernieresActualites) && count($dernieresActualites) > 0)
                        <ul class="list-group">
                            @foreach ($dernieresActualites as $actualite)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $actualite['titre'] }}</span>
                                    <span class="badge badge-info badge-pill">{{ $actualite['date'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="fb-page" data-href="https://www.facebook.com/communication.prea" data-tabs="timeline"
                            data-width="1100" data-height="800" data-small-header="false" data-adapt-container-width="true"
                            data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/communication.prea" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/communication.prea">PREA Communication</a>
                            </blockquote>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
