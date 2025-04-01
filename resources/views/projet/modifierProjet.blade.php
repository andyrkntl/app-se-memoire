{{-- <!-- Modal de modification -->
<div class="modal fade" id="editProjetModal" tabindex="-1" role="dialog" aria-labelledby="editProjetModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjetModalLabel">Modifier le Projet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('projet.update', $projet->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="chantier_id" class="form-label">Chantier</label>
                        <select name="chantier_id" id="chantier_id" class="form-control" required>
                            @foreach ($chantiers as $chantier)
                                <option value="{{ $chantier->id }}"
                                    {{ $projet->chantier_id == $chantier->id ? 'selected' : '' }}>
                                    {{ $chantier->nom_chantier }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lead_id" class="form-label">Lead</label>
                        <select name="lead_id" id="lead_id" class="form-control" required>
                            @foreach ($leads as $lead)
                                <option value="{{ $lead->id }}"
                                    {{ $projet->lead_id == $lead->id ? 'selected' : '' }}>
                                    {{ $lead->nom_lead }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nom_projet" class="form-label">Nom du projet</label>
                        <input type="text" name="nom_projet" id="nom_projet" class="form-control"
                            value="{{ $projet->nom_projet }}" required>
                    </div>

                    <div class="form-group">
                        <label for="objectifs" class="form-label">Objectifs</label>
                        <textarea name="objectifs" id="objectifs" class="form-control" rows="3" required>{{ $projet->objectifs }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control"
                            value="{{ $projet->date_debut }}">
                    </div>

                    <div class="form-group">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control"
                            value="{{ $projet->date_fin }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}



<div class="modal fade" id="editProjetModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le Projet</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editProjetForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Chantier -->
                    <div class="form-group">
                        <label>Chantier</label>
                        <select name="chantier_id" class="form-control" id="edit_chantier_id" required>
                            @foreach ($chantiers as $chantier)
                                <option value="{{ $chantier->id }}">{{ $chantier->nom_chantier }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lead -->
                    <div class="form-group">
                        <label>Lead</label>
                        <select name="lead_id" class="form-control" id="edit_lead_id" required>
                            @foreach ($leads as $lead)
                                <option value="{{ $lead->id }}">{{ $lead->nom_lead }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Autres champs -->
                    <div class="form-group">
                        <label>Nom du projet</label>
                        <input type="text" name="nom_projet" id="edit_nom_projet" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Objectifs</label>
                        <textarea name="objectifs" id="edit_objectifs" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Date de début</label>
                        <input type="date" name="date_debut" id="edit_date_debut" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Date de fin</label>
                        <input type="date" name="date_fin" id="edit_date_fin" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Écouteur pour les boutons "Modifier"
        document.querySelectorAll('.edit-projet-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Récupération des données
                const projetId = this.dataset.projetId;
                const chantierId = this.dataset.chantierId;
                const leadId = this.dataset.leadId;

                // Mise à jour du formulaire
                document.getElementById('editProjetForm').action = `/projets/${projetId}`;
                document.getElementById('edit_nom_projet').value = this.dataset.nomProjet;
                document.getElementById('edit_objectifs').value = this.dataset.objectifs;
                document.getElementById('edit_date_debut').value = this.dataset.dateDebut;
                document.getElementById('edit_date_fin').value = this.dataset.dateFin;

                // Sélection des options dans les <select>
                document.getElementById('edit_chantier_id').value = chantierId;
                document.getElementById('edit_lead_id').value = leadId;
            });
        });
    });
</script>
