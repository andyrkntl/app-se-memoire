<div class="modal fade bs-example-modal-lg show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Indicateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('kpsi.store')}}" method="POST" class="form-material m-t-40">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom </label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" id="description" name="description"  required></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Objectif</label>
                                <input type="text" class="form-control" id="target_value" name="target_value" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="" disabled selected>Choisir un type</option>
                                    <option value="qualitatif">Qualitatif</option>
                                    <option value="quantitatif">Quantitatif</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Statut</label>
                                <select class="form-control" id="achieved" name="achieved" required>
                                    <option value="" disabled selected>Choisir un statut</option>
                                    <option value="atteint">Atteint</option>
                                    <option value="non_atteint">Non atteint</option>
                                </select>
                            </div>
                        </div>


                    </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Enregistrer les changements</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
