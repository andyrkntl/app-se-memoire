@foreach ($pivotEntries as $entry)
    <div class="modal fade" id="editModal-{{ $entry->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel-{{ $entry->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la partie prenante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('partieprenante.update', $entry->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Entité</label>
                            <input type="text" class="form-control" value="{{ $entry->partiePrenante->entite }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Fonction</label>
                            <input type="text" name="fonction" class="form-control" value="{{ $entry->fonction }}">
                        </div>
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom_partie" class="form-control"
                                value="{{ $entry->nom_partie }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email_partie" class="form-control"
                                value="{{ $entry->email_partie }}">
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact_partie" class="form-control"
                                value="{{ $entry->contact_partie }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
