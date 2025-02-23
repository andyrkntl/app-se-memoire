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

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"> Détaille d'une évaluation</h4>
            </div>

<div class="card">
    <div class="card-body">
        <h4>Détails du Chantier: {{ $evaluation->Nom_chantier }}</h4>
        <p><strong>Projet:</strong> {{ $evaluation->Nom_projet }}</p>
        <p><strong>Avancement:</strong> {{ $evaluation->Avancement }}%</p>
        <p><strong>Problèmes rencontrés:</strong></p>
        <ul>
            <li>Financement: {{ $evaluation->Pro1 }}</li>
            <li>Coordination: {{ $evaluation->Pro2 }}</li>
            <li>Passation de marché: {{ $evaluation->Pro3 }}</li>
            <li>Ordre juridique: {{ $evaluation->Pro4 }}</li>
            <li>Ordre technique: {{ $evaluation->Pro5 }}</li>
            <li>Source de vérification: {{ $evaluation->Pro6 }}</li>
        </ul>

        <!-- Graphiques -->
        <div class="row" style="display: flex; justify-content: space-between; gap: 20px;">
            <!-- Graphique Avancement -->
            <div style="flex: 1; max-width: 48%; height: 400px;">
                <canvas id="avancementChart"></canvas>
            </div>

            <!-- Graphique Problèmes -->
            <div style="flex: 1; max-width: 48%; height: 400px;">
                <canvas id="problemsChart"></canvas>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Données pour le graphique d'avancement
    var avancementCtx = document.getElementById('avancementChart').getContext('2d');
    var avancementChart = new Chart(avancementCtx, {
        type: 'doughnut', // Type de graphique (ici un doughnut)
        data: {
            labels: ['Avancement'], // Étiquettes (juste un élément ici)
            datasets: [{
                label: 'Avancement du Projet',
                data: [{{ $evaluation->Avancement }}, 100 - {{ $evaluation->Avancement }}], // Avancement et le reste (100% - Avancement)
                backgroundColor: ['#4CAF50', '#E0E0E0'], // Couleurs pour l'avancement et le reste
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });

    // Données pour le graphique des problèmes rencontrés
    var problemsCtx = document.getElementById('problemsChart').getContext('2d');
    var problemsChart = new Chart(problemsCtx, {
        type: 'bar', // Type de graphique (ici un graphique en barre)
        data: {
            labels: ['Financement', 'Coordination', 'Passation de marché', 'Ordre juridique', 'Ordre technique', 'Source de vérification'],
            datasets: [{
                label: 'Problèmes rencontrés',
                data: [
                    {{ $evaluation->Pro1 == "OUI" ? 1 : 0 }},
                    {{ $evaluation->Pro2 == "OUI" ? 1 : 0 }},
                    {{ $evaluation->Pro3 == "OUI" ? 1 : 0 }},
                    {{ $evaluation->Pro4 == "OUI" ? 1 : 0 }},
                    {{ $evaluation->Pro5 == "OUI" ? 1 : 0 }},
                    {{ $evaluation->Pro6 == "OUI" ? 1 : 0 }}
                ], // Si "OUI", on met 1 pour afficher le problème, sinon 0
                backgroundColor: '#227c9d', // Couleur des barres
                borderColor: '#227c9d',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1, // Les valeurs sont soit 0 soit 1
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });
</script>


@endsection
