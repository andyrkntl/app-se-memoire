@extends('layouts.layouts')
@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Formulaire</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Formulaire</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">

            </div>
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">


            </div>

        </div>
    </div>
</div>


        <div class="card">
            <div class="card-body">
                <div class="d-flex no-block">
                    <a href="{{ route('formulaires.create') }}" class="btn btn-success mb-3">Insérer une nouvelle formulaire
                </a>

                </div>
                <div class="table-responsive m-t-20">
                    <table id="example23" class="tablesaw table-striped table-hover table-bordered table tablesaw-columntoggle" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">



                        <thead>
                            <tr>
                                <th>Nom du Chantier</th>
                                <th>Pourcentage de Réalisation</th>
                                <th>Commentaires</th>
                                <th>Date de Soumission</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formulaires as $formulaire)
                            <tr>
                                <td>{{ $formulaire->nom_chantier }}</td>
                                <td>{{ $formulaire->pourcentage_realisation }}%</td>
                                <td>{{ $formulaire->commentaires }}</td>
                                <td>{{ $formulaire->created_at->format('d/m/Y') }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                           

                                                <form action="{{ route('formulaires.destroy', $formulaire->id) }}" method="POST" onsubmit="return confirmDeletion(event, this)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bt btn-danger mx-2">
                                                        <i class="mdi mdi-delete-empty"></i>
                                                    </button>
                                                </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

@include('formulaire.ajoutFormulaire')

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: 'fermer'
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: 'fermer'
            });
        @endif
    });
    function confirmDeletion(event, form) {
        event.preventDefault(); // Empêche la soumission par défaut du formulaire

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas annuler cette action.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si l'utilisateur confirme, soumettre le formulaire
                form.submit();
            }
        });
    }
</script>

