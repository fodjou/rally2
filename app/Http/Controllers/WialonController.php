<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Response;

class WialonController
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


    public function getLoginToken()
    {
        $client = new Client();

        $response = $client->get('https://hst-api.wialon.com/wialon/ajax.html', [
            'query' => [
                'svc' => 'token/login',

            ]
        ]);

        $data = json_decode((string) $response->getBody(), true);

        return $data;
    }


}
