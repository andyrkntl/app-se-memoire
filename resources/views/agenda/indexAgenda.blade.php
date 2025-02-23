@extends('layouts.layouts')

@section('content')
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
        <title>Agenda</title>
        <!-- Bootstrap Core CSS -->
        <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- FullCalendar CSS
            <link href="/assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet">-->
        <!-- Custom CSS -->
        <link href="/css/style.css" rel="stylesheet">
        <!-- Theme Colors -->
        <link href="/css/colors/blue.css" id="theme" rel="stylesheet">
        <!-- FullCalendar CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>


        <!-- FullCalendar JS -->
        <!-- jQuery
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

        <!-- Moment.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <!-- FullCalendar -->
        <script src="{{ asset('assets/plugins/calendar/dist/fullcalendar.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#menu').metisMenu();
            });
        </script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>

    <body>
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Agenda</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Agenda</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
                <div class="d-flex m-t-10 justify-content-end">
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Ajouter un nouvel événement
                    </a>
                </div>
            </div>
        </div>

        <!-- FullCalendar -->
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>

        <!-- Modal pour ajouter/modifier un événement -->
        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Ajouter/Modifier un événement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="eventForm" action="/save-event" method="POST">
                            @csrf
                            <input type="hidden" id="eventId" name="id">
                            <div class="form-group">
                                <label for="Objet_evenement">Objet de l'événement</label>
                                <input type="text" class="form-control" id="Objet_evenement" name="Objet_evenement"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="Debut_evenement">Début de l'événement</label>
                                <input type="datetime-local" class="form-control" id="Debut_evenement"
                                    name="Debut_evenement" required>
                            </div>
                            <div class="form-group">
                                <label for="Fin_evenement">Fin de l'événement</label>
                                <input type="datetime-local" class="form-control" id="Fin_evenement" name="Fin_evenement"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="type">Type d'événement</label>
                                <input type="text" class="form-control" id="type" name="type" required>
                            </div>
                            <div class="form-group">
                                <label for="Statut_evenement">Statut de l'événement</label>
                                <input type="text" class="form-control" id="Statut_evenement" name="Statut_evenement"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="Commentaires_evenement">Commentaires</label>
                                <textarea class="form-control" id="Commentaires_evenement" name="Commentaires_evenement"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" id="saveEvent">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/plugins/calendar/jquery-ui.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="/assets/plugins/popper/popper.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/jquery.slimscroll.js"></script>
        <!--Wave Effects -->
        <script src="js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--stickey kit -->
        <script src="/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>
        <!-- MetisMenu (si utilisé) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/metismenu/3.0.7/metisMenu.min.js"></script>

        <!-- Chargement de ton fichier local si nécessaire -->
        <script src="{{ asset('assets/plugins/calendar/dist/fullcalendar.min.js') }}"></script>
        <!-- Calendar JavaScript -->
        <script src="/assets/plugins/calendar/jquery-ui.min.js"></script>
        <script src="/assets/plugins/moment/moment.js"></script>
        <script src="/assets/plugins/calendar/dist/fullcalendar.min.js"></script>
        <script src="/assets/plugins/calendar/dist/cal-init.js"></script>
        <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/plugins/moment/moment.min.js"></script>
        <script src="/assets/plugins/calendar/dist/fullcalendar.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    editable: true,
                    selectable: true,
                    events: '/api/events', // API pour récupérer les événements
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    dateClick: function(info) {
                        console.log('Date clicked:', info.dateStr);
                        // Afficher le modal pour ajouter un événement
                        $('#eventModal').modal('show');
                        document.getElementById('Debut_evenement').value = info.dateStr + 'T00:00';
                        document.getElementById('Fin_evenement').value = info.dateStr + 'T23:59';
                    },
                    eventClick: function(info) {
                        console.log('Event clicked:', info.event);
                        // Afficher le modal pour modifier un événement
                        $('#eventModal').modal('show');
                        document.getElementById('eventId').value = info.event.id;
                        document.getElementById('Objet_evenement').value = info.event.title;
                        document.getElementById('Debut_evenement').value = moment(info.event.start).format(
                            'YYYY-MM-DDTHH:mm');
                        document.getElementById('Fin_evenement').value = moment(info.event.end).format(
                            'YYYY-MM-DDTHH:mm');
                        document.getElementById('type').value = info.event.extendedProps.type;
                        document.getElementById('Statut_evenement').value = info.event.extendedProps.statut;
                        document.getElementById('Commentaires_evenement').value = info.event.extendedProps
                            .commentaires;
                    }
                });
                calendar.render();

                // Enregistrer un événement
                document.getElementById('saveEvent').addEventListener('click', function() {
                    const form = document.getElementById('eventForm');
                    const formData = new FormData(form);

                    fetch(form.action, {
                            method: form.method,
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Événement enregistré avec succès!');
                                // Fermer la modal ou rediriger l'utilisateur
                            } else {
                                alert('Erreur lors de l\'enregistrement de l\'événement.');
                            }
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                        });
                });
            });
        </script>
    </body>

    </html>
@endsection
