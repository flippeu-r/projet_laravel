<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\Projet; 

class TicketController extends Controller
{
    public function store(Request $request) {
    $donneesValidees = $request->validate([
        'title'       => 'required|max:255',
        'description' => 'required',
        'project'     => 'required',
        'type'        => 'required|in:inclus,facturable',
    ]);

    
    Ticket::create([
        'sujet' => $donneesValidees['title'],
        'description' => $donneesValidees['description'],
        'projet_id' => $donneesValidees['project'],
        'type' => $donneesValidees['type'],

        'priorite' => 'Moyenne',
        'user_id' => Auth::id(),
    ]);
    return redirect('/tickets');
    
}
public function create(){
    $liste_projets = Projet::all();
    return view ("create_test", compact("liste_projets"));
}
public function index() {
    $tickets = Ticket::all();
    return view('ticket_colab', compact('tickets'));
}

public function apiStore(Request $request) {
    $ticket = Ticket::create([
        'sujet'       => $request->sujet,
        'description' => $request->description,
        'projet_id'   => $request->projet_id,
        'type'        => $request->type,
        'priorite'    => 'Moyenne',
        'statut'      => 'Nouveau',
        'user_id'     => 1, // temporaire
    ]);

    return response()->json($ticket);
}

}


