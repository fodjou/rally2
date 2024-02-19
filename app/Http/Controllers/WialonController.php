<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Response;

class WialonController extends Controller
{
    public function connect()
    {
        $client = new Client();

        try {
            $response = $client->post(env('WIALON_URL') . '/login.xml', [
                'form_params' => [
                    'login' => env('WIALON_USERNAME'),
                    'password' => env('WIALON_PASSWORD')
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                // Connexion réussie
                $session = $response->getBody();
                // Effectuez des opérations supplémentaires avec la session
                return response()->json(['session' => $session]);
            }
        } catch (RequestException $e) {
            // Erreur de connexion
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function testConnection()
    {
        $client = new Client();

        try {
            $response = $client->get(env('WIALON_URL') . '/ajax.html', [
                'verify' => false // Désactiver la vérification SSL
            ]);

            if ($response->getStatusCode() === 200) {
                // Connexion réussie
                return response()->json(['message' => 'Connexion reussie']);
            }
        } catch (RequestException $e) {
            // Erreur de connexion
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }



    public function getEidFromUrl($url)
    {
        $client = new Client();
        $response = $client->get($url);
        $json = json_decode($response->getBody(), true);

        if (isset($json['eid'])) {
            return $json['eid'];
        } else {
            return null;
        }
    }

    public function checkEid()
    {
        $url = 'https://hst-api.wialon.com/wialon/ajax.html?svc=token/login&params={"token":"1f59b5fbd0b702d585a477e3a3d701bcDAAE0189ABDC599F4E1BBA038229A4AB2EE328D8"}';

        $eid = $this->getEidFromUrl($url);

        return "EID: " . $eid;
    }


}





