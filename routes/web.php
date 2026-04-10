<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\HeureController;
use App\Http\Controllers\AdminController;

// --- ROUTES PUBLIQUES (pas besoin d'être connecté) ---
Route::get('/', function () { return view('accueil'); });
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/inscription', function () { return view('inscription'); });
Route::get('/mot-de-passe-oublie', function () { return view('mdp_perdu'); });
Route::post('/inscription', [AuthController::class, 'inscription']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);


// --- ROUTES PROTÉGÉES (connecté obligatoire) ---
Route::middleware('auth')->group(function () {

    // Collaborateur & Admin
    Route::get('/dashboard', function () {
        $derniers_tickets = \App\Models\Ticket::latest()->take(5)->get();
        $total_tickets = \App\Models\Ticket::count();
        $tickets_actifs = \App\Models\Ticket::whereIn('statut', ['Nouveau', 'En cours'])->count();
        $total_projets = \App\Models\Projet::count();
        return view('dash_colab', compact('derniers_tickets', 'total_tickets', 'tickets_actifs', 'total_projets'));
    });

    Route::get('/profil', function () { return view('profile'); });
    Route::get('/parametres', function () { return view('settings'); });

    // Projets
    Route::get('/projets', [ProjetController::class, 'index']);
    Route::get('/projets/creer', function () { return view('creer_projet'); });
    Route::post('/projets/creer', [ProjetController::class, 'store']);
    Route::get('/projets/{id}', function ($id) {
        $projet = \App\Models\Projet::findOrFail($id);
        $tickets = $projet->tickets;
        return view('detail_projet', compact('projet', 'tickets'));
    });

    // Tickets
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::get('/tickets/creer', [TicketController::class, 'create']);
    Route::post('/tickets/creer', [TicketController::class, 'store']);
    Route::get('/tickets/{id}', function ($id) {
        $ticket = \App\Models\Ticket::findOrFail($id);
        $historique_heures = \App\Models\Heure::where('ticket_id', $id)->get();
        $total_heures = $historique_heures->sum('nb_heures');
        return view('ticket_detail', compact('ticket', 'historique_heures', 'total_heures'));
    });

    // Heures
    Route::get('/heures', [HeureController::class, 'index']);
    Route::post('/heures', [HeureController::class, 'store']);

    // Admin
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/admin/users/{id}/role', [AdminController::class, 'changerRole']);

    // Client
    Route::get('/client', function () {
        if (Auth::user()->role != 'client') {
            return redirect('/dashboard');
        }
        $projets = \App\Models\Projet::where('user_id', Auth::id())->get();
        return view('client', compact('projets'));
    });

    Route::post('/client/tickets/{id}/valider', function ($id) {
        $ticket = \App\Models\Ticket::findOrFail($id);
        $ticket->statut = request('decision') == 'valide' ? 'Validé' : 'Refusé';
        $ticket->commentaire_client = request('commentaire');
        $ticket->save();
        return redirect('/client');
    });

});