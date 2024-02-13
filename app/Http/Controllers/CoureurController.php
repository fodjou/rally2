<?php

namespace App\Http\Controllers;

use App\Models\Coureur;
use Illuminate\Http\Request;
use Exception;

class CoureurController extends Controller
{
    //
    public function edit()
    {
        return view('creer_pilote');
    }
    public function create (){
        return view ('pages.creer_pilote');
    }

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
            Coureur::create([
                'nom_conducteur' => $request->input('nom_pilote'),
                'nom_vehicule'=> 'Ferrari',
                'image' => $imageName,
                'sponsors' => $request->input('sponsor'),
                'marque' => $request->input('marque_vehicule'),
                'logo' => $logoName,
                'matricule' => $request->input('immatriculation'),
            ]);
        } catch (\Exception $e) {
            dd($e); // Ajout du bloc de débogage pour afficher l'erreur complète
            return redirect()->back()->withInput()->withErrors(['error' => 'Une erreur s\'est produite lors de l\'enregistrement du coureur. Veuillez réessayer.']);
        }

        return redirect()->route('dashboard')->with('message', 'Coureur créé avec succès');
    }

    public function show($coureur) {

        // Récupérer tous les coureurs
        $coureur = Coureur::find($coureur);

        // Transmettre les coureurs à la vue en tant que variable $coureurs
        return view('resultat_final', compact('coureur'));

    }


    public function update(Request $request, $id) {

        // Récupérer le coureur
        $coureur = Coureur::find($id);

        // Validation des données
        $this->validate($request, [
            'nom_vehicule' => 'required',
            'nom_conducteur' => 'required',
            'marque' => 'required',
            'matricule' => 'required',
            'sponsors' => 'required',
            'logo' => 'required'
        ]);

        // Mettre à jour les attributs
        $coureur->nom_vehicule = $request->nom_vehicule;
        $coureur->nom_conducteur = $request->nom_conducteur;
        $coureur->marque = $request->marque;
        $coureur->matricule = $request->matricule;
        $coureur->sponsors = $request->sponsors;
        $coureur->logo = $request->logo;

        // Enregistrer les modifications
        $coureur->save();

        // Redirection
        return redirect()->route('creer_pilote');

    }

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


}
