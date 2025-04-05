<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


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
        return redirect()->away($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = $this->getClient();
        $client->fetchAccessTokenWithAuthCode($request->input('code'));

        $accessToken = $client->getAccessToken();
        session(['google_access_token' => $accessToken]);

        return redirect()->route('agenda.events');
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
}
