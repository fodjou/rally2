<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use GuzzleHttp\Client;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="registerUser",
     *      tags={"User"},
     *      summary="Inscription d'un nouvel utilisateur",
     *      description="Permet à un utilisateur de s'inscrire en fournissant un nom et un mot de passe.",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Données de l'utilisateur à inscrire",
     *          @OA\JsonContent(
     *              required={"name", "password"},
     *              @OA\Property(property="name", type="string", example="JohnDoe"),
     *              @OA\Property(property="password", type="string", format="password", example="password123")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Utilisateur inscrit avec succès.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Vous êtes désormais inscrit(e). Vous pouvez vous connecter.")
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

    public function register(Request $request)
    {

        // Validation des données
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8'
        ]);

        // Créer un nouvel utilisateur
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);

        // Enregistrer l'utilisateur
        $user->save();

        return redirect('/dashboard')->with('message', 'Vous êtes désormais inscrit(e). Vous pouvez vous connecter.');

    }


    /**
     * @OA\Post(
     *      path="/",
     *      operationId="loginUser",
     *      tags={"User"},
     *      summary="Connexion de l'utilisateur",
     *      description="Permet à un utilisateur de se connecter en fournissant son nom d'utilisateur et son mot de passe.",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Données de connexion de l'utilisateur",
     *          @OA\JsonContent(
     *              required={"name", "password"},
     *              @OA\Property(property="name", type="string", example="JohnDoe"),
     *              @OA\Property(property="password", type="string", format="password", example="password123")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Utilisateur connecté avec succès.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Connexion réussie.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Échec de l'authentification - Identifiants incorrects.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Identifiants incorrects")
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Échec de récupération de l'EID depuis Wialon.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Échec de récupération de l'EID depuis Wialon")
     *          )
     *      )
     * )
     */

    public function login(Request $request)
    {
        // Validez les données du formulaire
        $credentials = $request->only('name', 'password');

        if (auth()->attempt($credentials)) {
            // L'utilisateur est connecté avec succès
            $eid = $this->getEidFromWialon();


            if ($eid) {
                // Utilisez l'EID pour effectuer l'authentification avec Wialon
                // ...
                Session::put('eid', $eid);
                return redirect()->intended('/dashboard'); // Rediriger vers la page de tableau de bord après connexion réussie
            } else {
                // Échec de la récupération de l'EID depuis Wialon, rediriger avec un message d'erreur
                return redirect()->back()->withErrors(['message' => 'Échec de récupération de l\'EID depuis Wialon']);
            }
        } else {
            // Échec de l'authentification, rediriger avec un message d'erreur
            return redirect()->back()->withErrors(['message' => 'Identifiants incorrects']);
        }
    }

     public function getEidFromWialon()
     {
         $url = 'https://hst-api.wialon.com/wialon/ajax.html?svc=token/login&params={"token":"1f59b5fbd0b702d585a477e3a3d701bcDAAE0189ABDC599F4E1BBA038229A4AB2EE328D8"}';


        $client = new Client([
            'verify' => false, // Désactiver la vérification du certificat SSL
        ]);
        $response = $client->request('GET', 'https://hst-api.wialon.com/wialon/ajax.html', [
            'query' => [
                'svc' => 'token/login',
                'params' => '{"token":"1f59b5fbd0b702d585a477e3a3d701bcDAAE0189ABDC599F4E1BBA038229A4AB2EE328D8"}'
            ]
        ]);

         $json = json_decode($response->getBody()->getContents(), true);

         if (isset($json['eid'])) {
             $eid = $json['eid'];
             return $eid;
         }

         return null;
     }



    /**
     * @OA\Get(
     *      path="/",
     *      operationId="showLoginForm",
     *      tags={"User"},
     *      summary="Afficher le formulaire de connexion",
     *      description="Affiche le formulaire de connexion pour permettre à l'utilisateur de se connecter.",
     *      @OA\Response(
     *          response=200,
     *          description="Affichage réussi du formulaire de connexion."
     *      )
     * )
     */


    public function showLoginForm()
        {
            return view('Auth.login');
        }
    /**
     * @OA\Get(
     *      path="/user/register",
     *      operationId="showRegistrationForm",
     *      tags={"User"},
     *      summary="Afficher le formulaire d'inscription",
     *      description="Affiche le formulaire d'inscription pour permettre à un nouvel utilisateur de s'inscrire.",
     *      @OA\Response(
     *          response=200,
     *          description="Affichage réussi du formulaire d'inscription."
     *      )
     * )
     */


    public function showRegistrationForm()
        {
            return view('Auth.register');
        }

    /**
     * @OA\Post(
     *      path="/logout",
     *      operationId="logoutUser",
     *      tags={"User"},
     *      summary="Déconnexion de l'utilisateur",
     *      description="Permet à un utilisateur de se déconnecter.",
     *      @OA\Response(
     *          response=200,
     *          description="Utilisateur déconnecté avec succès.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Déconnexion réussie.")
     *          )
     *      )
     * )
     */


    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

}
