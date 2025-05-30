<!-- Modal d'édition -->
<div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
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
</script>
