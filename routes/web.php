<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\jalonController;
use App\Http\Controllers\projetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PartiePrenanteController;
use App\Http\Controllers\GoogleCalendarController;



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/suivi/projet', projetController::class);


Route::post('/projets', [ProjetController::class, 'store'])->name('projet.store');
Route::delete('/projet/{id}', [ProjetController::class, 'destroy'])->name('projet.destroy');
Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projet.update');


Route::get('/partiePrenantes', [PartiePrenanteController::class, 'index'])->name('partiePrenante.index');
Route::post('/partie-prenante/ajouter', [PartiePrenanteController::class, 'store'])->name('partie-prenante.store');
Route::put('/partieprenante/{id}', [PartiePrenanteController::class, 'update'])->name('partieprenante.update');
Route::delete('/partieprenante/{id}', [PartiePrenanteController::class, 'destroy'])->name('partieprenante.destroy');


Route::post('/projets/{projet}/jalons', [JalonController::class, 'store'])->name('jalon.store');
Route::put('/jalons/{jalon}', [JalonController::class, 'update'])->name('jalon.update');
Route::delete('/jalons/{id}', [JalonController::class, 'destroy'])->name('jalon.destroy');



Route::post('/activites', [ActiviteController::class, 'store'])->name('activite.store');
Route::get('/activites/{activite}/edit', [ActiviteController::class, 'edit'])->name('activite.edit');
Route::put('/activites/{activite}', [ActiviteController::class, 'update'])->name('activite.update');
Route::delete('/activites/{activite}', [ActiviteController::class, 'destroy'])->name('activite.destroy');
Route::get('/projet/{id}/activites/filter', [ActiviteController::class, 'filter'])->name('activite.filter');



Route::post('/documents', [DocumentController::class, 'store'])->name('document.store');
Route::get('/projets/{projet}/documents', [DocumentController::class, 'index'])->name('document.index');
Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('document.update');
Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('document.destroy');




Route::get('/agenda', function () {
    return view('agenda.googleAgenda');
});

Route::get('/google/redirect', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);
Route::get('/google/events', [GoogleCalendarController::class, 'listEvents'])->name('agenda.events');
Route::post('/activites/{id}/add-to-google-calendar', [GoogleCalendarController::class, 'addToGoogleCalendar'])->name('activites.googlecalendar');
