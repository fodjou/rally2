<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

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

    function getDriversLocations( $wialonDriverId) {
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

            // Analyser la réponse pour récupérer l'ID du pilote correspondant
        $items = $data['items'] ?? [];

        if (!empty($items)) {
            $driverData = $items[0];
            $wialonDriverX = $driverData['pos']['x'];
            $wialonDriverY = $driverData['pos']['y'];

            // Retourner un tableau avec x et y
            return [
                'x' => $wialonDriverX,
                'y' => $wialonDriverY
            ];

        }

        // Pas de position trouvée
        return [];

    }



    // systeme de ranking des joueurs

    public function ranking ($wialonDriverId){

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

        // Analyser la réponse pour récupérer l'ID du pilote correspondant
        $items = $data['items'] ?? [];

        if (!empty($items)) {
            $driverData = $items[0];
           $wialonDriverX = $driverData['pos']['x'];
            $wialonDriverY = $driverData['pos']['y'];
            $wialonDriverT = $driverData['pos']['t']; // Temps t
            $wialonDriverS = $driverData['pos']['s'];// Vitesse S


            // Retourner un tableau avec x, y, t et S
            return [
                'x' => $wialonDriverX,
                'y' => $wialonDriverY,
                't' => $wialonDriverT,
                'S' => $wialonDriverS
            ];
        }

        // Pas de position trouvée
        return [];
    }


    function getDriversRanking($driversPositions) {

        $ranking = [];

        // On ordonne par heure de départ croissante
        usort($driversPositions, function($a, $b) {
            return $a['pos']['t'] - $b['pos']['t'];
        });

        foreach($driversPositions as $driverPosition) {

            $driverId = $driverPosition['driver_id'];
            $x = $driverPosition['pos']['x'];
            $y = $driverPosition['pos']['y'];
            $startTime = $driverPosition['pos']['t'];
            $speed = $driverPosition['pos']['s'];

            // Calcul du temps écoulé depuis le départ
            $elapsedTime = time() - $startTime;

            // Calcul de la distance parcourue
            $distance = $elapsedTime * $speed;

            $ranking[$driverId] = [
                'position' => [
                    'x' => $x,
                    'y' => $y
                ],
                'distance' => $distance
            ];

        }

        // On trie le classement par distance décroissante
        usort($ranking, function($a, $b) {
            return $b['distance'] - $a['distance'];
        });

        return $ranking;

    }

    // Le but est de savoir qui est le plus rapide


    // reupere les distances parcouruent de chacun
        // calculer la distance entre





    // fin de la course recuperer l'heure d'arrivee
    public function getEndTime() {

    }






}
