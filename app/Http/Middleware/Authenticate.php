<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**

    public function handle($request, Closure $next)
    {
        if(auth()->check()) {

            // Vérifier si plus de 5 minutes depuis dernier rafraichissement
            if($request->session()->has('last_eid_update') &&
                now()->diffInMinutes(request()->session()->get('last_eid_update')) > 5) {

                // Récupérer un nouvel EID
                $eid = $this->getEidFromWialon();

                // Mettre à jour la session
                request()->session()->put('eid', $eid);
                request()->session()->put('last_eid_update', now());

            }

        }

        return $next($request);

    }
     */
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : '/';
    }

}
