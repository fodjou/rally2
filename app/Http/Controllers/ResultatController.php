<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultatController extends Controller
{
   public function showFinalResult(){
    return view('pages.final-result');
   }
   public function showLapsResult(){
     return view ('pages.resultat_laps');
   }
    public function showLaps2Result(){
        return view ('pages.resultat_lap2');
    }
    // resultat special

    public function showSpecialResult(){
        return view ('resultat_special');
    }
    public function showSpecia2Result(){
        return view ('resultat_special2');
    }
}
