<?php


namespace App\Http\Controllers;

    use GuzzleHttp\Client;
    use Illuminate\Http\Request;
    use App\Models\Coureur;
    use Illuminate\Support\Facades\Session;

    // Assurez-vous d'importer le modèle Coureur si nécessaire

class MapController extends Controller
{
//    public function index()
//    {
//
//        // Retournez la vue avec le classement initial
//        return view('pages.map', compact('ranking'));
//    }

    public function getDriversLocations($wialonDriverId)
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

        // Analyser la réponse pour récupérer les positions des conducteurs
        $items = $data['items'] ?? [];

        $driversPositions = [];
        if (!empty($items)) {
            foreach ($items as $driverData) {
                $wialonDriverX = $driverData['pos']['x'];
                $wialonDriverY = $driverData['pos']['y'];
                $driversPositions[] = [
                    'x' => $wialonDriverX,
                    'y' => $wialonDriverY
                ];
            }
        }

        return $driversPositions;
    }



    // systeme de ranking des joueurs

    public function ranking ($wialonDriverId){

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

        // Analyser la réponse pour récupérer l'ID du pilote correspondant
        $items = $data['items'] ?? [];

        if (!empty($items)) {
            $driverData = $items[0];
            $wialonDriverX = $driverData['pos']['x'];
            $wialonDriverY = $driverData['pos']['y'];
            $wialonDriverT = $driverData['pos']['t']; // Temps t
            $wialonDriverS = $driverData['pos']['s'];// Vitesse S


            // Retourner un tableau avec x, y, t, S
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


    function getDriversRanking($driversPositions)
    {
        $ranking = [];

        foreach ($driversPositions as $driverPosition) {
            $wialonDriverId = $driverPosition['wialonDriverId'];

            // Récupérer le coureur correspondant
            $coureur = Coureur::where('wialon_driver_id', $wialonDriverId)->first();

            if ($coureur) {
                $startTime = $driverPosition['pos']['t'];
                $speed = $driverPosition['pos']['s'];

                // Calculer le temps écoulé depuis le départ en secondes
                $elapsedTime = time() - $startTime;

                // Calculer le kilométrage total parcouru
                $kmTravelled = $speed * $elapsedTime;
                $totalKm = $coureur->total_km + $kmTravelled;

                // Mettre à jour le temps total de parcours
                $totalTime = $coureur->total_time + $elapsedTime;

                $ranking[$wialonDriverId] = [
                    'name' => $coureur->nom_conducteur,
                    'marque' => $coureur->marque,
                    'matricule' => $coureur->matricule,
                    'totalKm' => $totalKm,
                    'totalTime' => $totalTime
                ];
            }
        }

        // Trier le classement par kilométrage total parcouru
        arsort($ranking);

        return $ranking;
    }}
