

<div class="modal fade bs-example-modal-lg show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">JALON</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('jalon.store')}}" method="POST" class="form-material m-t-40">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Nom_jalon">Nom Jalon</label>
                                <input type="text" id="Nom_jalon" name="Nom_jalon" class="form-control" value="{{ old('Nom_jalon') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label text-right col-md-3">Statut</label>

                                <select name="Statut_jalon" class="form-control">
                                    <option value="En cours">En cours</option>
                                    <option value="Achevé">Achevé</option>
                                    <option value="En retard">En retard</option>
                                </select>
                            </div>

                    </div>
                </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea id="Description" name="Description" class="form-control" value="{{ old('Description') }}" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Description">Projet</label>
                        <textarea id="Description" name="Description" class="form-control" value="{{ old('Description') }}" ></textarea>
                    </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Enregistrer les changements</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
