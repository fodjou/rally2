<?php

namespace App\Http\Controllers;

use App\Models\Coureur;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class CoureurController extends Controller
{
    //
    public function edit()
    {
        return view('creer_pilote');
    }
    public function create (){
        return view ('pages.creer_pilote');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nom_pilote' => 'required',
            'photo_pilote' => 'required|image|max:2048',
            'sponsor' => 'required',
            'marque_vehicule' => 'required',
            'logo-A' => 'nullable|image|max:2048',
            'immatriculation' => 'required',
        ]);

        $imageName = $request->file('photo_pilote')->getClientOriginalName();
        $request->file('photo_pilote')->move(public_path('coureur'), $imageName);

        if ($request->hasFile('logo-A')) {
            $logoName = $request->file('logo-A')->getClientOriginalName();
            $request->file('logo-A')->move(public_path('logo-A'), $logoName);
        } else {
            $logoName = null;
        }

        try {
            // Créer le nouveau pilote dans votre système
            $nouveauPilote = Coureur::create([
                'nom_conducteur' => $request->input('nom_pilote'),
                'image' => $imageName,
                'sponsors' => $request->input('sponsor'),
                'marque' => $request->input('marque_vehicule'),
                'logo-A' => $logoName,
                'matricule' => $request->input('immatriculation'),
            ]);

            // Rechercher le pilote correspondant dans Wialon
            $wialonDriverId = $this->searchDriverInWialon($request->input('nom_pilote'));

            // Associer l'ID du pilote Wialon au pilote créé dans votre système
            if ($wialonDriverId !== null) {
                $nouveauPilote->wialon_driver_id = $wialonDriverId;
                $nouveauPilote->save();

                return redirect()->route('dashboard')->with('message', 'Coureur créé avec succès');
            } else {
                return redirect()->back()->withInput()->withErrors(['error' => 'Impossible de trouver l\'ID du pilote dans Wialon. Veuillez vérifier le nom du pilote et réessayer.']);
            }
        } catch (\Exception $e) {
            dd($e); // Ajout du bloc de débogage pour afficher l'erreur complète
            return redirect()->back()->withInput()->withErrors(['error' => 'Une erreur s\'est produite lors de l\'enregistrement du coureur. Veuillez réessayer.']);
        }
    }

    private function searchDriverInWialon($driverName)
    {
        $eid =  Session::get('eid');
        ; // Récupérer l'EID de l'utilisateur depuis AuthController ou toute autre source appropriée

        // $url = "https://hst-api.wialon.com/wialon/ajax.html?svc=core/search_items";
        // $params = [
        //     "spec" => [
        //         "itemsType" => "avl_unit",
        //         "propName" => "*",
        //         "propValueMask" => $driverName
        //     ],
        //     "force" => 1,
        //     "flags" => 1,
        //     "from" => 0,
        //     "to" => 0,
        //     "sid" => $eid  // Ajout de l'EID dans les paramètres de la requête
        // ];
        

        $client = new Client([
            'verify' => false, // Désactiver la vérification du certificat SSL
        ]);
        // $response = $client->post($url, [
        //     'json' => $params
        // ]);

        $response = $client->request('GET', 'https://hst-api.wialon.com/wialon/ajax.html', [
            'query' => [
                'svc' => 'core/search_items',
                'params' => json_encode([
                    "spec" => [
                        "itemsType" => "avl_unit",
                        "propName" => "sys_name",
                        "propValueMask" => "*".$driverName."*",
                        "sortType" => "sys_name",
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
            $driver = $items[0];
            $wialonDriverId = $driver['id'];
            return $wialonDriverId;
        } else {
            return null;
        }
    }


    public function update(Request $request, $id) {

                // Récupérer le coureur
                $coureur = Coureur::find($id);

                // Validation des données
                $this->validate($request, [
                    'nom_conducteur' => 'required',
                    'image' => 'required',
                    'marque' => 'required',
                    'matricule' => 'required',
                    'sponsors' => 'required',
                    'logo-A' => 'required'
                ]);

                // Mettre à jour les attributs

                $coureur->nom_conducteur = $request->nom_conducteur;
                $imageName = $request->file('photo_pilote')->getClientOriginalName();
                $request->file('photo_pilote')->move(public_path('coureur'), $imageName);
                $coureur->image = $imageName;
                $coureur->marque = $request->marque;
                $coureur->matricule = $request->matricule;
                $coureur->sponsors = $request->sponsors;
                $logoName = $logoName = $request->file('logo-A')->getClientOriginalName();
                $request->file('logo-A')->move(public_path('logo-A'), $logoName);
                $coureur->logo_A = $logoName;

                // Enregistrer les modifications
                $coureur->save();

                // Redirection
                return redirect()->route('creer_pilote');

    }


    public function delete($id) {
        // Récupérer le coureur
    $coureur = Coureur::findOrFail($id);

    // Supprimer le coureur
    $coureur->delete();

                // Message de confirmation
    $message = "Coureur supprimé avec succès";

                // Redirection
    return redirect()->route('creer_pilote')->with('message', $message);

    }
}



