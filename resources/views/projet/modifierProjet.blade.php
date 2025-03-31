<!-- Modal de modification -->
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
</div>
