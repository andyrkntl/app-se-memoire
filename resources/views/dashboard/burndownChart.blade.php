<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-chart-line mr-2"></i>
            Burn-down Chart
            @if ($projetSelectionne)
                : {{ $projetSelectionne->nom_projet }}
            @else
                Global
            @endif
        </h5>

        <!-- Sélecteur de projet pour le burn-down -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownProjetBurndown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sélectionner un projet
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownProjetBurndown">
                <a class="dropdown-item" href="{{ route('home') }}">Vue globale</a>
                <div class="dropdown-divider"></div>
                @foreach ($listeProjets as $projet)
                    <a class="dropdown-item"
                        href="{{ route('home', ['projet_id' => $projet->id]) }}">{{ $projet->nom_projet }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (count($burndownData['labels']) > 0)
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-info mb-3">
                        <div class="card-body text-info">
                            <h5 class="card-title">Activités restantes</h5>
                            <p class="card-text display-4">{{ $burndownData['remainingWork'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-primary mb-3">
                        <div class="card-body text-primary">
                            <h5 class="card-title">Progression</h5>
                            <p class="card-text display-4">
                                @if ($projetSelectionne)
                                    {{ floor($projetSelectionne->taux_avancement) }}%
                                @else
                                    {{ floor($avancementGlobal) }}%
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-warning mb-3">
                        <div class="card-body text-warning">
                            <h5 class="card-title">Jours écoulés/total</h5>
                            <p class="card-text display-4">
                                {{ $burndownData['elapsedDays'] }}/{{ $burndownData['totalDays'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chart-container" style="position: relative; height:400px;">
                <canvas id="burndownChart"></canvas>
            </div>



            <!-- Ajout des boutons de contrôle du zoom -->
            <div class="zoom-controls mt-2 mb-3">
                <button id="reset-zoom" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-undo-alt"></i> Réinitialiser le zoom
                </button>
                <span class="ml-2 text-muted small"><i class="fas fa-info-circle"></i> Utilisez la molette de la souris
                    ou pincez l'écran pour zoomer, et glissez pour vous déplacer</span>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card bg-light" style="cursor: pointer;" data-toggle="modal"
                        data-target="#graphInfoModal">
                        <div class="card-body small">
                            <div class="d-flex mb-2">
                                <span class="badge badge-primary mr-2">&nbsp;</span>
                                <span>La <strong>ligne bleue</strong> représente la progression idéale
                                    (théorique)</span>
                            </div>
                            <div class="d-flex mb-2">
                                <span class="badge badge-success mr-2">&nbsp;</span>
                                <span>La <strong>ligne verte</strong> représente la progression réelle</span>
                            </div>
                            <div class="mt-2">
                                <span><i class="fas fa-info-circle text-muted"></i> Si la ligne verte est
                                    <strong>au-dessus</strong> de la ligne bleue, le projet est <strong>en
                                        retard</strong>. Si elle est <strong>en-dessous</strong>, le projet est
                                    <strong>en avance</strong>.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <h5><i class="fas fa-exclamation-triangle"></i> Données insuffisantes</h5>
                <p>Impossible de générer le Burn-down Chart. Assurez-vous que :</p>
                <ul>
                    <li>Les dates de début et de fin du projet sont définies</li>
                    <li>Des activités ont été créées dans le projet</li>
                    <li>Les dates de fin sont renseignées pour les activités terminées</li>
                </ul>
            </div>
        @endif
    </div>
</div>




@include('dashboard.infoChartModal')


<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.2.1"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (count($burndownData['labels']) > 0)
            var ctx = document.getElementById('burndownChart').getContext('2d');
            var burndownChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($burndownData['labels']) !!},
                    datasets: [{
                        label: 'Progression idéale',
                        data: {!! json_encode($burndownData['ideal']) !!},
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#007bff',
                        fill: true
                    }, {
                        label: 'Progression réelle',
                        data: {!! json_encode($burndownData['actual']) !!},
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.0)',
                        borderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#28a745'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: 'Burn-down Chart - Activités restantes vs Temps',
                        fontSize: 16
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            title: function(tooltipItems, data) {
                                return 'Date: ' + tooltipItems[0].xLabel;
                            },
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex].label + ': ' +
                                    tooltipItem.yLabel + ' activités restantes';
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Date'
                            },
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Activités restantes'
                            },
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                                // Définir le max dynamiquement selon le nombre total d'activités
                                max: {{ max(array_merge($burndownData['ideal'] ?? [0], $burndownData['actual'] ?? [0])) + 1 }}
                            }
                        }]
                    },
                    // Configuration du plugin de zoom
                    plugins: {
                        zoom: {
                            pan: {
                                enabled: true,
                                mode: 'xy',
                                speed: 10,
                                threshold: 10
                            },
                            zoom: {
                                enabled: true,
                                drag: false,
                                mode: 'xy',
                                speed: 0.1,
                                wheel: {
                                    enabled: true
                                },
                                pinch: {
                                    enabled: true
                                }
                            }
                        }
                    }
                }
            });

            // Gestionnaire d'événement pour le bouton de réinitialisation du zoom
            document.getElementById('reset-zoom').addEventListener('click', function() {
                burndownChart.resetZoom();
            });
        @endif
    });
</script>
