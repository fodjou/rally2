<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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


    // fonction pour traiter la speciale 1

    // Définition du point de passage de la Spéciale 1
    function passesCheckpoint($position, $checkpoint) {

        // Vérifier si la position correspond au checkpoint

        $driverLat = $position['pos']['x'];
        $driverLng = $position['pos']['y'];

        if($driverLat == $checkpoint['lat'] && $driverLng == $checkpoint['lng']) {
            return true;
        }

        return false;

    }


    function updateRankingSp1($driversPositions,$wialonDriverId) {

        $eid =  Session::get('eid');
        // Initialise le client HTTP
        $client = new Client([
            'verify' => false, // Désactiver la vérification du certificat SSL
        ]);


        $response = $client->request('GET', 'https://hst-api.wialon.com/wialon/ajax.html', [
            'query' => [
                'svc' => 'core/search_items',
                'params' => json_encode([
                    "spec" => [
                        "itemsType" => "avl_unit",
                        "propName" => "sys_id",
                        "propValueMask" => "*".$wialonDriverId."*",
                        "sortType" => "sys_id",
                        "propType" => "property"
                    ],
                    "force" => 1,
                    "flags" => 1281,
                    "from" => 0,
                    "to" => 0
                ]),
                'sid' => $eid
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);


        // Définition du point de passage de la spéciale 1
        $checkpointSp1 = [
            'lat' => 6,
            'lng' => 1   ];

        $rankingSp1 = [];

        foreach($driversPositions as $position) {

            $wialonDriverId = $position['wialonDriverId'];

            // Vérification du passage
            if($this->passesCheckpoint($position, $checkpointSp1)) {

                // Ajouter le pilote au classement
                $rankingSp1[$wialonDriverId] = [
                    'startTime' => $position['pos']['t'],
                    'speed' => $position['pos']['s']
                ];

            }

        }

        // Tri par heure de départ
        usort($rankingSp1, function($a, $b){
            return $a['startTime'] - $b['startTime'];
        });

        // Calcul du temps écoulé et vitesse moyenne
        foreach($rankingSp1 as $wialonDriverId => $data) {

            $startTime = $data['startTime'];
            $speed = $data['speed'];

            $elapsedTime = time() - $startTime;
            $averageSpeed = $speed / $elapsedTime;

            $rankingSp1[$wialonDriverId]['averageSpeed'] = $averageSpeed;

        }

        // Trie par vitesse moyenne décroissante
        usort($rankingSp1, function($a, $b) {
            return $b['averageSpeed'] - $a['averageSpeed'];
        });

        return $rankingSp1;

    }




    // fonction pour traiter le lab  1
    // fonction pour traiter le lab  2


    // fonction pour traiter la speciale 2
    function updateRankingSp2($driversPositions,$wialonDriverId) {
        $eid =  Session::get('eid');
        // Initialise le client HTTP
//        $client = new Client();
        $client = new Client([
            'verify' => false, // Désactiver la vérification du certificat SSL
        ]);


        $response = $client->request('GET', 'https://hst-api.wialon.com/wialon/ajax.html', [
            'query' => [
                'svc' => 'core/search_items',
                'params' => json_encode([
                    "spec" => [
                        "itemsType" => "avl_unit",
                        "propName" => "sys_id",
                        "propValueMask" => "*".$wialonDriverId."*",
                        "sortType" => "sys_id",
                        "propType" => "property"
                    ],
                    "force" => 1,
                    "flags" => 1281,
                    "from" => 0,
                    "to" => 0
                ]),
                'sid' => $eid
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);



        // Définition du point de passage de la spéciale 1
        $checkpointSp2 = [
            'lat' => 6,
            'lng' => 1   ];

        $rankingSp2 = [];

        foreach($driversPositions as $position) {

            $wialonDriverId = $position['wialonDriverId'];

            // Vérification du passage
            if($this->passesCheckpoint($position, $checkpointSp2)) {

                // Ajouter le pilote au classement
                $rankingSp1[$wialonDriverId] = [
                    'startTime' => $position['pos']['t'],
                    'speed' => $position['pos']['s']
                ];

            }

        }

        // Tri par heure de départ
        usort($rankingSp2, function($a, $b){
            return $a['startTime'] - $b['startTime'];
        });

        // Calcul du temps écoulé et vitesse moyenne
        foreach($rankingSp2 as $driverId => $data) {

            $startTime = $data['startTime'];
            $speed = $data['speed'];

            $elapsedTime = time() - $startTime;
            $averageSpeed = $speed / $elapsedTime;

            $rankingSp2[$driverId]['averageSpeed'] = $averageSpeed;

        }

        // Trie par vitesse moyenne décroissante
        usort($rankingSp2, function($a, $b) {
            return $b['averageSpeed'] - $a['averageSpeed'];
        });

        return $rankingSp1;

    }


    // fonction pour traiter le lab  1
    // fonction pour traiter le lab  1
}
