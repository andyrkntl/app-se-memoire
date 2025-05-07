@extends('layouts.layouts')

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Liste des documents</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">{{ $projet->nom_projet }} {{ $projet->chantier->acronyme }}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Liste des documents -->
        <div class="card border-light shadow-sm mt-4 mb-4">
            <div class="card-body p-4">
                <!-- Message de succès -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center">
                        <i class="bi bi-check-circle-fill mr-2"></i>
                        <span class="font-weight-bold">{{ session('success') }}</span>
                        <button type="button" class="close ml-auto" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Formulaire de filtres -->
                <form method="GET" action="{{ route('document.index', $projet->id) }}" class="mb-4">
                    <div class="row ">
                        <!-- Filtre par type de document -->
                        <div class="col-sm-6 col-md-3 mb-2">
                            <select name="type_docs" class="form-control">
                                <option value="">Filtrer par type</option>
                                <option value="rapport" {{ request('type_docs') == 'rapport' ? 'selected' : '' }}>Rapport
                                </option>
                                <option value="fiche de présence"
                                    {{ request('type_docs') == 'fiche de présence' ? 'selected' : '' }}>Fiche de présence
                                </option>
                                <option value="livrable" {{ request('type_docs') == 'livrable' ? 'selected' : '' }}>Livrable
                                </option>
                                <option value="compte rendu" {{ request('type_docs') == 'compte rendu' ? 'selected' : '' }}>
                                    Compte rendu</option>
                                <option value="manuel" {{ request('type_docs') == 'manuel' ? 'selected' : '' }}>Manuel
                                </option>
                                <option value="autres" {{ request('type_docs') == 'autres' ? 'selected' : '' }}>Autres
                                </option>
                            </select>
                        </div>

                        <!-- Filtre par extension -->
                        <div class="col-sm-6 col-md-3 mb-3">
                            <select name="extension" class="form-control">
                                <option value="">Filtrer par extension</option>
                                <option value=".pdf" {{ request('extension') == '.pdf' ? 'selected' : '' }}>PDF</option>
                                <option value=".docx" {{ request('extension') == '.docx' ? 'selected' : '' }}>DOCX
                                </option>
                                <option value=".pptx" {{ request('extension') == '.pptx' ? 'selected' : '' }}>PPTX
                                </option>
                                <option value=".xlsx" {{ request('extension') == '.xlsx' ? 'selected' : '' }}>XLSX
                                </option>
                                <option value=".txt" {{ request('extension') == '.txt' ? 'selected' : '' }}>TXT</option>
                            </select>
                        </div>

                        <!-- Recherche par nom du document -->
                        <div class="col-sm-6 col-md-3 mb-2">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Rechercher par nom">
                        </div>

                        <!-- Boutons de filtre et réinitialisation -->
                        <div class="col-sm-6 col-md-3 d-flex mb-2">
                            <button type="submit" class="btn btn-primary w-100 mr-2">Filtrer</button>
                            <!-- Bouton réinitialiser -->
                            <a href="{{ route('document.index', $projet->id) }}"
                                class="btn btn-secondary w-100">Réinitialiser</a>


                        </div>
                    </div>
                </form>

                <!-- Liste des documents -->
                @if ($documents->isEmpty())
                    <div class="alert alert-light d-flex align-items-center border">
                        <i class="bi bi-folder-exclamation mr-2"></i>
                        Aucun document disponible pour ce projet
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="border-top-0">Nom du document</th>
                                    <th scope="col" class="border-top-0">Type</th>
                                    <th scope="col" class="border-top-0 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr class="border-bottom">
                                        <td class="align-middle text-truncate max-w-200">{{ $document->nom_docs }}</td>
                                        <td class="align-middle">
                                            <span
                                                class="badge badge-light border text-dark py-2 px-3">{{ $document->type_docs }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-nowrap justify-content-start gap-2">
                                                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                                    class="btn btn-outline-secondary btn-sm flex-grow-1 flex-md-grow-0 mr-2">
                                                    <i class="bi bi-file-earmark-arrow-down mr-1"></i> Consulter
                                                </a>
                                                <a href="{{ asset('storage/' . $document->file_path) }}"
                                                    download="{{ $document->nom_docs }}"
                                                    class="btn btn-outline-primary btn-sm flex-grow-1 flex-md-grow-0">
                                                    <i class="bi bi-download mr-1"></i> Télécharger
                                                </a>

                                                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'commentateur')
                                                    {{-- bouton modifier --}}
                                                    <button type="button" class="btn btn-outline-warning btn-sm ml-2"
                                                        data-toggle="modal" data-target="#editModal{{ $document->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @endif

                                                {{-- bouton supprimer --}}
                                                <form method="POST"
                                                    action="{{ route('document.destroy', $document->id) }}"
                                                    class="d-inline ml-2" id="deleteForm{{ $document->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'commentateur')
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            onclick="confirmDelete({{ $document->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('documents.modifierDocument')
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="mt-3 mt-md-4 px-2">
                            {{ $documents->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(documentId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + documentId).submit();
                }
            });
        }
    </script>









@endsection
