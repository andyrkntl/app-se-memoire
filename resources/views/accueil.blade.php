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
                <a href="#" class="btn btn-info d-none d-lg-block m-l-15">
                    <i class="fa fa-plus-circle"></i> Nouvelle Activité
                </a>
                <a href="#" class="btn btn-info d-none d-lg-block m-l-15">
                    <i class="fa fa-plus-circle"></i> Formulaire de suivi
                </a>
            </div>
        </div>
    </div>
    @include('dashboard.cardDashboard')

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap py-2">
            <h5 class="mb-2 mb-md-0 font-weight-bold">Évolution du taux d'exécution des projets</h5>

            <form method="GET" action="{{ route('home') }}" class="d-flex flex-wrap align-items-center">
                <div class="mr-2 mb-2 flex-grow-1 flex-md-grow-0">
                    <label for="frequence_id">Fréquence </label>
                    <select name="frequence" onchange="this.form.submit()" class="form-control">
                        <option value="annee" {{ $frequence == 'annee' ? 'selected' : '' }}>Année</option>
                        <option value="mois" {{ $frequence == 'mois' ? 'selected' : '' }}>Mois</option>
                        <option value="semaine" {{ $frequence == 'semaine' ? 'selected' : '' }}>Semaine</option>
                        <option value="jour" {{ $frequence == 'jour' ? 'selected' : '' }}>Jour</option>
                    </select>
                </div>

                <div class="mb-2 flex-grow-1 flex-md-grow-0">
                    <label for="projet_id">Projet </label>
                    <select name="projet" onchange="this.form.submit()" class="form-control">
                        <option value="">Tous les projets</option>
                        @foreach ($projetsDisponibles as $nom)
                            <option value="{{ $nom }}" {{ $projet == $nom ? 'selected' : '' }}>{{ $nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div style="position: relative; width: 100%; height: 400px;">
                <canvas id="tauxExecutionChart"></canvas>
            </div>
        </div>

    </div>


    {{-- @foreach (\App\Models\Projet::all() as $p)
                        <option value="{{ $p->nom_projet }}" {{ $projet == $p->nom_projet ? 'selected' : '' }}>
                            {{ $p->nom_projet }}
                        </option>
                    @endforeach --}}

    {{-- pour le test mais en haut le vrai --}}


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















    <script>
        const chartData = @json($data);

        const datasets = chartData.map((item, index) => {
            const colors = ['#007bff', '#dc3545', '#28a745', '#ffc107', '#17a2b8', '#6f42c1'];
            return {
                label: item.name,
                data: item.data.map(d => ({
                    x: d.x,
                    y: d.y
                })),
                borderColor: colors[index % colors.length],
                fill: false,
                tension: 0.3
            };
        });

        const ctx = document.getElementById('tauxExecutionChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        type: 'category',
                        title: {
                            display: true,
                            text: 'Période'
                        }
                    },
                    y: {
                        min: 0,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Taux d\'exécution (%)'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Évolution du taux d\'exécution des projets'
                    },
                    tooltip: {
                        mode: 'nearest'
                    }
                }
            }
        });
    </script>





@endsection
