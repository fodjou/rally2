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

    /**
     * @OA\Get(
     *      path="/coureurs/{coureur}/edit",
     *      operationId="editUser",
     *      tags={"Coureur"},
     *      summary="Afficher le formulaire de modification de l'utilisateur",
     *      description="Affiche le formulaire de modification pour permettre à l'utilisateur de modifier ses informations.",
     *      @OA\Response(
     *          response=200,
     *          description="Affichage réussi du formulaire de modification de l'utilisateur."
     *      )
     * )
     */

    public function edit()
    {
        return view('creer_pilote');
    }

    /**
     * @OA\Get(
     *      path="/coureurs/create",
     *      operationId="createUser",
     *      tags={"Coureur"},
     *      summary="Afficher le formulaire de création d'utilisateur",
     *      description="Affiche le formulaire de création pour permettre à l'utilisateur de créer un nouvel utilisateur.",
     *      @OA\Response(
     *          response=200,
     *          description="Affichage réussi du formulaire de création d'utilisateur."
     *      )
     * )
     */

    public function create (){
        return view ('pages.creer_pilote');
    }


    /**
     * @OA\Post(
     *      path="/coureurs/create",
     *      operationId="storeUser",
     *      tags={"Coureur"},
     *      summary="Enregistrer un nouveau pilote",
     *      description="Enregistre un nouveau pilote avec ses informations, y compris le nom, la photo, les sponsors, la marque de véhicule, le logo, et l'immatriculation. Associe également le pilote à un ID dans le système Wialon.",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Données du nouveau pilote à enregistrer",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(property="nom_pilote", type="string", example="John Doe"),
     *                  @OA\Property(property="photo_pilote", type="file", format="binary"),
     *                  @OA\Property(property="sponsor", type="string", example="Sponsor A, Sponsor B"),
     *                  @OA\Property(property="marque_vehicule", type="string", example="Marque X"),
     *                  @OA\Property(property="logo-A", type="file", format="binary", nullable=true),
     *                  @OA\Property(property="immatriculation", type="string", example="ABC123"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Le pilote a été créé avec succès.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Coureur créé avec succès")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation échouée - Vérifiez les erreurs de validation pour les détails.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Les données fournies sont invalides.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Erreur lors de l'enregistrement du pilote ou de la recherche de l'ID dans Wialon.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Une erreur s'est produite lors de l'enregistrement du coureur. Veuillez réessayer.")
     *          )
     *      )
     * )
     */



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


    /**
     * @OA\Put(
     *      path="/coureurs/{coureur}/update",
     *      operationId="updateUser",
     *      tags={"Coureur"},
     *      summary="Mettre à jour un pilote existant",
     *      description="Met à jour les informations d'un pilote existant, identifié par son ID.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID du pilote à mettre à jour",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Données du pilote à mettre à jour",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(property="nom_conducteur", type="string", example="John Doe"),
     *                  @OA\Property(property="photo_pilote", type="file", format="binary"),
     *                  @OA\Property(property="marque", type="string", example="Marque X"),
     *                  @OA\Property(property="matricule", type="string", example="ABC123"),
     *                  @OA\Property(property="sponsors", type="string", example="Sponsor A, Sponsor B"),
     *                  @OA\Property(property="logo-A", type="file", format="binary"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Le pilote a été mis à jour avec succès.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Mise à jour du pilote réussie")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Pilote non trouvé - L'ID du pilote spécifié n'existe pas dans la base de données.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Pilote non trouvé")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation échouée - Vérifiez les erreurs de validation pour les détails.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Les données fournies sont invalides.")
     *          )
     *      )
     * )
     */



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


    /**
     * @OA\Delete(
     *      path="/coureurs/{coureur}",
     *      operationId="deleteUser",
     *      tags={"Coureur"},
     *      summary="Supprimer un pilote",
     *      description="Supprime un pilote existant, identifié par son ID.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID du pilote à supprimer",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Le pilote a été supprimé avec succès.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Coureur supprimé avec succès")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Pilote non trouvé - L'ID du pilote spécifié n'existe pas dans la base de données.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Pilote non trouvé")
     *          )
     *      )
     * )
     */



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


    // enregistrer les conducteurs de wialon



    /**
     * @OA\Post(
     *      path="/pilote_creer",
     *      operationId="registerUserWialon",
     *      tags={"Coureur"},
     *      summary="Enregistrement des pilotes de wialon ",
     *      description="Permet d'enregister les conducteurs depuis Wialon.",
     *      @OA\Response(
     *          response=200,
     *          description="Les conducteurs ont été récupérés avec succès depuis Wialon et enregistrés dans la base de données.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Conducteurs enregistrés avec succès.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Aucun conducteur trouvé pour l'ID Wialon.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Aucun conducteur trouvé pour l'ID Wialon.")
     *          )
     *      )
     * )
     */


    public function register()
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
        // Vérifiez si des données ont été renvoyées avec succès
        if(isset($data['items']) && is_array($data['items'])) {
            foreach($data['items'] as $item) {
                // Extraction du matricule, du nom du conducteur et du sponsor
                $nomConducteurData = explode(' - ', $item['nm'] ?? '');
                $matricule = '';
                $nomConducteur = '';
                $sponsor = '';

                if (count($nomConducteurData) >= 2) {
                    if (is_numeric($nomConducteurData[0])) {
                        $matricule = trim($nomConducteurData[0]); // Le matricule est le premier élément
                        unset($nomConducteurData[0]); // Retirez le matricule du tableau
                        $nomConducteur = array_shift($nomConducteurData); // Le nom est le premier élément
                    } else {
                        $nomConducteur = array_shift($nomConducteurData); // Le nom est le premier élément
                    }

                    // Les éléments restants sont combinés pour former le sponsor
                    $sponsors = implode(' - ', $nomConducteurData);
                }

                // Vérifiez si le nom du conducteur est présent
                if($nomConducteur) {
                    // Enregistrez le conducteur dans la table Coureurs
                    $this->enregistrerConducteur($nomConducteur, $matricule, $sponsors, $item['id']);
                }
            }
            // Redirigez l'utilisateur vers la page pilote_creer après avoir enregistré tous les conducteurs
            return redirect()->route('pilote_creer');
        } else {
            return "Aucun conducteur trouvé pour l'ID Wialon.";
        }
    }

    private function enregistrerConducteur($nomConducteur, $matricule, $sponsors, $wialonDriverId)
    {
        // Vérifiez si le conducteur existe déjà dans la base de données
        $conducteurExistant = Coureur::where('nom_conducteur', $nomConducteur)->first();

        // Si le conducteur n'existe pas, enregistrez-le dans la base de données
        if (!$conducteurExistant) {
            $coureur = new Coureur();
            $coureur->nom_conducteur = $nomConducteur;
            $coureur->matricule = $matricule;
            $coureur->sponsors = $sponsors;
            $coureur->wialon_driver_id = $wialonDriverId;

            // Autres champs que vous souhaitez enregistrer
            $coureur->save();
        }
    }


}



