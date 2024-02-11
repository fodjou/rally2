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
        return view ('creer_pilote');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom_vehicule' => 'required',
            'nom_conducteur' => 'required',
            'marque' => 'required',
            'matricule' => 'required',
            'image' => 'required|image|max:2048',
            'sponsors' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('coureur'), $imageName);
        if ($request->hasFile('logo')) {
            $logoName = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('logo'), $logoName);
        } else {
            $logoName = null;
        }

        try {
            Coureur::create([
                'nom_vehicule' => $request->input('nom_vehicule'),
                'nom_conducteur' => $request->input('nom_conducteur'),
                'marque' => $request->input('marque'),
                'matricule' => $request->input('matricule'),
                'image' => $imageName,
                'sponsors' => $request->input('sponsors'),
                'logo' => $logoName,
            ]);
        } catch (\Exception $e) {
            dd($e); // Ajout du bloc de débogage pour afficher l'erreur complète
            return redirect()->back()->withInput()->withErrors(['error' => 'Une erreur sest produite lors de lenregistrement du coureur. Veuillez réessayer.']);
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
