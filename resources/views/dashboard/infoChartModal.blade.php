<!-- Modal -->
<div class="modal fade" id="graphInfoModal" tabindex="-1" role="dialog" aria-labelledby="graphInfoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="graphInfoModalLabel">
                    <i class="fas fa-chart-line text-primary mr-2"></i>
                    Guide complet du Burn-down chart
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Section Définition -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-book-open mr-2"></i>
                        Qu'est-ce qu'un Burn-down chart ?
                    </h5>
                    <p>Outil visuel de gestion de projet agile (comme Scrum) qui montre :</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-arrow-right text-muted mr-2"></i>Quantité de travail restant (axe Y) vs
                            temps (axe X)</li>
                        <li><i class="fas fa-arrow-right text-muted mr-2"></i>Avancement du projet en un coup d'œil</li>
                        <li><i class="fas fa-arrow-right text-muted mr-2"></i>Prévision de la date de fin</li>
                    </ul>
                </div>

                <!-- Éléments du graphique -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Éléments du graphique
                        </h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6><span class="badge badge-primary">X</span> Axe horizontal</h6>
                                <p class="small mb-0">Dates du projet (début → fin)</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6><span class="badge badge-primary">Y</span> Axe vertical</h6>
                                <p class="small mb-0">Nombre d'activités restantes</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-3 bg-light">
                            <div class="card-body">
                                <h6 class="text-primary">
                                    <span class="badge badge-primary mr-2">&nbsp;</span>
                                    Ligne bleue (Théorique)
                                </h6>
                                <p class="small mb-0">Descend régulièrement de 100% à 0% selon le planning idéal</p>
                            </div>
                        </div>
                        <div class="card mb-3 bg-light">
                            <div class="card-body">
                                <h6 class="text-success">
                                    <span class="badge badge-success mr-2">&nbsp;</span>
                                    Ligne verte (Réelle)
                                </h6>
                                <p class="small mb-0">Calculée à partir des dates de fin réelles des activités</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interprétation -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-search mr-2"></i>
                        Interprétation
                    </h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-danger">
                                <div class="card-body">
                                    <h6 class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        RETARD
                                    </h6>
                                    <p class="small mb-0">Ligne verte AU-DESSUS de la bleue → Plus de travail que prévu
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-success">
                                <div class="card-body">
                                    <h6 class="text-success">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        AVANCE
                                    </h6>
                                    <p class="small mb-0">Ligne verte EN-DESSOUS → Progression plus rapide</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-warning">
                                <div class="card-body">
                                    <h6 class="text-warning">
                                        <i class="fas fa-random mr-2"></i>
                                        VARIATIONS
                                    </h6>
                                    <p class="small mb-0">Croisements fréquents → Alternance de
                                        progression/ralentissements</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indicateurs & Cas concrets -->
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Indicateurs clés
                        </h5>
                        <ul class="list-group small">
                            <li class="list-group-item">
                                <strong>Activités restantes :</strong><br>
                                Total des tâches non terminées
                            </li>
                            <li class="list-group-item">
                                <strong>Progression :</strong><br>
                                % d'avancement (projet spécifique ou moyenne globale)
                            </li>
                            <li class="list-group-item">
                                <strong>Jours :</strong><br>
                                Écoulés vs total prévu
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-lightbulb mr-2"></i>
                            Cas concrets
                        </h5>
                        <div class="accordion" id="examplesAccordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h6 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapseOne">
                                            <i class="fas fa-ideal mr-2"></i>
                                            Cas idéal
                                        </button>
                                    </h6>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#examplesAccordion">
                                    <div class="card-body small">
                                        Ligne verte suit parfaitement la bleue → Projet dans les temps
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h6 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapseTwo">
                                            <i class="fas fa-running mr-2"></i>
                                            Retard rattrapé
                                        </button>
                                    </h6>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#examplesAccordion">
                                    <div class="card-body small">
                                        Vert commence au-dessus → passe en dessous en fin de projet
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conseils -->
                <div class="alert alert-info mt-4 small">
                    <h6 class="alert-heading">
                        <i class="fas fa-microscope mr-2"></i>
                        Pour une meilleure lecture :
                    </h6>
                    <ul class="mb-0">
                        <li>Vérifiez que les dates de fin d'activités sont bien renseignées</li>
                        <li>Utilisez le zoom si beaucoup d'activités (≥ 100)</li>
                        <li>Comparez différents projets avec le sélecteur déroulant</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Compris</button>
            </div>
        </div>
    </div>
</div>
