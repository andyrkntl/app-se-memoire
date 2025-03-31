<!-- Modal de modification -->
<div class="modal fade" id="editPartiePrenanteModal{{ $entry->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la Partie Prenante</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('partiePrenante.update', $entry->partiePrenante->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <!-- Champ caché pour partie prenante -->
                    <input type="hidden" name="partie_prenante_id" value="{{ $entry->partiePrenante->id }}">

                    <div class="form-group">
                        <label>Projet</label>
                        <select name="projet_id" class="form-control" required>
                            @foreach ($projets as $projet)
                                <option value="{{ $projet->id }}"
                                    {{ $entry->projet->id == $projet->id ? 'selected' : '' }}>
                                    {{ $projet->nom_projet }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Entité</label>
                        <input type="text" class="form-control" name="entite"
                            value="{{ $entry->partiePrenante->entite }}" required>
                    </div>
                    <div class="form-group">
                        <label>Fonction</label>
                        <input type="text" class="form-control" name="fonction" value="{{ $entry->fonction }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" name="nom_partie" value="{{ $entry->nom_partie }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email_partie"
                            value="{{ $entry->email_partie }}">
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" class="form-control" name="contact_partie"
                            value="{{ $entry->contact_partie }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
