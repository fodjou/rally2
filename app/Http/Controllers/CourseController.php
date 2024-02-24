<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('pages.map');
    }

    public function action(Request $request)
    {
        // Mettre à jour la variable de session
        session()->put('selectedAction', $request->input('action'));

        return redirect()->back();
    }


    // debut de la course recuperer l'heure de depart de chaque joueur

//    public function getStartTime() {
//
//
//        $response = $client->get('https://hst-api.wialon.com/wialon/ajax.html', [
//            'query' => [
//                'svc' => 'core/search_items',
//                'params' => '{"spec":{"itemsType":"avl_unit","propName":"sys_phone_number,sys_id","propValueMask":"*","sortType":"sys_name","propType":"property"},"force":1,"flags":1281,"from":0,"to":0}',
//                'sid' => 'YOUR_WIALON_SID',
//            ]
//        ]);
//
//    }


    // recuperer les coordonnees des joueurs en temps reel pour la map




     // systeme de ranking des joueurs
    public function ranking(){

    }
        // calculer la distance entre





    // fin de la course recuperer l'heure d'arrivee
    public function getEndTime() {

    }






}
