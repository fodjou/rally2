<?php

namespace App\Http\Controllers;

use App\Models\Coureur;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ResultatController extends Controller
{


    public function index()
    {
        // Appel de la fonction pour récupérer les positions des conducteurs
        $driversPositions = $this->getDriversLocations();
        //        dd($driversPositions);

        // Points de départ et d'arrivée de la spéciale 1
        $startCheckpoint = ['x' => 4.025550, 'y' => 9.694593];
        $endCheckpoint = ['x' => 4.028584, 'y' => 9.696562]; // Remplacez les coordonnées par celles du point d'arrivée

       // Calcul du classement en temps réel
        $rankingSp1 = $this->updateRankingSp1($driversPositions, $startCheckpoint, $endCheckpoint);
        //        dd($rankingSp1);
       // Rendre la vue avec les données du classement
        return view('resultat_special', compact('rankingSp1'));
    }


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

    // Définition du point de passage de la Spéciale 1
    function passesCheckpoint($driverData, $checkpoint) {

        // Vérifier si la position correspond au checkpoint

        $wialonDriverX = $driverData['pos']['x'] ?? null;
        $wialonDriverY = $driverData['pos']['y'] ?? null;

        if($wialonDriverX == $checkpoint['x'] && $wialonDriverY == $checkpoint['y']) {
            return true;
        }

        return false;

    }




    function updateRankingSp1($driversPositions, $startCheckpoint, $endCheckpoint) {
        $rankingSp1 = [];

        foreach ($driversPositions as $driverData) {
            $wialonDriverId = $driverData['id'] ?? null;

            // Vérification du passage du point de départ
            if ($this->passesCheckpoint($driverData, $startCheckpoint)) {
                $rankingSp1[$wialonDriverId] = [
                    'startTime' => $driverData['pos']['t'],
                    'startSpeed' => $driverData['pos']['s'],
                    'endTime' => null,
                    'endSpeed' => null,
                    'averageSpeed' => null
                ];
            }

            // Vérification du passage du point de fin
            if ($this->passesCheckpoint($driverData, $endCheckpoint) && isset($rankingSp1[$wialonDriverId])) {
                // Mettre à jour les données pour le pilote
                $rankingSp1[$wialonDriverId]['endTime'] = $driverData['pos']['t'];
                $rankingSp1[$wialonDriverId]['endSpeed'] = $driverData['pos']['s'];

                // Calculer le temps écoulé
                $elapsedTime = $rankingSp1[$wialonDriverId]['endTime'] - $rankingSp1[$wialonDriverId]['startTime'];

                // Calculer la vitesse moyenne
                if ($elapsedTime > 0) {
                    $rankingSp1[$wialonDriverId]['averageSpeed'] = ($rankingSp1[$wialonDriverId]['endSpeed'] - $rankingSp1[$wialonDriverId]['startSpeed']) / $elapsedTime;
                } else {
                    // Si le temps écoulé est nul ou négatif, la vitesse moyenne est nulle
                    $rankingSp1[$wialonDriverId]['averageSpeed'] = 0;
                }

                // Récupérer le coureur correspondant
                $coureur = Coureur::where('wialon_driver_id', $wialonDriverId)->first();

                if ($coureur) {
                    // Ajouter les détails du coureur au classement
                    $rankingSp1[$wialonDriverId]['name'] = $coureur->nom_conducteur;
                    $rankingSp1[$wialonDriverId]['marque'] = $coureur->marque;
                    $rankingSp1[$wialonDriverId]['matricule'] = $coureur->matricule;
                    $rankingSp1[$wialonDriverId]['image'] = $coureur->image;
                    $rankingSp1[$wialonDriverId]['logo'] = $coureur->logo;
                    $rankingSp1[$wialonDriverId]['totalKm'] = $coureur->total_km;
                    $rankingSp1[$wialonDriverId]['totalTime'] = $coureur->total_time;
                }
            }
        }

        // Tri par vitesse moyenne décroissante
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


    // fonction pour traiter le lab1
    // fonction pour traiter le lab1
}
