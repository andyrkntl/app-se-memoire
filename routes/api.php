<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/use App\Models\Evenement;
Route::get('/events', [AgendaController::class, 'getEvents'])->name('api.events');
Route::get('/events', function () {
    $events = Evenement::all();
    return response()->json($events);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
