<div class="modal fade bs-example-modal-lg show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTIVITE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Utilisateur.store') }}" method="POST" class="form-material m-t-40">
                    @csrf
                    <div class="row">
                        <!-- Champ Nom de l'utilisateur -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nom de l'utilisateur</label>
                                <input type="text" name="name" class="form-control" required>
                                @error('nom_utilisateur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Champ Email -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Champ Mot de Passe -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Mot de Passe</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('mot_de_passe')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Champ Validation Mot de Passe -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Validation Mot de Passe</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('mot_de_passe_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer les changements</button>
                    </div>
                </form>

    </div>
</div>
