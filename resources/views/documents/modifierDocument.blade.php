 <!-- Modal d'édition -->
 <div class="modal fade" id="editModal{{ $document->id }}" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form method="POST" action="{{ route('document.update', $document->id) }}">
                 @csrf
                 @method('PUT')

                 <div class="modal-header">
                     <h5 class="modal-title">Modifier le document</h5>
                     <button type="button" class="close" data-dismiss="modal">
                         <span>&times;</span>
                     </button>
                 </div>

                 <div class="modal-body">
                     <div class="form-group">
                         <label>Nom du document</label>
                         <input type="text" name="nom_docs" class="form-control" value="{{ $document->nom_docs }}"
                             required>
                     </div>

                     <div class="form-group">
                         <label>Type de document</label>
                         <select name="type_docs" class="form-control" required>
                             @foreach (['rapport', 'fiche de présence', 'livrable', 'compte rendu', 'manuel', 'autres'] as $type)
                                 <option value="{{ $type }}"
                                     {{ $document->type_docs === $type ? 'selected' : '' }}>
                                     {{ ucfirst($type) }}
                                 </option>
                             @endforeach
                         </select>
                     </div>
                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                     <button type="submit" class="btn btn-primary">Enregistrer</button>
                 </div>
             </form>
         </div>
     </div>
 </div
