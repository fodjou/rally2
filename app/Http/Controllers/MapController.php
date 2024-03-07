<?php


namespace App\Http\Controllers;

    use GuzzleHttp\Client;
    use Illuminate\Http\Request;
    use App\Models\Coureur;
    use Illuminate\Support\Facades\Session;

    // Assurez-vous d'importer le modèle Coureur si nécessaire

class MapController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer l'ID du véhicule à partir de la requête HTTP
        $wialonDriverId = $request->input('wialonDriverId');

        // Appel de la fonction pour récupérer les positions des conducteurs
        $driversPositions = $this->getDriversLocations($wialonDriverId);
//        dd($driversPositions);
        // Calculer le classement des conducteurs à partir des positions
        $ranking = $this->getDriversRanking($driversPositions);

        // Afficher la structure des données de classement des conducteurs
//        dd($ranking);

        // Rendre la vue avec les données du classement
        return view('pages.map', compact('ranking'));
    }

    public function action(Request $request)
    {
        // Mettre à jour la variable de session
        session()->put('selectedAction', $request->input('action'));

        return redirect()->back();
    }

    // recuperer les coordonnees des joueurs en temps reel pour la map

    public function getDriversLocations($wialonDriverId)
    {
        $eid = Session::get('eid');
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
                        "propValueMask" => "*" . $wialonDriverId . "*",
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
                    if ($wialonDriverX !== null && $wialonDriverY !== null) {
                        // Envoyer les coordonnées x et y vers le journal des erreurs
//                        error_log("Coordonnée x : $wialonDriverX, Coordonnée y : $wialonDriverY, Temps : $wialonDriverT, Vitesse : $wialonDriverS");

                        // Ajouter les coordonnées au tableau $driversPositions
                        $driversPositions[] = [
                            'x' => $wialonDriverX,
                            'y' => $wialonDriverY,
                            't' => $wialonDriverT,
                            'S' => $wialonDriverS
                        ];
                    }
                }
            }
        }

        return $driversPositions;
    }





    // systeme de ranking des joueurs

//    public function ranking ($wialonDriverId){
//
//        $eid =  Session::get('eid');
//        // Initialise le client HTTP
//        $client = new Client([
//            'verify' => false, // Désactiver la vérification du certificat SSL
//        ]);
//
//
//        $response = $client->request('GET', 'https://hst-api.wialon.com/wialon/ajax.html', [
//            'query' => [
//                'svc' => 'core/search_items',
//                'params' => json_encode([
//                    "spec" => [
//                        "itemsType" => "avl_unit",
//                        "propName" => "sys_id",
//                        "propValueMask" => "*".$wialonDriverId."*",
//                        "sortType" => "sys_id",
//                        "propType" => "property"
//                    ],
//                    "force" => 1,
//                    "flags" => 1281,
//                    "from" => 0,
//                    "to" => 0
//                ]),
//                'sid' => $eid
//            ]
//        ]);
//
//        $data = json_decode($response->getBody()->getContents(), true);
//
//        // Analyser la réponse pour récupérer l'ID du pilote correspondant
//        $items = $data['items'] ?? [];
//
//        if (!empty($items)) {
//            $driverData = $items[0];
//            $wialonDriverX = $driverData['pos']['x'];
//            $wialonDriverY = $driverData['pos']['y'];
//            $wialonDriverT = $driverData['pos']['t']; // Temps t
//            $wialonDriverS = $driverData['pos']['s'];// Vitesse S
//
//
//            // Retourner un tableau avec x, y, t, S
//            return [
//                'x' => $wialonDriverX,
//                'y' => $wialonDriverY,
//                't' => $wialonDriverT,
//                'S' => $wialonDriverS
//            ];
//        }
//
//        // Pas de position trouvée
//        return [];
//    }


        public function getDriversRanking($driversPositions)
        {
            $ranking = [];

            foreach ($driversPositions as $driverPosition) {
                $startTime = $driverPosition['t'] ?? 0;
                $speed = $driverPosition['S'] ?? 0;

                // Calculer le temps écoulé depuis le départ en secondes
                $elapsedTime = time() - $startTime;

                // Calculer le kilométrage total parcouru
                $kmTravelled = $speed * $elapsedTime;

                // Calculer l'ID du conducteur
                $wialonDriverId = $driverPosition['wialonDriverId'];

                // Récupérer le coureur correspondant
                $coureur = Coureur::where('wialon_driver_id', $wialonDriverId)->first();

                if ($coureur) {
                    // Mettre à jour le total des kilomètres parcourus et le temps total
                    $totalKm = $coureur->total_km + $kmTravelled;
                    $totalTime = $coureur->total_time + $elapsedTime;

                    // Calculer la vitesse moyenne
                    $averageSpeed = ($totalKm > 0 && $totalTime > 0) ? $totalKm / $totalTime : 0;

                    // Ajouter les détails du coureur au classement
                    $ranking[] = [
                        'name' => $coureur->nom_conducteur,
                        'marque' => $coureur->marque,
                        'matricule' => $coureur->matricule,
                        'totalKm' => $totalKm,
                        'totalTime' => $totalTime,
                        'averageSpeed' => $averageSpeed
                    ];
                }
            }

            // Tri par vitesse moyenne décroissante
            usort($ranking, function ($a, $b) {
                return $b['averageSpeed'] - $a['averageSpeed'];
            });

            return $ranking;
        }

    }

