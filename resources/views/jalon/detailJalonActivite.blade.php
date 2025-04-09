<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h3 class="text-center">Progression du projet : {{ $projet->nom_projet }}</h3>
    <div class=" mb-4">
        {{-- bouton ajout jalon --}}
        <button class="btn btn-success" data-toggle="modal" data-target="#addJalonModal">
            <i class="bi bi-plus-circle"></i> Ajouter un nouveau jalon
        </button>
    </div>
    @include('jalon.ajoutJalon') <!-- Ajoutez cette ligne -->


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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


                            <div class="d-flex align-items-center">
                                {{-- bouton de modification d'un jalon --}}
                                <button class="btn btn-sm btn-outline-primary  mr-2 edit-jalon" data-toggle="modal"
                                    data-target="#editJalonModal" data-id="{{ $jalon->id }}"
                                    data-nom="{{ $jalon->nom_jalon }}" data-description="{{ $jalon->description }}">
                                    <i class="bi bi-pencil"></i>
                                </button>


                                <!-- Bouton de suppression du jalon -->
                                <button class="btn btn-sm btn-outline-danger delete-jalon-btn"
                                    data-jalon-id="{{ $jalon->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
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



                            <!-- Filtre des activités -->
                            <form action="{{ route('activite.filter', $projet->id) }}" method="GET" class="mb-3">
                                <input type="hidden" name="jalon_id" value="{{ $jalon->id }}">
                                <!-- Cache l'id du jalon -->

                                <div class="row g-2 align-items-center">
                                    <!-- Filtrer par statut -->
                                    <div class="col-12 col-md-3">
                                        <select name="statut_activite" class="form-control">
                                            <option value="">Filtrer par statut</option>
                                            <option value="En cours"
                                                {{ request('statut_activite') == 'En cours' ? 'selected' : '' }}>En
                                                cours</option>
                                            <option value="Achevé"
                                                {{ request('statut_activite') == 'Achevé' ? 'selected' : '' }}>Achevé
                                            </option>
                                            <option value="En retard"
                                                {{ request('statut_activite') == 'En retard' ? 'selected' : '' }}>En
                                                retard</option>
                                        </select>
                                    </div>

                                    <!-- Filtrer par date -->
                                    <div class="col-12 col-md-3">
                                        <select name="date_activite" class="form-control">
                                            <option value="">Filtrer par date</option>
                                            <option value="asc"
                                                {{ request('date_activite') == 'asc' ? 'selected' : '' }}>Du plus
                                                ancien au plus récent</option>
                                            <option value="desc"
                                                {{ request('date_activite') == 'desc' ? 'selected' : '' }}>Du plus
                                                récent au plus ancien</option>
                                        </select>
                                    </div>

                                    <!-- Bouton de soumission -->
                                    <div class="col-6 col-md-3">
                                        <button type="submit" class="btn btn-primary w-100">Appliquer les
                                            filtres</button>
                                    </div>

                                    <!-- Bouton de réinitialisation des filtres -->
                                    <div class="col-6 col-md-3">
                                        <a href="{{ route('activite.filter', $projet->id) }}"
                                            class="btn btn-secondary w-100">Réinitialiser</a>
                                    </div>
                                </div>
                            </form>







                            <ul class="list-group">
                                @foreach ($jalon->activite as $activite)
                                    <li class="list-group-item p-0" data-activity-id="{{ $activite->id }}">
                                        <!-- Titre cliquable -->
                                        <div class="d-flex justify-content-between align-items-center p-3"
                                            data-toggle="collapse" href="#collapseActivite{{ $activite->id }}"
                                            role="button" aria-expanded="false"
                                            aria-controls="collapseActivite{{ $activite->id }}">
                                            <div class="flex-grow-1">
                                                <strong>{{ $activite->nom_activite }}</strong><br>
                                                <small>
                                                    📅 {{ $activite->date_debut_formatted }} →
                                                    {{ $activite->date_prevue_formatted }}
                                                    | Fin : {{ $activite->date_fin_formatted ?? 'Non définie' }}
                                                </small>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <span class="badge mr-2"
                                                    style="color: white; background-color: {{ $activite->color }}">
                                                    {{ $activite->statut_activite }}
                                                </span>

                                                <button class="btn btn-sm btn-outline-primary mr-2 edit-activity"
                                                    data-toggle="modal" data-target="#editActivityModal"
                                                    data-id="{{ $activite->id }}"
                                                    data-nom="{{ $activite->nom_activite }}"
                                                    data-debut="{{ $activite->date_debut_formatted }}"
                                                    data-prevue="{{ $activite->date_prevue_formatted }}"
                                                    data-fin="{{ $activite->date_fin_formatted }}"
                                                    data-statut="{{ $activite->statut_activite }}"
                                                    data-lieu="{{ $activite->lieu_reunion }}"
                                                    data-heure="{{ $activite->heure_reunion }}"
                                                    data-description="{{ $activite->description_reunion }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <button class="btn btn-sm btn-outline-danger delete-activity-btn mr-2"
                                                    data-activite-id="{{ $activite->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <form action="{{ route('activites.googlecalendar', $activite->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                                        <i class="bi bi-calendar-plus"></i> Agenda
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Détails cachés -->
                                        <div class="collapse px-3 pb-3" id="collapseActivite{{ $activite->id }}">
                                            @if ($activite->lieu_reunion)
                                                📍 {{ $activite->lieu_reunion }}<br>
                                            @endif
                                            @if ($activite->heure_reunion)
                                                🕒{{ \Carbon\Carbon::parse($activite->heure_reunion)->format('H:i') }}<br>
                                            @endif
                                            @if ($activite->description_reunion)
                                                📝{{ $activite->description_reunion }}<br>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>



                            {{-- list ajout d'une nouvelle activite --}}
                            <li class="list-group-item p-0 border-0">
                                <div class="add-activity-container">
                                    <!-- Élément déclencheur -->
                                    <div class="clickable-add-activity px-3 py-2" data-jalon-id="{{ $jalon->id }}"
                                        style="cursor: pointer; background-color: #f8f9fa;">
                                        <i class="bi bi-plus-circle"></i> Ajouter une activité...
                                    </div>
                                    @include('activite.ajoutActivite')
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>




@include('jalon.modifierJalon')
@include('activite.modifierActivite')
















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




{{-- confirmation suppression d'une activité --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner tous les boutons de suppression
        const deleteButtons = document.querySelectorAll('.delete-activity-btn');

        // Parcourir chaque bouton et ajouter l'événement click
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const activiteId = this.getAttribute('data-activite-id');

                // Afficher SweetAlert2 pour confirmer la suppression
                Swal.fire({
                    title: 'Êtes-vous sûr de supprimer cette activité ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si l'utilisateur confirme, envoyer la requête pour supprimer l'activité
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/activites/' +
                            activiteId; // Remplace cette URL par celle qui correspond à ta route de suppression
                        form.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;

                        // Soumettre le formulaire
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>




{{-- confirmation suppression d'un jalon --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner tous les boutons de suppression de jalon
        const deleteJalonButtons = document.querySelectorAll('.delete-jalon-btn');

        // Parcourir chaque bouton et ajouter l'événement click
        deleteJalonButtons.forEach(button => {
            button.addEventListener('click', function() {
                const jalonId = this.getAttribute('data-jalon-id');

                // Afficher SweetAlert2 pour confirmer la suppression du jalon
                Swal.fire({
                    title: 'Êtes-vous sûr de supprimer ce jalon ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si l'utilisateur confirme, envoyer la requête pour supprimer le jalon
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/jalons/' +
                            jalonId; // Remplace cette URL par celle qui correspond à ta route de suppression
                        form.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;

                        // Soumettre le formulaire
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>




{{-- ajout activite au google calendar --}}
<script>
    document.querySelectorAll('.add-to-calendar-btn').forEach(button => {
        button.addEventListener('click', function() {
            const activiteId = this.dataset.activiteId;

            fetch(`/activites/${activiteId}/add-to-calendar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Événement ajouté à Google Calendar');
                    } else {
                        alert('Erreur : ' + data.message);
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Erreur lors de l’ajout à Google Calendar.');
                });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
