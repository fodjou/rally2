<?php

use App\Http\Controllers\CoureurController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WialonController;
use App\Http\Controllers\DashboardController;
use  App\Http\Controllers\ResultatController;
use  App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;



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
//
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); // Afficher le formulaire de connexion
Route::post('/', [AuthController::class, 'login']); // Gérer la connexion de l'utilisateur
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register'); // Afficher le formulaire d'inscription
Route::post('/register', [AuthController::class, 'register']); // Gérer l'inscription de l'utilisateur
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Déconnecter l'utilisateur



Route::middleware(['auth'])->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, "index"])->name("dashboard");
    Route::get('/dashboard-detail', [DashboardController::class, "show"])->name("dashboard-detail");
    Route::get('/show_reduce', [DashboardController::class, "showReduce"])->name("show_reduce")  ;// visualiser le dashboard sans slidebar
    Route::get('/maps', [DashboardController::class, "showMap"])->name("Map");

    // Routes du CoureurController
    Route::get('/coureurs/create', [CoureurController::class, 'create'])->name('coureurs.create');
    Route::get('/coureurs/{coureur}', [CoureurController::class, 'show'])->name('coureurs.show');
    Route::post('/coureurs/create', [CoureurController::class, 'store'])->name('coureurs.store');
    Route::get('/coureurs/{coureur}/edit', [CoureurController::class, 'edit'])->name('coureurs.edit');
    Route::put('/coureurs/{coureur}/update', [CoureurController::class, 'update'])->name('coureurs.update');
    Route::delete('/coureurs/{coureur}', [CoureurController::class, 'destroy'])->name('coureurs.destroy');
    Route::get('/pilote_creer' ,[CoureurController::class, 'register'])->name('pilote_creer');

    // Affiche le top 8
    Route::get('/Coureurs/top-final', [coursecontroller::class, 'index'])->name('coureurs.top-final');
    // Affiche le laps Resultat
    Route::get('/Resultat-laps', [ResultatController::class, 'showLapsResult'])->name('lapsResult');
    Route::get('/resulat_lap2', [ResultatController::class, "showLaps2Result"])->name('laps2Result');
    // Affiche les specials results
    Route::get('/Resultat-special', [ResultatController::class, 'showSpecialResult'])->name('specialResult');
    Route::get('/resulat_special2', [ResultatController::class, "showSpecia2Result"])->name('special2Result');
// route du Couceur

    // routes/web.php

    Route::get('/maps', [MapController::class, 'index'])->name('maps');
    Route::get('/course', [CourseController::class, "course.index"])->name('course.action');


});



// Route de gestion des coureurs

Route::get('/resultat_special', function () {
    return view('resultat_special');
});
//
//Route::get('/pilote_creer', function () {
//    return view('pilote_creer');
//});

Route::get('liste_finale', function () {
    return view('liste_finale');
});
Route::get('/resultat_special', function () {
    return view('resultat_special');
})->name('resultat_special');


Route::get('dashboard_reduce', function () {
    return view('dashboard_reduce');
});








// route de wialon
Route::get('/wialon/connect', [WialonController::class, 'connect']);
Route::get('/wialon/test-connection', [WialonController::class, 'testConnection']);
Route::get('/wialon/eid', [WialonController::class, 'getEidFromUrl($url)']);

Route::get('/check-eid', [WialonController::class, 'checkEid']);

Route::get('/wialon/eid', [AuthController::class, 'getEidFromUrl($url)']);
