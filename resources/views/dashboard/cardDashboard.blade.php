<div class="dashboard">
    <div class="container my-4">
        <h1 class="dashboard-title mb-4">Tableau de Bord</h1>

        <div class="row">
            <!-- Total Projets -->
            <div class="col-md-3 mb-4">
                <div class="card kpi-card h-100" data-toggle="modal" data-target="#modalProjets" style="cursor: pointer;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="kpi-icon bg-gradient-purple">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="ml-auto">
                                <h2 class="kpi-value mb-0">{{ $totalProjets }}</h2>
                            </div>
                        </div>
                        <div class="kpi-label mt-3">Total Projets</div>
                        <div class="kpi-decoration"></div>
                    </div>
                </div>
            </div>

            <!-- Avancement Global -->
            <div class="col-md-3 mb-4">
                <div class="card kpi-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="kpi-icon bg-gradient-lime">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="ml-auto">
                                <h2 class="kpi-value mb-0">{{ round($avancementGlobal, 2) }}%</h2>
                            </div>
                        </div>
                        <div class="kpi-label mt-3">Avancement Global</div>
                        <div class="kpi-decoration"></div>
                    </div>
                </div>
            </div>

            <!-- Activités cette semaine -->
            <div class="col-md-3 mb-4">
                <div class="card kpi-card h-100" data-toggle="modal" data-target="#modalActivitesSemaine"
                    style="cursor: pointer;" title="Cliquez pour voir les activités prévues cette semaine">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="kpi-icon bg-gradient-pink">
                                <i class="fas fa-calendar-week"></i>
                            </div>
                            <div class="ml-auto">
                                <h2 class="kpi-value mb-0">{{ $activitesSemaine }}</h2>
                            </div>
                        </div>
                        <div class="kpi-label mt-3">Activités cette semaine</div>
                        <div class="kpi-decoration"></div>
                    </div>
                </div>
            </div>

            <!-- Projets à Risques -->
            <div class="col-md-3 mb-4">
                <div class="card kpi-card h-100" data-toggle="modal" data-target="#modalProjetsRisques"
                    style="cursor: pointer;" title="Cliquez pour voir les projets à risques">

                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="kpi-icon bg-gradient-mint">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="ml-auto">
                                <h2 class="kpi-value mb-0">{{ $projetsRisques }}</h2>
                            </div>
                        </div>
                        <div class="kpi-label mt-3">Projets à Risques</div>
                        <div class="kpi-decoration"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte des Activités -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card activities-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <h3 class="card-title mb-4">Total des Activités : {{ $totalActivites }}</h3>
                        </div>

                        <div class="d-flex justify-content-between">
                            <!-- Activités en cours -->
                            <div class="activity-item">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-gradient-purple">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <div class="activity-info ml-3">
                                        <div class="activity-value">{{ $pourcentageEnCours }}%</div>
                                        <div class="activity-label">Activités en cours</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Séparateur vertical -->
                            <div class="vr d-none d-md-block"></div>

                            <!-- En retard -->
                            <div class="activity-item">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-gradient-lime">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="activity-info ml-3">
                                        <div class="activity-value">{{ $pourcentageEnRetard }}%</div>
                                        <div class="activity-label">En retard</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Séparateur vertical -->
                            <div class="vr d-none d-md-block"></div>

                            <!-- Activités achevées -->
                            <div class="activity-item">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-gradient-pink">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="activity-info ml-3">
                                        <div class="activity-value">{{ $pourcentageAchevees }}%</div>
                                        <div class="activity-label">Activités achevées</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.detailsModal')


    <style>
        .dashboard {
            min-height: 100vh;
            background: #f8f9fa;
            padding: 2rem 0;
        }

        .dashboard-title {
            color: #2d3748;
            font-weight: 700;
            font-size: 2rem;
        }

        .kpi-card {
            background: linear-gradient(135deg, rgba(187, 130, 239, 0.05) 0%, rgba(215, 243, 55, 0.05) 100%);
            border: none;
            border-radius: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
            background-color: #76e2dd;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kpi-icon i {
            font-size: 1.5rem;
            color: #fff;
        }

        .kpi-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2d3748;
        }

        .kpi-label {
            color: #718096;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .kpi-decoration {
            position: absolute;
            bottom: -2rem;
            right: -2rem;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(187, 130, 239, 0.1) 0%, rgba(215, 243, 55, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .activities-card {
            background: linear-gradient(135deg, rgba(187, 130, 239, 0.05) 0%, rgba(255, 194, 241, 0.05) 100%);
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
            background-color: #76e2dd;
        }

        .activities-card .card-title {
            color: #2d3748;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .activity-item {
            padding: 1rem;
        }

        .activity-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-icon i {
            font-size: 1.25rem;
            color: #fff;
        }

        .activity-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            line-height: 1.2;
        }

        .activity-label {
            color: #718096;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .vr {
            border-left: 1px solid rgba(187, 130, 239, 0.2);
            height: auto;
            margin: 0 1rem;
        }

        /* Gradients colorés basés sur la palette de l'image */
        .bg-gradient-purple {
            background: linear-gradient(135deg, #BB82EF 0%, #9B6CD4 100%);
        }

        .bg-gradient-lime {
            background: linear-gradient(135deg, #D7F337 0%, #B8D129 100%);
        }

        .bg-gradient-pink {
            background: linear-gradient(135deg, #FFC2F1 0%, #E5A5D3 100%);
        }

        .bg-gradient-mint {
            background: linear-gradient(135deg, #D4E4E1 0%, #B8C7C4 100%);
        }

        @media (max-width: 768px) {
            .dashboard {
                padding: 1rem;
            }

            .activities-card {
                margin-bottom: 1rem;
            }

            .activity-item {
                padding: 0.75rem;
            }
        }
    </style>
