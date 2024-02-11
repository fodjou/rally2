<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;

class UsersController
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

        return redirect('/profil')->with('message', 'Vous êtes désormais inscrit(e). Vous pouvez vous connecter.');

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
