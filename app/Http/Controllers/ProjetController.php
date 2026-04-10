<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;

class ProjetController extends Controller
{
    // Affiche la page
    public function create()
    {
        return view('creer_projet'); 
    }

    // Traite le formulaire
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required',
            'client' => 'required',
            'date_fin' => 'required|date',
            'budget' => 'nullable|numeric',
            'statut' => 'required',
            'description' => 'nullable',
 

        ]);

        // On récupère l'id de l'utilisateur client sélectionné
        $userClient = \App\Models\User::where('name', $request->client)->first();
        $data['user_id'] = $userClient ? $userClient->id : null;

        Projet::create($data);

        return redirect('/dashboard');
    }

    public function index() {
        $projets = Projet::all();
        return view('proj_colab', compact('projets'));
    }

}