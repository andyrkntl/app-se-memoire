<!-- Modal -->
<div class="modal fade" id="addPartiePrenanteModal" tabindex="-1" role="dialog"
    aria-labelledby="addPartiePrenanteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('partie-prenante.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPartiePrenanteModalLabel">Ajouter une Partie Prenante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="projet_id">Projet</label>
                        <select name="projet_id" id="projet_id" class="form-control" required>
                            @foreach (App\Models\Projet::all() as $projet)
                                <option value="{{ $projet->id }}">{{ $projet->nom_projet }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="entite">Partie Prenante</label>
                        <input type="text" name="entite" id="entite" class="form-control"
                            placeholder="Nom de l'entité (ex : ministère, banque mondiale, etc)" required>
                    </div>

                    <div class="form-group">
                        <label for="fonction">Fonction</label>
                        <input type="text" name="fonction" id="fonction" class="form-control"
                            placeholder="Poste de la personne" required>
                    </div>

                    <div class="form-group">
                        <label for="nom_partie">Nom</label>
                        <input type="text" name="nom_partie" id="nom_partie" class="form-control"
                            placeholder="Nom complet" required>
                    </div>

                    <div class="form-group">
                        <label for="email_partie">Email</label>
                        <input type="email" name="email_partie" id="email_partie" class="form-control"
                            placeholder="exemple@domaine.com">
                    </div>

                    <div class="form-group">
                        <label for="contact_partie">Contact</label>
                        <input type="text" name="contact_partie" id="contact_partie" class="form-control"
                            placeholder="Numéro de téléphone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
