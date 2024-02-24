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

         //$client = new Client();
         //$response = $client->get($url);

        

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



        public function showLoginForm()
        {
            return view('Auth.login');
        }
        public function showRegistrationForm()
        {
            return view('Auth.register');
        }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

}
