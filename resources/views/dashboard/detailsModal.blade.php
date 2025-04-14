<!-- Modal : Tous les Projets -->
<div class="modal fade" id="modalProjets" tabindex="-1" role="dialog" aria-labelledby="modalProjetsLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalProjetsLabel">Liste de tous les projets</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($listeProjets->count())
                    <ul class="list-group">
                        @foreach ($listeProjets as $projet)
                            <li class="list-group-item">
                                <strong>{{ $projet->nom_projet }}</strong><br>
                                <small class="text-muted">
                                    Début : {{ \Carbon\Carbon::parse($projet->date_debut)->format('d/m/Y') }} <br>
                                    Fin : {{ \Carbon\Carbon::parse($projet->date_fin)->format('d/m/Y') }} <br>
                                    📊 Avancement : {{ $projet->taux_avancement }}%
                                </small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Aucun projet disponible pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Modal : Activités de la semaine -->
<div class="modal fade" id="modalActivitesSemaine" tabindex="-1" role="dialog" aria-labelledby="activitesSemaineLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activités prévues cette semaine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (count($listeActivitesSemaine))
                    <ul class="list-group">
                        @foreach ($listeActivitesSemaine as $activite)
                            <li class="list-group-item">
                                <strong>{{ $activite->nom_activite }}</strong><br>
                                <small class="text-muted">
                                    📅 Date prévue :
                                    {{ \Carbon\Carbon::parse($activite->date_prevue)->format('d/m/Y') }}<br>

                                    Jalon :
                                    @if ($activite->jalon)
                                        {{ $activite->jalon->nom_jalon ?? 'Nom non défini' }}
                                    @else
                                        <span class="text-danger">Jalon non défini</span>
                                    @endif
                                    <br>

                                    Projet :
                                    @if ($activite->jalon && $activite->jalon->projet)
                                        {{ $activite->jalon->projet->nom_projet ?? 'Nom non défini' }}
                                    @else
                                        <span class="text-danger">Projet non défini</span>
                                    @endif
                                </small>
                                @if ($activite->statut_activite)
                                    <span class="badge badge-info float-right">{{ $activite->statut_activite }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucune activité prévue cette semaine.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal : Projets à risques -->
<div class="modal fade" id="modalProjetsRisques" tabindex="-1" role="dialog" aria-labelledby="projetsRisquesLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Projets à Risques</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (count($listeProjetsRisques))
                    <ul class="list-group">
                        @foreach ($listeProjetsRisques as $projet)
                            <li class="list-group-item">
                                <strong>{{ $projet->nom_projet }}</strong> — Fin prévue :
                                {{ \Carbon\Carbon::parse($projet->date_fin)->format('d/m/Y') }}
                                <span class="badge badge-danger float-right">{{ $projet->taux_avancement }}%</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucun projet à risque actuellement.</p>
                @endif
            </div>
        </div>
    </div>
</div>
