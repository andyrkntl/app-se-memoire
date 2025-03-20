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
                    <h5>azerty</h5>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <h5>qwerty</h5>
                </div>
            </div>
        </div>
    </div>





    <div class="container">
        <div class="col-lg-4 col-md-6>
            <div class="row">

            <div class="card destination-card h-100 shadow-lg border-0 rounded-4" style="width: 350px">
                <div class="m-3 chart-container position-relative" style="height: 150px">
                    <h4 class="d-flex justify-content-center text-center">TAUX MOYEN D'AVANCEMENT</h4>
                    <canvas id="gaugeChart" style="height: 100%; width: 100%"></canvas>
                </div>
                <div class="card-body text-center pt-0">
                    <h3 class="card-title mt-3">SIGOB</h3>
                </div>
                <div class="ml-3">
                    <p><strong>Responsable : </strong>Tale RAKOTO</p>
                    <p><strong>Objectifs : </strong> Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="d-flex ml-3 ">
                    <div class="flex-fill mr-2"><strong>Date début : </strong>03/02/2025</div>
                    <div class="flex-fill"><strong>Date fin : </strong>19/05/2025</div>
                </div>
                <div class="card-body text-center pt-0 mt-3 d-flex justify-content-between">
                    <span class="animate__animated animate__pulse animate__infinite"
                        style="color: white; background-color: orangered; padding: 5px; border-radius: 5px;">
                        EN COURS
                    </span>
                    <div>
                        <button type="submit" class="bt btn-primary mx-2">
                            <i class="ti-eye"></i>
                        </button>
                        <button type="submit" class="bt btn-danger mx-2">
                            <i class="mdi mdi-delete-empty"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>




















    <style>
        .destination-card {
            transition: transform 0.4s ease-in-out;
        }

        .destination-card:hover {
            /* transform: translateY(-20px); */
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
    </style>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const targetPercentage = 94; // Remplace par une variable dynamique de Laravel
            let currentPercentage = 0; // Départ de 0%
            const animationSpeed = 2; // Vitesse d'animation (plus petit = plus lent)

            const ctx = document.getElementById("gaugeChart").getContext("2d");

            // Fonction pour obtenir la couleur du cercle en fonction du pourcentage
            function getRingColor(percentage) {
                if (percentage < 30) {
                    return "#e74c3c"; // Rouge
                } else if (percentage >= 30 && percentage <= 50) {
                    return "#f1c40f"; // Jaune
                } else {
                    return "#2ca02c"; // Vert
                }
            }

            // Plugin pour afficher le texte au centre du graphique
            const centerText = {
                id: "centerText",
                afterDatasetsDraw(chart) {
                    const {
                        ctx,
                        chartArea: {
                            width,
                            height
                        }
                    } = chart;
                    ctx.save();
                    ctx.font = "bold 40px Arial"; // Taille et style du texte
                    ctx.fillStyle = "#333"; // Couleur du texte
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";
                    ctx.fillText(Math.round(currentPercentage) + "%", width / 2, height * 0.85);
                    ctx.restore();
                }
            };

            // Initialisation du graphique avec un pourcentage de 0%
            const chart = new Chart(ctx, {
                type: "doughnut",
                data: {
                    datasets: [{
                        data: [0, 100], // Démarre à 0%
                        backgroundColor: [getRingColor(0),
                            "#d0e9c6"
                        ], // Couleur dynamique et gris clair
                        borderWidth: 0
                    }]
                },
                options: {
                    aspectRatio: 2,
                    maintainAspectRatio: false,
                    circumference: 180,
                    rotation: 270,
                    cutout: "70%",
                    responsive: true,
                    plugins: {
                        tooltip: {
                            enabled: false
                        }
                    }
                },
                plugins: [centerText] // Ajout du plugin pour le texte
            });

            // Fonction d'animation pour augmenter progressivement le pourcentage
            function animateChart() {
                if (currentPercentage < targetPercentage) {
                    currentPercentage += animationSpeed;
                    if (currentPercentage > targetPercentage) currentPercentage =
                        targetPercentage; // Ne pas dépasser la cible

                    chart.data.datasets[0].data = [currentPercentage, 100 - currentPercentage];
                    chart.data.datasets[0].backgroundColor = [getRingColor(currentPercentage), "#d0e9c6"];
                    chart.update();

                    requestAnimationFrame(animateChart);
                }
            }

            // Démarrer l'animation après un léger délai
            setTimeout(() => {
                animateChart();
            }, 500);
        });
    </script>
    {{-- @endsection --}}





    @php
        // Données statiques pour démonstration
        $milestones = [
            [
                'name' => 'Phase de conception',
                'start_date' => '2023-10-01',
                'end_date' => '2023-10-15',
                'progress' => 75,
                'status' => 'En cours',
                'status_color' => 'warning',
                'objective' => 'Finaliser les spécifications techniques',
                'activities' => [
                    [
                        'name' => 'Cahier des charges',
                        'start_date' => '2023-10-01',
                        'end_date' => '2023-10-05',
                        'progress' => 100,
                        'status' => 'Terminé',
                        'status_color' => 'success',
                    ],
                    [
                        'name' => 'Maquettes UI',
                        'start_date' => '2023-10-06',
                        'end_date' => '2023-10-12',
                        'progress' => 50,
                        'status' => 'En retard',
                        'status_color' => 'danger',
                    ],
                ],
            ],
            [
                'name' => 'Développement frontend',
                'start_date' => '2023-10-16',
                'end_date' => '2023-11-05',
                'progress' => 20,
                'status' => 'Prévu',
                'status_color' => 'secondary',
                'objective' => 'Implémentation des interfaces utilisateur',
                'activities' => [],
            ],
        ];
    @endphp

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Diagramme de Gantt</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMilestoneModal">
                <i class="fas fa-plus"></i> Ajouter un jalon
            </button>
        </div>

        <!-- Timeline Header -->
        <div class="row mb-3">
            <div class="col-2 fw-bold">Jalon</div>
            <div class="col-10">
                <div class="row fw-bold">
                    <div class="col">Début</div>
                    <div class="col">Fin</div>
                    <div class="col-2">Progression</div>
                    <div class="col">Statut</div>
                </div>
            </div>
        </div>

        <!-- Milestones -->
        @foreach ($milestones as $milestone)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $milestone['name'] }}</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                            data-bs-target="#addActivityModal">
                            <i class="fas fa-plus"></i> Activité
                        </button>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Milestone Details -->
                    <div class="row mb-3">
                        <div class="col-2">
                            <div class="small text-muted">Objectif : {{ $milestone['objective'] }}</div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col">{{ date('d/m/Y', strtotime($milestone['start_date'])) }}</div>
                                <div class="col">{{ date('d/m/Y', strtotime($milestone['end_date'])) }}</div>
                                <div class="col-2">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $milestone['progress'] }}%">
                                            {{ $milestone['progress'] }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="badge bg-{{ $milestone['status_color'] }}">
                                        {{ $milestone['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activities -->
                    @foreach ($milestone['activities'] as $activity)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-2">{{ $activity['name'] }}</div>
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col">{{ date('d/m/Y', strtotime($activity['start_date'])) }}
                                            </div>
                                            <div class="col">{{ date('d/m/Y', strtotime($activity['end_date'])) }}</div>
                                            <div class="col-2">
                                                <div class="progress" style="height: 20px">
                                                    <div class="progress-bar" style="width: {{ $activity['progress'] }}%">
                                                        {{ $activity['progress'] }}%
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <span class="badge bg-{{ $activity['status_color'] }}">
                                                    {{ $activity['status'] }}
                                                </span>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Milestone Modal -->
    <div class="modal fade" id="addMilestoneModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title">Nouveau jalon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nom du jalon</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date de début</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="col-md-6">
                                <label>Date de fin</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Objectif</label>
                            <textarea class="form-control" name="objective" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .progress-bar {
            min-width: 2em;
        }

        .card-header {
            background-color: #f8f9fa;
        }

        .badge {
            font-size: 0.9em;
            padding: 0.6em;
        }
    </style>
@endpush
