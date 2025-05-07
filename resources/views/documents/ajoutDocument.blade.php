<div class="modal fade" id="addDocumentModal" tabindex="-1" role="dialog" aria-labelledby="addDocumentLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentLabel">Ajouter un document</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nom_docs">Nom du document</label>
                        <input type="text" name="nom_docs" class="form-control" id="nom_docs" required>
                    </div>
                    <div class="form-group">
                        <label for="type_docs">Type de document</label>
                        <select name="type_docs" class="form-control" id="type_docs" required>
                            <option value="rapport">Rapport</option>
                            <option value="fiche de présence">Fiche de présence</option>
                            <option value="livrable">Livrable</option>
                            <option value="compte rendu">Compte rendu</option>
                            <option value="manuel">Manuel</option>
                            <option value="autres">Autres</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">Fichier</label>
                        <input type="file" name="file" class="form-control" id="file" required>
                    </div>
                    <input type="hidden" name="projet_id" value="{{ $projet->id }}">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
