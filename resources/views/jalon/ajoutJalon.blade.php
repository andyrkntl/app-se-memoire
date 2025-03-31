{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

<div class="modal fade" id="addJalonModal" tabindex="-1" role="dialog" aria-labelledby="addJalonModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addJalonModalLabel">Ajouter un nouveau jalon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('jalon.store', $projet->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom_jalon">Nom du jalon</label>
                        <input type="text" class="form-control" id="nom_jalon" name="nom_jalon" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_debut">Date de début</label>
                                <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_prevue">Date prévue</label>
                                <input type="date" class="form-control" id="date_prevue" name="date_prevue" required>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="projet_id" value="{{ $projet->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Créer le jalon</button>
                </div>
            </form>
        </div>
    </div>
</div>
