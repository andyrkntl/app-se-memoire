<!-- Modal de modification -->
<div class="modal fade" id="editUserModal{{ $utilisateur->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editUserModalLabel{{ $utilisateur->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('utilisateur.update', $utilisateur->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel{{ $utilisateur->id }}">Modifier l'utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name{{ $utilisateur->id }}">Nom</label>
                        <input type="text" class="form-control" id="name{{ $utilisateur->id }}" name="name"
                            value="{{ $utilisateur->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email{{ $utilisateur->id }}">Email</label>
                        <input type="email" class="form-control" id="email{{ $utilisateur->id }}" name="email"
                            value="{{ $utilisateur->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role{{ $utilisateur->id }}">Rôle</label>
                        <select class="form-control" id="role{{ $utilisateur->id }}" name="role" required>
                            <option value="admin" {{ $utilisateur->role === 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="commentateur" {{ $utilisateur->role === 'commentateur' ? 'selected' : '' }}>
                                Commentateur</option>
                            <option value="lecteur" {{ $utilisateur->role === 'lecteur' ? 'selected' : '' }}>Lecteur
                            </option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
