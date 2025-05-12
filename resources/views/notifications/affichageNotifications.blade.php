<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-solid fa-bullhorn"></i>
        @if (count($activiteNotifications) > 0)
            <span class="badge badge-danger" id="notificationCounter">{{ count($activiteNotifications) }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown"
        style="max-height: 400px; overflow-y: auto;">
        <h6 class="dropdown-header">Notifications</h6>
        @forelse($activiteNotifications as $notif)
            <a class="dropdown-item" href="#" style="white-space: normal;">
                <a class="dropdown-item" href="#">
                    <i class="fa-solid fa-arrow-right"></i> {{ $notif->nom_activite }} <br>

                    <!-- Affichage du jalon et du projet -->
                    @if ($notif->jalon)
                        <small>
                            <i class="fa-solid fa-flag"></i> {{ $notif->jalon->nom_jalon }}
                            @if ($notif->jalon->projet)
                                | <i class="fa-solid fa-folder"></i> {{ $notif->jalon->projet->nom_projet }}
                            @endif
                        </small><br>
                    @endif


                    @if ($notif->statut_activite == 'En retard')
                        <small class="text-danger">En retard depuis
                            {{ $notif->date_prevue->diffForHumans() }}</small>
                    @elseif($notif->date_prevue->isToday() && !$notif->heure_reunion)
                        <small class="text-warning">Prévue aujourd'hui</small>
                    @elseif($notif->date_prevue->isSameDay(now()->addDays(15)))
                        <small class="text-info">Prévue dans 15 jours</small>
                    @elseif($notif->date_prevue->isSameDay(now()->addDays(7)))
                        <small class="text-info">Prévue dans 7 jours</small>
                    @elseif($notif->date_prevue->isSameDay(now()->addDays(3)))
                        <small class="text-info">Prévue dans 3 jours</small>
                    @elseif($notif->date_prevue->isSameDay(now()->addDay()))
                        <small class="text-info">Prévue demain</small>
                    @endif

                    @if ($notif->heure_reunion)
                        @if (
                            $notif->date_debut &&
                                $notif->date_debut->ne($notif->date_prevue) &&
                                now()->startOfDay()->between($notif->date_debut, $notif->date_prevue))
                            <small class="text-primary"><i class="fa-solid fa-stopwatch"></i>
                                Réunion en cours du {{ $notif->date_debut->format('d/m/Y') }} au
                                {{ $notif->date_prevue->format('d/m/Y') }}
                                à {{ $notif->heure_reunion }} à {{ $notif->lieu_reunion }}</small>
                        @elseif ($notif->date_prevue->isToday())
                            <small class="text-primary"><i class="fa-solid fa-stopwatch"></i>
                                Réunion aujourd'hui à {{ $notif->heure_reunion }} à {{ $notif->lieu_reunion }}</small>
                        @endif
                    @endif
                </a> </a>
        @empty
            <a class="dropdown-item text-muted" href="#">Aucune notification</a>
        @endforelse
    </div>
</li>
