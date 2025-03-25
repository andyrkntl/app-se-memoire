<!-- Bouton pour ouvrir le modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editActiviteModal{{ $activite->id }}">
    Modifier l'activité
</button> --}}

<!-- Modal -->
{{-- <div class="modal fade" id="editActiviteModal{{ $activite->id }}" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier l'activité: {{ $activite->nom_activite }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="POST" action="#">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom_activite">Nom de l'activité</label>
                        <input type="text" class="form-control" name="nom_activite"
                            value="{{ old('nom_activite', $activite->nom_activite) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date_debut">Date de début (actuelle: {{ $activite->date_debut_formatted }})</label>
                        <input type="date" class="form-control" name="date_debut"
                            value="{{ old('date_debut', $activite->date_debut_formatted) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date_prevue">Date prévue (actuelle: {{ $activite->date_prevue_formatted }})</label>
                        <input type="date" class="form-control" name="date_prevue"
                            value="{{ old('date_prevue', $activite->date_prevue_formatted) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date_fin">
                            Date de fin
                            @if ($activite->date_fin)
                                (actuelle: {{ $activite->date_fin_formatted }})
                            @endif
                        </label>
                        <input type="date" class="form-control" name="date_fin"
                            value="{{ old('date_fin', $activite->date_fin_formatted) }}">
                        <small class="form-text text-muted">Laissé vide si non terminée</small>
                    </div>

                    <div class="form-group">
                        <label for="statut_activite">Statut actuel:
                            <span
                                class="badge badge-{{ $activite->statut_activite === 'Achevé' ? 'success' : ($activite->statut_activite === 'En retard' ? 'danger' : 'primary') }}">
                                {{ $activite->statut_activite }}
                            </span>
                        </label>
                        <select class="form-control" name="statut_activite" required>
                            <option value="En cours" {{ $activite->statut_activite === 'En cours' ? 'selected' : '' }}>
                                En cours</option>
                            <option value="Achevé" {{ $activite->statut_activite === 'Achevé' ? 'selected' : '' }}>
                                Achevé</option>
                            <option value="En retard"
                                {{ $activite->statut_activite === 'En retard' ? 'selected' : '' }}>En retard</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}



<!-- Modal d'édition -->
<div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier l'activité</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editActivityForm">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editActivityId">

                    <div class="form-group">
                        <label>Nom de l'activité</label>
                        <input type="text" name="nom_activite" id="editNom" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Date de début</label>
                        <input type="date" name="date_debut" id="editDebut" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Date prévue</label>
                        <input type="date" name="date_prevue" id="editPrevue" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Date de fin</label>
                        <input type="date" name="date_fin" id="editFin" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Statut</label>
                        <select name="statut_activite" id="editStatut" class="form-control" required>
                            <option value="En cours">En cours</option>
                            <option value="Achevé">Achevé</option>
                            <option value="En retard">En retard</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Conversion d/m/Y => Y-m-d
        const toIsoDate = (dateString) => {
            if (!dateString || dateString === 'Non définie') return '';
            const [d, m, Y] = dateString.split('/');
            return `${Y}-${m}-${d}`;
        };

        // Conversion Y-m-d => d/m/Y
        const toFormattedDate = (isoDate) => {
            if (!isoDate) return '';
            const [Y, m, d] = isoDate.split('-');
            return `${d}/${m}/${Y}`;
        };

        // Pré-remplissage
        $(document).on('click', '.edit-activity', function() {
            const $btn = $(this);

            $('#editActivityId').val($btn.data('id'));
            $('#editNom').val($btn.data('nom'));
            $('#editDebut').val(toIsoDate($btn.data('debut')));
            $('#editPrevue').val(toIsoDate($btn.data('prevue')));
            $('#editFin').val(toIsoDate($btn.data('fin')));
            $('#editStatut').val($btn.data('statut'));
        });

        // Soumission
        $('#editActivityForm').submit(function(e) {
            e.preventDefault();
            const formData = {
                id: $('#editActivityId').val(),
                nom_activite: $('#editNom').val(),
                date_debut: toFormattedDate($('#editDebut').val()),
                date_prevue: toFormattedDate($('#editPrevue').val()),
                date_fin: toFormattedDate($('#editFin').val()),
                statut_activite: $('#editStatut').val(),
                _token: $('input[name="_token"]').val(),
                _method: 'PUT'
            };

            $.ajax({
                url: `/activites/${formData.id}`,
                method: 'POST',
                data: formData,
                success: () => {
                    $('#editActivityModal').modal('hide');
                    window.location.reload();
                },
                error: (xhr) => {
                    const errors = xhr.responseJSON?.errors;
                    let message = 'Erreur lors de la mise à jour';
                    if (errors) message = Object.values(errors).join('\n');
                    alert(message);
                }
            });
        });
    });





    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: 'fermer'
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: 'fermer'
            });
        @endif
    });
</script>
