<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProjetController;

use App\Http\Controllers\TicketController;

use App\Http\Controllers\HeureController;

use App\Http\Controllers\AdminController;

use App\Models\Projet;

// Les routes POST (quand on valide un formulaire)
Route::post('/inscription', [AuthController::class, 'inscription']);
Route::post('/login', [AuthController::class, 'login']);


// La route pour se déconnecter
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/projets/creer', [ProjetController::class, 'store']);

// Route::get('/', function () {
//     return view('dash_colab');
// });



//route Post pour créer un ticket
Route::post('/tickets/creer', [TicketController::class, 'store']);


// --- 1. ACCUEIL ET AUTHENTIFICATION ---
Route::get('/', function () {
    return view('accueil');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/inscription', function () {
    return view('inscription');
});

Route::get('/mot-de-passe-oublie', function () {
    return view('mdp_perdu'); 
});


// --- 2. ESPACE COLLABORATEUR (Général) ---
Route::get('/dashboard', function () {
    $derniers_tickets = \App\Models\Ticket::latest()->take(5)->get();
    $total_tickets = \App\Models\Ticket::count();
    $tickets_actifs = \App\Models\Ticket::whereIn('statut', ['Nouveau', 'En cours'])->count();
    $total_projets = \App\Models\Projet::count();
    return view('dash_colab', compact('derniers_tickets', 'total_tickets', 'tickets_actifs', 'total_projets'));
});

Route::get('/profil', function () {
    return view('profile'); 
});

Route::get('/parametres', function () {
    return view('settings'); 
});


// --- 3. GESTION DES PROJETS ---
Route::get('/projets', [ProjetController::class, 'index']);


Route::get('/projets/creer', function () {
    return view('creer_projet'); 
});

Route::get('/projets/{id}', function ($id) {
    $projet = \App\Models\Projet::findOrFail($id);
    $tickets = $projet->tickets;
    return view('detail_projet', compact('projet', 'tickets'));
});

// --- 4. GESTION DES TICKETS ---
Route::get('/tickets', [TicketController::class, 'index']);

Route::get('tickets/creer', [TicketController::class,'create']);

Route::get('/tickets/{id}', function ($id) {
    $ticket = \App\Models\Ticket::findOrFail($id);
    $historique_heures = \App\Models\Heure::where('ticket_id', $id)->get();
    $total_heures = $historique_heures->sum('nb_heures');
    return view('ticket_detail', compact('ticket', 'historique_heures', 'total_heures'));
});


// --- 5. GESTION DES HEURES ---
Route::get('/heures', [HeureController::class, 'index']);
Route::post('/heures', [HeureController::class, 'store']);

// pour les admins
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/users/{id}/role', [AdminController::class, 'changerRole']);


// vue client
Route::get('/client', function () {
    $projets = \App\Models\Projet::where('user_id', Auth::id())->get();
    return view('client', compact('projets'));
});

// vue interface page client

Route::post('/client/tickets/{id}/valider', function ($id) {
    $ticket = \App\Models\Ticket::findOrFail($id);
    if (request('decision') == 'valide') {
        $ticket->statut = 'Validé';
    } else {
        $ticket->statut = 'Refusé';
    }
    $ticket->commentaire_client = request('commentaire');  // ← ici, avant save()
    $ticket->save();
    return redirect('/client');
});


