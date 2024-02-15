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


    public function requestWialonData($fileName, $zones, $compress)
    {
        $client = new Client();
        $url = env('WIALON_URL') . '/wialon/ajax.html'; // URL de l'API Wialon
        $params = [
            'params' => [
                'fileName' => $fileName,
                'zones' => $zones,
                'compress' => $compress
            ],
            'id' => 1, // ID de la demande
            'svc' => 'exchange/export_zones', // Service pour l'exportation des zones
            'login' => env('WIALON_USERNAME'),
            'password' => env('WIALON_PASSWORD')
        ];

        try {
            $response = $client->request('POST', $url, [
                'form_params' => $params,
                'verify' => false // Désactiver la vérification SSL
            ]);
            $data = $response->getBody()->getContents();
            // Traitez les données de réponse ici
            return $data;
        } catch (\Exception $e) {
            // Gérez les erreurs ici
            return $e->getMessage();
        }
    }


}
