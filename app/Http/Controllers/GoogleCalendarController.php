<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Carbon\Carbon;
use Google\Service\Calendar\EventDateTime;
use Illuminate\Support\Facades\Log;




class GoogleCalendarController extends Controller
{
    private function getClient()
    {
        $client = new \Google\Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->setAccessType('offline');
        $client->setScopes(\Google\Service\Calendar::CALENDAR);

        // Ajouter le chemin du certificat directement
        $client->setHttpClient(new \GuzzleHttp\Client([
            'verify' => storage_path('cacert.pem')
        ]));

        return $client;
    }

    public function redirectToGoogle()
    {
        $client = $this->getClient();
        // Utiliser state pour stocker l'ID de l'activité
        $pendingActivityId = session('pending_activity_id');
        if ($pendingActivityId) {
            $client->setState($pendingActivityId);
            Log::info("ID d'activité {$pendingActivityId} stocké dans le state OAuth");
        }

        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }


    public function handleGoogleCallback()
    {
        $client = $this->getClient();
        $accessToken = $client->fetchAccessTokenWithAuthCode(request('code'));

        if (isset($accessToken['error'])) {
            Log::error(" Erreur OAuth : " . json_encode($accessToken));
            return redirect()->route('agenda.events')->with('error', 'Erreur d’authentification Google.');
        }

        session(['google_access_token' => $accessToken]);
        Log::info(" Token Google OAuth stocké : " . json_encode($accessToken));
        // Récupérer l'ID de l'activité depuis le state OAuth
        $activityId = request()->input('state');
        Log::info(" State reçu du callback OAuth: " . $activityId);

        if ($activityId) {
            Log::info(" Retour après OAuth pour ajout de l'activité $activityId");
            return $this->createGoogleEventFromActivity($activityId);
        }


        Log::warning(" Aucune activité en attente dans la session. Redirection simple.");
        return redirect()->route('agenda.events')->with('info', 'Authentification réussie, mais aucune activité à ajouter.');
    }






