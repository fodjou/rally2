<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Closure;
use Auth;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if(auth()->check()) {

            // Vérifier si plus de 5 minutes depuis dernier rafraichissement
            if($request->session()->has('last_eid_update') &&
                now()->diffInMinutes($request->session()->get('last_eid_update')) > 5) {

                // Récupérer un nouvel EID
                $eid = $this->getEidFromWialon();

                // Mettre à jour la session
                $request->session()->put('eid', $eid);
                $request->session()->put('last_eid_update', now());

            }

        }

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        return $request->expectsJson() ? null : '/';
    }

    private function getEidFromWialon()
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
}
