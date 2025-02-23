<div class="modal fade bs-example-modal-lg show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PROJET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('projet.store')}}" method="POST" class="form-material m-t-40">
                    @csrf
                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ressources</label>
                                <input type="text" name="Ressources" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" name="lead_id">
                                <label>Nom lead</label>
                                <select class="form-control" name="lead_id" >
                                    @foreach ($lead as $lead)
                                        <option name="lead_id" value="{{$lead->id}}">{{$lead->Nom_lead}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom du chantier</label>
                                <select class="form-control" name="chantier_id" >
                                    @foreach ($chantier as $chantier)
                                        <option name="chantier_id" value="{{$chantier->id}}">{{$chantier->Nom_chantier}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Parties prenantes</label>
                                <select class="form-control" name="partiePrenante_id">
                                    @foreach ($partie as $partie)
                                        <option name="partiePrenante_id" value="{{$partie->id}}">{{$partie->Nom_partie}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom Projet</label>
                                <input type="text" name="Nom_projet" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description </label>
                                <input type="text" name="Description" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Duree</label>
                                <input type="text" name="Duree_projet" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Objectif</label>
                                <input type="text" name="Objectif" class="form-control">
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Statut</label>
                                <input type="text" name="statut" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Historiques</label>
                                <input type="text" name="Historiques" class="form-control">
                            </div>
                        </div>




                    </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Enregistrer les changements</button>
            </div>
        </form>
    </div>
</div>
