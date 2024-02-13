<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController
{
    public function register(Request $request)
    {

        // Validation des données
        $request->validate([
            'username' => 'required',
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        // Créer un nouvel utilisateur
        $user = new User();
        $user->name = $request->username;
        $user->name = $request->username;
        $user->password = Hash::make($request->password);

        // Enregistrer l'utilisateur
        $user->save();

        return redirect('/dashboard')->with('message', 'Vous êtes désormais inscrit(e). Vous pouvez vous connecter.');
        return redirect('/dashboard')->with('message', 'Vous êtes désormais inscrit(e). Vous pouvez vous connecter.');

    }
        public function login(Request $request)
        {
            // Validez les données du formulaire
            $credentials = $request->only('name', 'password');

            if (auth()->attempt($credentials)) {
                // L'utilisateur est connecté avec succès
                return redirect()->intended('/dashboard'); // Rediriger vers la page de tableau de bord après connexion réussie
            } else {
                // Échec de l'authentification, rediriger avec un message d'erreur
                return redirect()->back()->withErrors(['message' => 'Identifiants incorrects']);
            }
        }

//    public function getAllUsers()
//    {
//
//        $user = User::all();
//
//        return response()->json($user);
//    }

//    public function update(Request $request, $id)
//    {
//
//        $user = User::find($id);
//
//        $this->validate($request, [
//            'name' => 'required'
//        ]);
//
//        $user->name = $request->name;
//
//        if ($request->password) {
//            $user->password = bcrypt($request->password);
//        }
//
//        $user->save();
//
//        return response()->json($user);
//
//    }
//
//    public function delete($id)
//    {
//
//        // Trouver et supprimer l'utilisateur
//        User::findOrFail($id)->delete();
//
//        // Retourner une réponse
//        return redirect('/')->with('message', 'utilisateur suprime');
//
//    }


}