    public function listEvents()
    {
        if (!session('google_access_token')) {
            return redirect()->route('google.redirect');
        }

        $timezone = 'Africa/Nairobi';
        Carbon::setLocale('fr');
        $client = $this->getClient();
        $client->setAccessToken(session('google_access_token'));

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                session(['google_access_token' => $client->getAccessToken()]);
            } else {
                return redirect()->route('google.redirect');
            }
        }

        // Calcul des dates avec Carbon
        $monday = Carbon::now($timezone)->startOfWeek(Carbon::MONDAY);
        $friday = $monday->copy()->endOfWeek(Carbon::FRIDAY);

        $weekLabel = 'SEMAINE DU ' . $monday->isoFormat('DD MMMM YYYY');

        $service = new \Google\Service\Calendar($client);
        $events = $service->events->listEvents('primary', [
            'timeMin' => $monday->toRfc3339String(),
            'timeMax' => $friday->toRfc3339String(),
            'singleEvents' => true,
            'orderBy' => 'startTime',
        ]);

        $eventData = [];
        foreach ($events->getItems() as $event) {
            $start = $event->getStart()->getDateTime() ?: $event->getStart()->getDate();
            $end = $event->getEnd()->getDateTime() ?: $event->getEnd()->getDate();

            $startDateTime = Carbon::parse($start)->setTimezone($timezone);
            $endDateTime = Carbon::parse($end)->setTimezone($timezone);

            // Ignorer les événements multi-jours
            if ($startDateTime->format('Y-m-d') !== $endDateTime->format('Y-m-d')) {
                continue;
            }

            $timePart = $event->getStart()->getDateTime()
                ? $startDateTime->isoFormat('HH[h]mm')
                : 'Toute la journée';

            $location = $event->getLocation() ? ', ' . $event->getLocation() : '';

            $eventData[] = [
                'titre' => $event->getSummary(),
                'date' => $startDateTime->format('Y-m-d'),
                'timeAndLocation' => $timePart . $location,
                'description' => $event->getDescription()
            ];
        }

        return view('agenda.events', [
            'events' => $eventData,
            'weekLabel' => mb_strtoupper($weekLabel, 'UTF-8'),
            'days' => [
                'monday' => $monday,
                'tuesday' => $monday->copy()->addDay(),
                'wednesday' => $monday->copy()->addDays(2),
                'thursday' => $monday->copy()->addDays(3),
                'friday' => $monday->copy()->addDays(4)
            ]
        ]);
    }




    public function addToGoogleCalendar($id)
    {
        Log::info(" Entrée dans addToGoogleCalendar() avec ID: $id");

        // Vérifier si l'activité existe
        $activite = Activite::find($id);
        if (!$activite) {
            Log::error(" Activité non trouvée avec ID: $id");
            return redirect()->back()->with('error', "Activité non trouvée.");
        }

        // Stocker l'ID dans la session
        session(['pending_activity_id' => $id]);
        Log::info(" ID d'activité stocké dans la session: $id");

        // Vérification de l'accès
        if (!session('google_access_token')) {
            Log::info(" Pas de token Google, redirection vers l'authentification");
            return redirect()->route('google.redirect');
        }

        // Si le token est là, appel de la logique
        return $this->createGoogleEventFromActivity($id);
    }




    private function createGoogleEventFromActivity($id)
    {
        try {
            Log::info(" Début de createGoogleEventFromActivity() avec ID: $id");

            $activite = Activite::find($id);
            if (!$activite) {
                Log::error(" Activité non trouvée avec ID: $id");
                return redirect()->route('agenda.events')->with('error', "Activité non trouvée.");
            }

            Log::info(" Activité récupérée : " . json_encode($activite));

            $client = $this->getClient();
            $client->setAccessToken(session('google_access_token'));

            if ($client->isAccessTokenExpired()) {
                Log::warning(" Token expiré. Tentative de rafraîchissement...");
                if ($client->getRefreshToken()) {
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                    session(['google_access_token' => $client->getAccessToken()]);
                    Log::info(" Token rafraîchi.");
                } else {
                    Log::warning(" Pas de refresh token. Redirection vers Google.");
                    session(['pending_activity_id' => $id]);
                    return redirect()->route('google.redirect');
                }
            }

            $service = new \Google\Service\Calendar($client);

            $datePart = Carbon::parse($activite->date_debut)->format('Y-m-d');
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $datePart . ' ' . $activite->heure_reunion, 'Africa/Nairobi');
            $endDateTime = $startDateTime->copy()->addHour();

            Log::info(" Création de l'événement entre {$startDateTime->toDateTimeString()} et {$endDateTime->toDateTimeString()}");

            $event = new \Google\Service\Calendar\Event([
                'summary' => $activite->nom_activite,
                'location' => $activite->lieu_reunion,
                'description' => $activite->description_reunion,
                'start' => [
                    'dateTime' => $startDateTime->toRfc3339String(),
                    'timeZone' => 'Africa/Nairobi',
                ],
                'end' => [
                    'dateTime' => $endDateTime->toRfc3339String(),
                    'timeZone' => 'Africa/Nairobi',
                ],
            ]);

            Log::info("Envoi de l'événement à Google Calendar...");
            $createdEvent = $service->events->insert('primary', $event);

            $activite->google_calendar_id = $createdEvent->id;
            $activite->google_calendar_link = $createdEvent->htmlLink;
            $activite->save();

            Log::info(" Événement ajouté dans Google Calendar avec ID: " . $createdEvent->id);
            Log::info(" Lien de l'événement : " . $createdEvent->htmlLink);

            return redirect()->route('agenda.events')->with('success', 'Activité ajoutée dans Google Calendar.');
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'ajout à Google Calendar : " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return redirect()->route('agenda.events')->with('error', 'Erreur lors de l\'ajout à Google Calendar: ' . $e->getMessage());
        }
    }
}
