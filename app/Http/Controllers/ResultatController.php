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
}
