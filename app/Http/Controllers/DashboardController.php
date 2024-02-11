<?php

namespace App\Http\Controllers;

use App\Models\Coureur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $coureurs = Coureur::paginate(8);
        return view("profil",compact("coureurs"));
    }
    /*
     * @show methode de details du dashboard
     */
    public function show(){
        $coureurs = Coureur::all();
        // Transmettre les coureurs à la vue en tant que variable $coureurs
        return view('dashboard', compact('coureurs'));
    }
}
