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
        <div class="col-md-6 col-4 align-self-center">
            <div class="d-flex justify-content-end">
                <a href="{{ route('activite.index') }}" class="btn btn-info d-none d-lg-block m-l-15">
                    <i class="fa fa-plus-circle"></i> Nouvelle Activité
                </a>
                <a href="{{ route('formulaires.create') }}" class="btn btn-info d-none d-lg-block m-l-15">
                    <i class="fa fa-plus-circle"></i> Formulaire de suivi
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Statistiques -->
        @php
            $stats = [
                [
                    'icon' => 'ti-pie-chart',
                    'value' => $totalChantier ?? '4',
                    'label' => 'Total Chantiers',
                    'bg' => 'bg-info',
                ],
                [
                    'icon' => 'ti-time',
                    'value' => $activitesEnCours ?? '3',
                    'label' => 'Activités en Cours',
                    'bg' => 'bg-warning',
                ],
                [
                    'icon' => 'ti-check-box',
                    'value' => $activitesRealisees ?? '1',
                    'label' => 'Activités Réalisées',
                    'bg' => 'bg-success',
                ],
                [
                    'icon' => 'ti-close',
                    'value' => $activitesNonRealisees ?? '1',
                    'label' => 'Activités Non Réalisées',
                    'bg' => 'bg-danger',
                ],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div class="m-r-10"><i
                                    class="{{ $stat['icon'] }} text-white {{ $stat['bg'] }} p-3 rounded-circle"></i></div>
                            <div>
                                <h3 class="m-b-0">{{ $stat['value'] }}</h3>
                                <span class="text-muted">{{ $stat['label'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <!-- Graphique en secteurs pour les statuts des chantiers -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="text-white">Statut des Chantiers</h4>
                </div>
                <div class="card-body">
                    <canvas id="chantierStatusChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique en barres pour les activités -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="text-white">Activités par Statut</h4>
                </div>
                <div class="card-body">
                    <canvas id="activiteStatusChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <!-- Dernière actualité -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="text-white">Dernières Actualités</h4>
                </div>
                <div class="card-body ">

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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Données pour le graphique en secteurs des statuts des chantiers
        const chantierStatusData = {
            labels: ['En Cours', 'Achevés', 'En Attente'],
            datasets: [{
                data: [{{ $activitesEnCours ?? 3 }}, {{ $activitesRealisees ?? 1 }},
                    {{ $activitesNonRealisees ?? 1 }}
                ],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'],
            }]
        };

        // Données pour le graphique en barres des activités
        const activiteStatusData = {
            labels: ['En Cours', 'Achevées', 'Non Réalisées'],
            datasets: [{
                label: 'Activités',
                data: [{{ $activitesEnCours ?? 3 }}, {{ $activitesRealisees ?? 1 }},
                    {{ $activitesNonRealisees ?? 1 }}
                ],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'],
            }]
        };

        // Configuration des graphiques
        const chantierStatusConfig = {
            type: 'pie',
            data: chantierStatusData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Statut des Chantiers'
                    }
                }
            },
        };

        const activiteStatusConfig = {
            type: 'bar',
            data: activiteStatusData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: 'Activités par Statut'
                    }
                }
            },
        };

        // Initialisation des graphiques
        const chantierStatusChart = new Chart(
            document.getElementById('chantierStatusChart'),
            chantierStatusConfig
        );

        const activiteStatusChart = new Chart(
            document.getElementById('activiteStatusChart'),
            activiteStatusConfig
        );
    </script>
@endsection
