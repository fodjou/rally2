<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ResultatLabController extends Controller
{

//    public function index()
//    {
//        // Appel de la fonction pour récupérer les positions des conducteurs
//        $driversPositions = $this->getDriversLocations();
////        dd($driversPositions);
//
//// Points de départ et d'arrivée de la spéciale 1
//        $startCheckpoint = ['x' => 6, 'y' => 1];
//        $endCheckpoint = ['x' => 10, 'y' => 5]; // Remplacez les coordonnées par celles du point d'arrivée
//
//// Calcul du classement en temps réel
//        $rankingSp1 = $this->updateRankingSp1($driversPositions, $startCheckpoint, $endCheckpoint);
////        dd($rankingSp1);
//// Rendre la vue avec les données du classement
//        return view('pages.resultat_laps', compact('rankingSp1'));
//    }





    public function getDriversLocations()
    {
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
                        "propValueMask" => "*",
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

        // Analyser la réponse pour récupérer les positions des conducteurs
        $items = $data['items'] ?? [];

        $driversPositions = [];
        if (!empty($items)) {
            foreach ($items as $driverData) {
                // Vérifier si la clé 'pos' existe et n'est pas nulle
                if (isset($driverData['pos']) && is_array($driverData['pos'])) {
                    $wialonDriverX = $driverData['pos']['x'] ?? null;
                    $wialonDriverY = $driverData['pos']['y'] ?? null;
                    $wialonDriverT = $driverData['pos']['t'] ?? null;; // Temps t
                    $wialonDriverS = $driverData['pos']['s'] ?? null;;// Vitesse S
                    $wialonDriverId = $driverData['id'] ?? null;
                    if ($wialonDriverX !== null && $wialonDriverY !== null) {
                        // Envoyer les coordonnées x et y vers le journal des erreurs
                        //error_log("Coordonnée x : $wialonDriverX, Coordonnée y : $wialonDriverY, Temps : $wialonDriverT, Vitesse : $wialonDriverS , wialonDriverId : $wialonDriverId");

                        // Ajouter les coordonnées au tableau $driversPositions
                        $driversPositions[] = [
                            'x' => $wialonDriverX,
                            'y' => $wialonDriverY,
                            't' => $wialonDriverT,
                            'S' => $wialonDriverS,
                            'id'=> $wialonDriverId
                        ];
                    }
                }
            }
        }

        return $driversPositions;
    }

}
