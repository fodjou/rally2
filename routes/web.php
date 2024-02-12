<?php

use App\Http\Controllers\CoureurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WialonController;
use App\HTTP\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use  App\Http\Controllers\ResultatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Authentification Users
// Route de traitement du formulaire
Route::post('/',  [UsersController::class, 'show'])->name('register');

// Route Dashboard

Route::get('/dashboard', [DashboardController::class,"index"])->name("dashboard");
Route::get('/dashboard-detail', [DashboardController::class,"show"])->name("dashboard-detail");
Route::get('/maps', [DashboardController::class,"showMap"])->name("Map");

//route du couceurcontroller

Route::get('/coureurs/create',[CoureurController::class , 'create'])->name('coureurs.create');
Route::get('/coureurs/{coureur}', [CoureurController::class, 'show'])->name('coureurs.show');
Route::post('/coureurs/create',[CoureurController::class,'store'])->name('coureurs.store');
Route::get('/coureurs/{coureur}/edit', [CoureurController::class, 'edit'])->name('coureurs.edit');
Route::put('/coureurs/{coureur}/update', [CoureurController::class, 'update'])->name('coureurs.update');
Route::delete('/coureurs/{coureur}', [CoureurController::class, 'destroy'])->name('coureurs.destroy');

// Affiche le top 8
Route::get('/Coureurs/top-final',[ResultatController::class,'showFinalResult'])->name('coureurs.top-final');
// Affiche le laps Resultat
Route::get('/Resultat-laps',[ResultatController::class,'showLapsResult'])->name('lapsResult');





/// Route d'affichage du formulaire

///
///
//Route::get('/', 'UserController@showRegisterForm')->name('register.form');
//
//// Route de traitement du formulaire
//Route::post('/', 'UserController@register')->name('register');
//
//// Route de login existante
//Route::post('/', 'UserController@login');

//// Routes protégées après enregistrement
//Route::group(['middleware' => 'auth'], function(){
//
//    Route::get('/dashboard', function(){
//        return 'Dashboard';
//    });
//
//});
//



// Route de gestion des coureurs

Route::get('/resultat_special', function () {
    return view('resultat_special');
});
Route::get('/resultat_final', function () {
    return view('resultat_final');
});


Route::get('/creer_pilote', function () {
    return view('creer_pilote');
});
Route::get('/pilote_creer', function () {
    return view('pilote_creer');
});

Route::get('liste_finale', function () {
    return view('liste_finale');
});

Route::get('/resultat_special', function () {
    return view('resultat_special');
})->name('resultat_special');


//welcome
Route::get('/', function () {
    return view('Auth.login');
});










Route::get('/wialon/connect', [WialonController::class, 'connect']);
Route::get('/wialon/test-connection', [WialonController::class, 'testConnection']);
