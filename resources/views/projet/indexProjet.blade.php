@extends('layouts.layouts')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Projet</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Projet</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <h5>a</h5>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <h5>b</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex no-block mb-3">
                <button type="button" data-toggle="modal" data-target="#addProjetModal" class="btn btn-success">
                    <i class="fa-duotone fa-solid fa-plus mr-2"></i>Insérer un nouveau projet
                </button>
                @include('projet.ajoutProjet')
            </div>

            <form method="GET" action="{{ route('projet.index') }}" class="mb-4">
                <div class="row">
                    <!-- Filtre par chantier -->
                    <div class="col-md-4">
                        <label for="chantier_id">Chantier</label>
                        <select name="chantier_id" id="chantier_id" class="form-control">
                            <option value="">Tous</option>
                            @foreach ($chantiers as $chantier)
                                <option value="{{ $chantier->id }}"
                                    {{ request('chantier_id') == $chantier->id ? 'selected' : '' }}>
                                    {{ $chantier->acronyme }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtre par responsable -->
                    <div class="col-md-4">
                        <label for="responsable">Responsable</label>
                        <select name="lead_id" id="lead_id" class="form-control">
                            <option value="">Tous</option>
                            @foreach ($leads as $lead)
                                <option value="{{ $lead->id }}" {{ request('lead_id') == $lead->id ? 'selected' : '' }}>
                                    {{ $lead->nom_lead }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtre par statut d'avancement -->
                    <div class="col-md-4">
                        <label for="statut_projet">Statut</label>
                        <select name="statut_projet" id="statut_projet" class="form-control">
                            <option value="">Tous</option>
                            <option value="En cours" {{ request('statut_projet') == 'En cours' ? 'selected' : '' }}>En cours
                            </option>
                            <option value="Achevé" {{ request('statut_projet') == 'Achevé' ? 'selected' : '' }}>Achevé
                            </option>
                            <option value="En retard" {{ request('statut_projet') == 'En retard' ? 'selected' : '' }}>En
                                retard</option>
                        </select>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                    <a href="{{ route('projet.index') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </form>

            <div class="container d-flex flex-wrap justify-content-start">
                @foreach ($projets as $projet)
                    <div class="card destination-card h-100 shadow-lg border-0 rounded-4 m-2" style="width: 450px">
                        <div class="m-3 chart-container position-relative" style="height: 150px">
                            <h4 class="d-flex justify-content-center text-center">TAUX MOYEN D'AVANCEMENT</h4>
                            <canvas id="gaugeChart-{{ $projet->id }}" data-taux="{{ $projet->taux_avancement }}"
                                style="height: 100%; width: 100%"></canvas>
                        </div>
                        <div class="card-body text-center pt-0">
                            <h3 class="card-title mt-3">{{ $projet->nom_projet }}</h3>
                        </div>
                        <div class="mb-1 ml-3">
                            <span class="badge badge-primary">{{ $projet->chantier->acronyme }}</span>
                        </div>
                        <div class="ml-3">
                            <p><strong>Responsable : </strong>{{ $projet->lead->nom_lead }}</p>
                        </div>
                        <div class="d-flex ml-3 mb-3">
                            <div class="flex-fill mr-2">
                                <strong>Jours restants : </strong>
                                <span
                                    class="@if ($projet->jours_restants > 0) jours-positif @elseif($projet->jours_restants < 0)jours-negatif @else jours-zero @endif">
                                    {{ $projet->jours_restants_formatted }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p><strong>Objectifs : </strong>
                                <span class="objectifs" id="objectifs-{{ $projet->id }}">
                                    {{ $projet->objectifs }}
                                </span>
                                <span class="voir-plus" id="voir-plus-{{ $projet->id }}"
                                    onclick="toggleText('{{ $projet->id }}')">Voir plus</span>
                            </p>
                        </div>
                        <div class="card-body text-center pt-0 mt-3 d-flex justify-content-between">
                            <span class="animate__animated animate__pulse animate__infinite"
                                style="color: white; background-color: {{ $projet->color }}; padding: 5px; border-radius: 5px;">
                                {{ $projet->statut_projet }}
                            </span>
                            <div class="d-flex justify-content-center">

                                <!-- Bouton Voir -->
                                <form class="" action="{{ route('projet.show', $projet->id) }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn btn-primary mx-2">
                                        <i class="ti-eye"></i>
                                    </button>
                                </form>

                                <!-- Bouton Modifier -->
                                <button type="button" class="btn btn-warning edit-projet-btn" data-toggle="modal"
                                    data-target="#editProjetModal" data-projet-id="{{ $projet->id }}"
                                    data-nom-projet="{{ $projet->nom_projet }}" data-objectifs="{{ $projet->objectifs }}"
                                    data-date-debut="{{ $projet->date_debut }}" data-date-fin="{{ $projet->date_fin }}"
                                    data-chantier-id="{{ $projet->chantier_id }}" data-lead-id="{{ $projet->lead_id }}">
                                    <i class="fa fa-edit mr-1"></i>
                                </button>

                                <!-- Bouton Supprimer -->
                                <form id="delete-form-{{ $projet->id }}"
                                    action="{{ route('projet.destroy', $projet->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-danger mx-2" onclick="confirmDelete({{ $projet->id }})">
                                    <i class="mdi mdi-delete-empty"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('projet.modifierProjet')



    <style>
        .destination-card {
            transition: transform 0.4s ease-in-out;
        }

        .destination-card:hover {
            /* transform: translateY(-20px); */
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }


        .card-body .objectifs {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Limite à 3 lignes */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-body .voir-plus {
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
            font-size: 14px;
        }


        /* jour restants */
        .jours-positif {
            color: green;
        }

        .jours-negatif {
            color: red;
        }

        .jours-zero {
            font-weight: bold;
        }
    </style>


    <script>
        function toggleText(id) {
            const objectifsText = document.getElementById('objectifs-' + id);
            const voirPlusBtn = document.getElementById('voir-plus-' + id);

            // Si le texte est déjà complet, cachez-le et remettez le bouton à "Voir plus"
            if (objectifsText.style.webkitLineClamp === 'unset') {
                objectifsText.style.webkitLineClamp = '3';
                voirPlusBtn.textContent = 'Voir plus';
            } else {
                // Sinon, affichez tout le texte et changez le bouton à "Voir moins"
                objectifsText.style.webkitLineClamp = 'unset';
                voirPlusBtn.textContent = 'Voir moins';
            }
        }
    </script>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("canvas[id^='gaugeChart-']").forEach(canvas => {
                const projetId = canvas.id.split("-")[1]; // Récupère l'ID du projet
                const targetPercentage = parseInt(canvas.getAttribute("data-taux"), 10); // Récupère le taux
                let currentPercentage = 0; // Départ de 0%
                const animationSpeed = 2; // Vitesse d'animation (plus petit = plus lent)

                const ctx = canvas.getContext("2d");

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
                        chart.data.datasets[0].backgroundColor = [getRingColor(currentPercentage),
                            "#d0e9c6"
                        ];
                        chart.update();

                        requestAnimationFrame(animateChart);
                    }
                }

                // Démarrer l'animation après un léger délai
                setTimeout(() => {
                    animateChart();
                }, 500);
            });
        });
    </script>




    {{-- confirmation suppression d'un projet --}}
    <script>
        function confirmDelete(projetId) {
            Swal.fire({
                title: 'Êtes-vous sûr de supprimer ce projet ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${projetId}`).submit();
                }
            });
        }
    </script>
@endsection
