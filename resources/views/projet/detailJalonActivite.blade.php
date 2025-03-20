<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h3 class="text-center">Progression du projet : {{ $projet->nom_projet }}</h3>

    @foreach ($projet->jalon as $jalon)
        <div class="card mb-3">
            <!-- En-tête principal pliable -->
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center"
                data-toggle="collapse" data-target="#jalonContent{{ $jalon->id }}" aria-expanded="true"
                style="cursor: pointer">
                <span>{{ $jalon->nom_jalon }}</span>
                <button class="btn btn-light btn-sm p-1">
                    <i class="bi bi-dash-lg collapse-icon-main"></i>
                </button>
            </div>

            <!-- Contenu principal du jalon -->
            <div id="jalonContent{{ $jalon->id }}" class="collapse show">
                <div class="card-body">

                    <!-- Section Détails pliable -->
                    <div class="mb-4">
                        <div class="collapse-trigger d-flex justify-content-between align-items-center mb-3"
                            data-toggle="collapse" data-target="#detailsJalon{{ $jalon->id }}"
                            style="cursor: pointer">
                            <h5 class="mb-0">📋 Détails du jalon</h5>
                            <i class="bi bi-chevron-down collapse-icon"></i>
                        </div>

                        <div id="detailsJalon{{ $jalon->id }}" class="collapse show">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover shadow-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Description</th>
                                            <th>Dates prévues</th>
                                            <th>Date de fin</th>
                                            <th>Avancement</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $jalon->description ?? 'Aucune description' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-calendar-range mr-2"></i>
                                                    {{ $jalon->date_debut_formatted ?? 'Non définie' }} →
                                                    {{ $jalon->date_prevue_formatted ?? 'Non définie' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-calendar-check mr-2"></i>
                                                    {{ $jalon->date_fin_formatted ?? 'Non définie' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $progressValue = $jalon->taux_avancement ?? 0;
                                                        $progressColor = '#6c757d';
                                                        if ($progressValue < 25) {
                                                            $progressColor = '#dc3545';
                                                        } elseif ($progressValue < 50) {
                                                            $progressColor = '#fd7e14';
                                                        } elseif ($progressValue < 75) {
                                                            $progressColor = '#0dcaf0';
                                                        } else {
                                                            $progressColor = '#198754';
                                                        }

                                                        $radius = 15;
                                                        $circumference = 2 * pi() * $radius;
                                                        $strokeDashoffset = $circumference * (1 - $progressValue / 100);
                                                    @endphp
                                                    <div class="mr-2 position-relative"
                                                        style="width: 40px; height: 40px;">
                                                        <svg width="40" height="40">
                                                            <circle cx="20" cy="20"
                                                                r="{{ $radius }}" fill="none" stroke="#e9ecef"
                                                                stroke-width="3" />
                                                            <circle cx="20" cy="20"
                                                                r="{{ $radius }}" fill="none"
                                                                stroke="{{ $progressColor }}" stroke-width="3"
                                                                stroke-linecap="round"
                                                                stroke-dasharray="{{ $circumference }}"
                                                                stroke-dashoffset="{{ $strokeDashoffset }}"
                                                                transform="rotate(-90 20 20)" />
                                                        </svg>
                                                    </div>
                                                    <span class="font-weight-bold">{{ $progressValue }}%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill"
                                                    style="background-color: {{ $jalon->color ?? 'gray' }}; color: white;">
                                                    {{ $jalon->statut_jalon ?? 'Inconnu' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Section Activités pliable -->
                    <div class="mt-4">
                        <div class="collapse-trigger d-flex justify-content-between align-items-center mb-3"
                            data-toggle="collapse" data-target="#activitesJalon{{ $jalon->id }}"
                            style="cursor: pointer">
                            <h5 class="mb-0">📌 Activités</h5>
                            <i class="bi bi-chevron-down collapse-icon"></i>
                        </div>

                        <div id="activitesJalon{{ $jalon->id }}" class="collapse show">
                            <ul class="list-group">
                                @foreach ($jalon->activite as $activite)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $activite->nom_activite }}</strong>
                                            <br>
                                            <small>
                                                📅 {{ $activite->date_debut_formatted }} →
                                                {{ $activite->date_prevue_formatted }}
                                                | Fin : {{ $activite->date_fin_formatted ?? 'Non définie' }}
                                            </small>
                                        </div>
                                        <span class="badge"
                                            style="color: white; background-color: {{ $activite->color }}">
                                            {{ $activite->statut_activite }}
                                        </span>
                                    </li>
                                @endforeach
                                <li class="list-group-item text-muted">Ajouter une tâche...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .collapse-trigger {
        padding: 12px;
        background-color: #f8f9fa;
        border-radius: 5px;
        transition: all 0.2s ease;
    }

    .collapse-trigger:hover {
        background-color: #e9ecef;
    }

    .collapse-icon {
        transition: transform 0.3s ease;
    }

    .collapse-icon-main {
        transition: transform 0.3s ease;
    }

    .collapsed .collapse-icon {
        transform: rotate(180deg);
    }

    .collapsed .collapse-icon-main {
        transform: rotate(135deg);
    }

    .list-group-item {
        border-left: 3px solid #007bff;
        transition: all 0.2s ease;
    }

    .list-group-item:hover {
        transform: translateX(5px);
        box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.75em;
        min-width: 80px;
    }

    circle {
        transition: stroke-dashoffset 0.5s ease-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de l'icône principale
        document.querySelectorAll('.card-header[data-toggle="collapse"]').forEach(header => {
            header.addEventListener('click', function() {
                const icon = this.querySelector('.collapse-icon-main');
                icon.classList.toggle('bi-dash-lg');
                icon.classList.toggle('bi-plus-lg');
            });
        });

        // Gestion des sous-sections
        document.querySelectorAll('.collapse-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const icon = this.querySelector('.collapse-icon');
                icon.classList.toggle('bi-chevron-down');
                icon.classList.toggle('bi-chevron-up');
            });
        });
    });
</script>
