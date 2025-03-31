<!-- Modal de modification de jalon -->
<div class="modal fade" id="editJalonModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Modifier le jalon</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editJalonForm">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editJalonId">

                    <div class="form-group">
                        <label>Nom du jalon</label>
                        <input type="text" name="nom_jalon" id="editNomJalon" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="editDescriptionJalon" class="form-control" rows="3"></textarea>
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
        // Pré-remplissage du formulaire
        $(document).on('click', '.edit-jalon', function() {
            const $btn = $(this);
            $('#editJalonId').val($btn.data('id'));
            $('#editNomJalon').val($btn.data('nom'));
            $('#editDescriptionJalon').val($btn.data('description'));
        });

        // Soumission du formulaire
        $('#editJalonForm').submit(function(e) {
            e.preventDefault();

            const formData = {
                id: $('#editJalonId').val(),
                nom_jalon: $('#editNomJalon').val(),
                description: $('#editDescriptionJalon').val(),
                _token: $('input[name="_token"]').val(),
                _method: 'PUT'
            };

            $.ajax({
                url: `/jalons/${formData.id}`,
                method: 'POST',
                data: formData,
                success: () => {
                    $('#editJalonModal').modal('hide');
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
