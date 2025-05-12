@extends('layouts.layouts')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Parties prenantes</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Liste des parties prenantes</li>
            </ol>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-flex no-block mb-3">
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'commentateur')
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#addPartiePrenanteModal">
                        <i class="fa fa-plus mr-2"></i> Insérer une Partie Prenante
                    </button>
                @endif
            </div>
            @include('partiePrenante.ajoutPartiePrenante')

            <div class="container">
                <h2 class="text-center mb-4">Liste des Parties Prenantes</h2>


                <!-- Formulaire de filtres -->
                <form method="GET" action="{{ url()->current() }}">
                    <div class="row mb-4">
                        <!-- Filtre Projet -->
                        <div class="col-md-4 mb-3">
                            <select name="projet_id" class="form-control">
                                <option value="">Tous les projets</option>
                                @foreach ($projets as $projet)
                                    <option value="{{ $projet->id }}"
                                        {{ request('projet_id') == $projet->id ? 'selected' : '' }}>
                                        {{ $projet->nom_projet }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtre Entités -->
                        <div class="col-md-4 mb-3">
                            <select name="entites[]" class="form-control" multiple size="5">
                                @foreach ($entites as $entite)
                                    <option value="{{ $entite }}"
                                        {{ in_array($entite, request('entites', [])) ? 'selected' : '' }}>
                                        {{ $entite }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtre Fonctions -->
                        <div class="col-md-4 mb-3">
                            <select name="fonctions[]" class="form-control" multiple size="5">
                                @foreach ($fonctions as $fonction)
                                    <option value="{{ $fonction }}"
                                        {{ in_array($fonction, request('fonctions', [])) ? 'selected' : '' }}>
                                        {{ $fonction }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Boutons -->
                        <div class="col-12 text-center">
                            <div class="d-flex flex-wrap justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm m-1">
                                    <i class="fas fa-filter"></i> Appliquer
                                </button>
                                <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm m-1">
                                    <i class="fas fa-sync-alt"></i> Réinitialiser
                                </a>
                                <button type="button" class="btn btn-info btn-sm m-1" data-toggle="modal"
                                    data-target="#emailModal">
                                    <i class="fas fa-envelope"></i> Envoyer des Emails
                                </button>
                            </div>
                        </div>

                    </div>
                </form>


                <!-- Tableau -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Projet</th>
                                <th>Entité</th>
                                <th>Fonction</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pivotEntries as $entry)
                                <tr>
                                    <td>{{ $entry->projet->nom_projet }}</td>
                                    <td>{{ $entry->partiePrenante->entite }}</td>
                                    <td>{{ $entry->fonction }}</td>
                                    <td>{{ $entry->nom_partie }}</td>
                                    <td>{{ $entry->email_partie ?? 'N/A' }}</td>
                                    <td>{{ $entry->contact_partie ?? 'N/A' }}</td>
                                    <td class="text-center">


                                        <div class="d-flex justify-content-around flex-wrap">

                                            {{-- Bouton de modification --}}
                                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'commentateur')
                                                <button type="button" class="btn btn-warning btn-sm m-1 w-80"
                                                    data-toggle="modal" data-target="#editModal-{{ $entry->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            @endif

                                            {{-- Bouton de suppression --}}
                                            <form method="POST" action="{{ route('partieprenante.destroy', $entry->id) }}"
                                                class="d-inline m-1 w-100">
                                                @csrf
                                                @method('DELETE')
                                                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'commentateur')
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn  w-90">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endif
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucun résultat trouvé</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>



                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $pivotEntries->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>


    @include('partiePrenante.modifierPartiePrenante')
    @include('partiePrenante.recupEmails')








    <style>
        select[multiple] {
            min-height: 150px;
            padding: 5px 0;
        }

        select[multiple] option {
            padding: 8px 12px;
            border-bottom: 1px solid #eee;
        }

        select[multiple] option:checked {
            background-color: #e3f2fd;
            color: #1976d2;
        }
    </style>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestionnaire pour tous les boutons de suppression
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Confirmation de suppression',
                        text: "Êtes-vous sûr de vouloir supprimer cette partie prenante ?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Oui, supprimer !',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
