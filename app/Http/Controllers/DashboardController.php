<?php

namespace App\Http\Controllers;

use App\Models\Coureur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
//        $coureurs = Coureur::all();
        $coureurs = Coureur::paginate(5);
        return view("dashboard",compact("coureurs"));
    }
    /*
     * @show methode de details du dashboard
     */
    public function show(){
        $coureurs = Coureur::all();
        // Transmettre les coureurs à la vue en tant que variable $coureurs
        return view('dashboard-detail', compact('coureurs'));
    }

    public function showMap(){
        return view('pages.map');
    }

    public function showReduce(){
        $coureurs = Coureur::paginate(5);
        return view('dashboard_reduce', compact('coureurs'));

    }


}

