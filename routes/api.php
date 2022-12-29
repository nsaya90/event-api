<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Inscription
Route::post('/register', [UserController::class, 'store'])->name('register.store');
// Connexion
Route::post('/login', [UserController::class, 'login'])->name('login');

// Affichage du profil de l'utilisateur connecté
Route::middleware('auth:sanctum')->get('/profil/{id}', [UserController::class, 'profil'])->name('profil.index');
// Modification du profil
Route::middleware('auth:sanctum')->put('/profil/{id}', [UserController::class, 'update'])->name('profil.update');
//Suppression d'un profil
Route::middleware('auth:sanctum')->delete('/profil', [UserController::class, 'destroy'])->name("profil.destroy");

// Enregistrement d'un événement
Route::middleware('auth:sanctum')->post('/add-event', [EventController::class, 'store'])->name('add-event');

// Ajout d'une photo
Route::post('/upload', [EventController::class, 'upload'])->name('upload.store');

// Récupération de tous les événements
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Récupération info d'un événement
Route::get('/event-detail/{id_event}', [EventController::class, 'detail'])->name('detail');

// Filtrer des événement
// Par date
Route::get('/filter-date/{firstDate}/{secondDate}', [FilterController::class, 'filter_date'])->name('filter_date');


// Par type
Route::get('/filter-type/{type}', [FilterController::class, 'filter_type'])->name('filter_type');

// Par ville
Route::get('/filter-city/{city}', [FilterController::class, 'filter_city'])->name('filter_city');
