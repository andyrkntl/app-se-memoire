<div class="modal fade bs-example-modal-lg show" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTIVITE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('activite.store') }}" method="POST" class="form-material m-t-40">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom Activite</label>
                                <input type="text" name="Nom_activite" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Statut</label>
                                <select name="Statut_activite" class="form-control">
                                    <option value="En cours">En cours</option>
                                    <option value="Achevé">Achevé</option>
                                    <option value="En retard">En retard</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Projet</label>
                                <select class="form-control" name="projet_id">
                                    @foreach ($projet as $projet)
                                        <option name="projet_id" value="{{ $projet->id }}">{{ $projet->Nom_projet }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jalon</label>
                                <select class="form-control" name="jalon_id">
                                    @foreach ($jalon as $jalon)
                                        <option name="jalon_id" value="{{ $jalon->id }}">{{ $jalon->Nom_jalon }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Valeur actuel</label>
                                <input type="text" name="Valeur_actuel" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Valeur Cible</label>
                                <input type="text" name="Valeur_cible" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date Debut</label>
                                <input type="date" name="Date_debut" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date Fin</label>
                                <input type="date" name="Date_fin" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Prochaines etapes</label>
                        <textarea name="Prochaine_etape" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="Description_activite" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Enregistrer les changements</button>
            </div>
            </form>
        </div>
    </div>
