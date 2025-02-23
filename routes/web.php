<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\evenementController;
use App\Http\Controllers\jalonController;
use App\Http\Controllers\projetController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\evaluationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\chantierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\partiePrenanteController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\KpsiController;
use App\Http\Controllers\FormulaireController;
use App\Http\Controllers\AgendaController;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/suivi/activite', ActiviteController::class);
Route::resource('/suivi/jalon', jalonController::class);
Route::resource('/suivi/projet', projetController::class);
Route::resource('/suivi/agenda', evenementController::class);
Route::resource('/suivi/lead', leadController::class);
Route::resource('/suivi/evaluation', evaluationController::class);
Route::resource('/Utilisateur', UserController::class);
Route::resource('partiePrenante', partiePrenanteController::class);
Route::resource('chantier', chantierController::class);
Route::resource('agenda', AgendaController::class);

// Assurez-vous de ne garder que cette ligne pour KpsiController
Route::resource('kpsi', KpsiController::class);

// Routes pour le calendrier et la gestion des événements
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
Route::get('/calendar/{id}', [CalendarController::class, 'show'])->name('calendar.show');
Route::put('/calendar/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::delete('/calendar/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
Route::get('/calendar/filter', [CalendarController::class, 'filter'])->name('calendar.filter');
Route::post('/calendar/store', [CalendarController::class, 'store'])->name('calendar.store');
Route::get('/jalon/{id}/edit', [jalonController::class, 'edit'])->name('jalon.edit');
Route::put('/jalon/{id}', [jalonController::class, 'update'])->name('jalon.update');
Route::put('/jalon/{id}', [jalonController::class, 'destroy'])->name('jalon.destroy');
Route::delete('partiePrenante/{id}', [PartiePrenanteController::class, 'destroy'])->name('partiePrenante.destroy');
Route::get('partiePrenante', [PartiePrenanteController::class, 'index'])->name('partiePrenante.index');
Route::get('/activites', [ActiviteController::class, 'index'])->name('activite.index');
Route::put('/activites/{id}', [ActiviteController::class, 'update'])->name('activite.update');
Route::get('/activites/{id}/edit', [ActiviteController::class, 'edit'])->name('activite.edit');
Route::get('/accueil', [AccueilController::class, 'index'])->name('accueil');
Route::get('/formulaires', [FormulaireController::class, 'index'])->name('formulaires.index');

// Route pour afficher le formulaire de création
Route::get('/formulaire/create', [FormulaireController::class, 'create'])->name('formulaires.create');


// Route pour enregistrer un nouveau formulaire
Route::post('/formulaires', [FormulaireController::class, 'store'])->name('formulaires.store');
Route::delete('/formulaires/{id}', [FormulaireController::class, 'destroy'])->name('formulaires.destroy');
// Route pour afficher la page de l'agenda
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

// Route pour afficher le formulaire d'ajout d'un événement
Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');

// Route pour enregistrer un nouvel événement (AJAX)
Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');

// Route pour afficher les détails d'un événement
Route::get('/agenda/{id}', [AgendaController::class, 'show'])->name('agenda.show');

// Route pour afficher le formulaire de modification d'un événement
Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');

// Route pour mettre à jour un événement (AJAX)
Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');

// Route pour supprimer un événement (AJAX)
Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');

// Route pour l'API FullCalendar (retourne les événements au format JSON)
Route::get('/api/events', [AgendaController::class, 'getEvents'])->name('api.events');
