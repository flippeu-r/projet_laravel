<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Heure;
use App\Models\Ticket;


class HeureController extends Controller
{
    // Affiche la page avec la liste des tickets et l'historique
    public function index() {
        $liste_tickets = Ticket::all();
        $historique = Heure::where('user_id', Auth::id())->get();
        return view('heures', compact('liste_tickets', 'historique'));
    }

    // Enregistre les heures en BDD
    public function store(Request $request) {
        Heure::create([
            'nb_heures'   => $request->nb_heures,
            'date_saisie' => $request->date_saisie,
            'commentaire' => $request->commentaire,
            'ticket_id'   => $request->id_ticket,
            'user_id'     => Auth::id(),
        ]);

        return redirect('/heures');
    }
}