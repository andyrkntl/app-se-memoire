<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\jalonController;
use App\Http\Controllers\projetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PartiePrenanteController;



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/suivi/projet', projetController::class);



Route::post('/projets', [ProjetController::class, 'store'])->name('projet.store');
Route::delete('/projet/{id}', [ProjetController::class, 'destroy'])->name('projet.destroy');
Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projet.update');


Route::get('/partiePrenantes', [PartiePrenanteController::class, 'index'])->name('partiePrenante.index');
Route::post('/partie-prenante/ajouter', [PartiePrenanteController::class, 'store'])->name('partie-prenante.store');
Route::put('/partie-prenante/{id}', [PartiePrenanteController::class, 'update'])->name('partiePrenante.update');




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










// Route::resource('/suivi/activite', ActiviteController::class);
// Route::resource('/suivi/jalon', jalonController::class);

// Route::resource('/suivi/agenda', evenementController::class);
// Route::resource('/suivi/lead', leadController::class);
// Route::resource('/suivi/evaluation', evaluationController::class);
// Route::resource('/Utilisateur', UserController::class);
// Route::resource('partiePrenante', partiePrenanteController::class);
// Route::resource('chantier', chantierController::class);
// Route::resource('agenda', AgendaController::class);
// Route::resource('activite', 'ActiviteController')->except(['create', 'show']);
// // Routes pour les activités
// Route::put('/activites/{id}', [ActiviteController::class, 'update'])->name('activite.update');


// // Assurez-vous de ne garder que cette ligne pour KpsiController
// Route::resource('kpsi', KpsiController::class);

// // Routes pour le calendrier et la gestion des événements

// Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
// Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
// Route::get('/calendar/{id}', [CalendarController::class, 'show'])->name('calendar.show');
// Route::put('/calendar/{id}', [CalendarController::class, 'update'])->name('calendar.update');
// Route::delete('/calendar/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
// Route::get('/calendar/filter', [CalendarController::class, 'filter'])->name('calendar.filter');
// Route::post('/calendar/store', [CalendarController::class, 'store'])->name('calendar.store');
// Route::get('/jalon/{id}/edit', [jalonController::class, 'edit'])->name('jalon.edit');
// Route::put('/jalon/{id}', [jalonController::class, 'update'])->name('jalon.update');
// Route::delete('/jalon/{id}', [jalonController::class, 'destroy'])->name('jalon.destroy');
// Route::delete('partiePrenante/{id}', [PartiePrenanteController::class, 'destroy'])->name('partiePrenante.destroy');
// Route::get('partiePrenante', [PartiePrenanteController::class, 'index'])->name('partiePrenante.index');
// Route::get('/activites', [ActiviteController::class, 'index'])->name('activite.index');
// Route::get('/accueil', [AccueilController::class, 'index'])->name('accueil');
// Route::get('/formulaires', [FormulaireController::class, 'index'])->name('formulaires.index');

// // Route pour afficher le formulaire de création
// Route::get('/formulaire/create', [FormulaireController::class, 'create'])->name('formulaires.create');


// // Route pour enregistrer un nouveau formulaire
// Route::post('/formulaires', [FormulaireController::class, 'store'])->name('formulaires.store');
// Route::delete('/formulaires/{id}', [FormulaireController::class, 'destroy'])->name('formulaires.destroy');
// // Route pour afficher la page de l'agenda
// Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

// // Route pour afficher le formulaire d'ajout d'un événement
// Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');

// // Route pour enregistrer un nouvel événement (AJAX)
// Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');

// // Route pour afficher les détails d'un événement
// Route::get('/agenda/{id}', [AgendaController::class, 'show'])->name('agenda.show');

// // Route pour afficher le formulaire de modification d'un événement
// Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');

// // Route pour mettre à jour un événement (AJAX)
// Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');

// // Route pour supprimer un événement (AJAX)
// Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');

// // Route pour l'API FullCalendar (retourne les événements au format JSON)
// Route::get('/api/events', [AgendaController::class, 'getEvents'])->name('api.events');
