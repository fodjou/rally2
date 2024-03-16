<?php

namespace App\Http\Controllers;

use App\Models\Coureur;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public function index()
    {
        // Appel de la fonction pour récupérer les positions des conducteurs
        $wialonDriverIds = []; // Initialisez un tableau vide pour stocker les identifiants des conducteurs
        $driversPositions = $this->getDriversLocations();

        // Parcourir les positions des conducteurs pour obtenir les identifiants
        foreach ($driversPositions as $driverPosition) {
            $wialonDriverId = $driverPosition['id'] ?? null;
            if ($wialonDriverId !== null) {
                $wialonDriverIds[] =  $wialonDriverId; // Ajouter l'identifiant au tableau des identifiants
            }
        }

        // Afficher tous les identifiants des conducteurs
//        dd($wialonDriverIds);

        // Calculer le classement des conducteurs à partir des positions
        $ranking = $this->getDriversRanking($driversPositions);
        //        dd($ranking);


        // Rendre la vue avec les données du classement
        return view('pages.final-result', compact('ranking'));
    }


    public function action(Request $request)
    {
        // Mettre à jour la variable de session
        session()->put('selectedAction', $request->input('action'));

        return redirect()->back();
    }

    // recuperer les coordonnees des joueurs en temps reel pour la map

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

    public function getDriversRanking($driversPositions) {
//        dd($driversPositions);
        $ranking = [];

        foreach($driversPositions as $driverPosition) {
            if (isset($driverPosition) && is_array($driverPosition)) {
                $startTime = $driverPosition['t'] ?? 0;
                $speed = $driverPosition['s'] ?? 0;

                // Calculer le temps écoulé depuis le départ en secondes
                $elapsedTime = time() - $startTime;

                // Calculer le kilométrage total parcouru
                $kmTravelled = $speed * $elapsedTime;

                //  l'ID du conducteur
                $wialonDriverId = $driverPosition['id'] ?? null;

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
                        'marque'=> $coureur->marque,
                        'matricule'=> $coureur->matricule,
                        'image'=> $coureur->image,
                        'logo'=> $coureur->logo,
                        'totalKm' => $totalKm,
                        'totalTime' => $totalTime,
                        'averageSpeed' => $averageSpeed

                    ];
                }
            }
        }

        // Tri par vitesse moyenne décroissante
        usort($ranking, function($a, $b) {
            return $b['averageSpeed'] - $a['averageSpeed'];
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







