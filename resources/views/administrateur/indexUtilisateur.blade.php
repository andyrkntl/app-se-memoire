@extends('layouts.layouts')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Utilisateurs</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Liste des Utilisateurs</li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2 class="text-center mb-4">Liste des Utilisateurs</h2>

            {{-- Message flash --}}
            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            @if (auth()->user()->role === 'admin')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($utilisateurs as $utilisateur)
                            <tr>
                                <td>{{ $utilisateur->name }}</td>
                                <td>{{ $utilisateur->email }}</td>
                                <td>
                                    <span
                                        class="badge badge-{{ $utilisateur->role === 'admin'
                                            ? 'danger'
                                            : ($utilisateur->role === 'commentateur'
                                                ? 'warning'
                                                : 'secondary') }}">
                                        {{ ucfirst($utilisateur->role) }}
                                    </span>
                                </td>
                                @if (auth()->user()->role === 'admin')
                                    <td>
                                        <!-- Bouton Modifier -->
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                            data-target="#editUserModal{{ $utilisateur->id }}">
                                            Modifier
                                        </button>

                                        <!-- Formulaire de suppression -->
                                        <form action="{{ route('utilisateur.destroy', $utilisateur->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>

                            @include('administrateur.editUtilisateurModal')

                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? 4 : 3 }}" class="text-center">
                                    Aucun utilisateur trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $utilisateurs->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
