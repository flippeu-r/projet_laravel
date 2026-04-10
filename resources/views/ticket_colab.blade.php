<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Tickets - Prisma</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles_tick_colab.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <nav class ="sidebar">
            <div class="logo">
                <h2>Prisma <span style="font-weight: 300; font-size: 0.8em;">Tickets</span></h2>
            </div>
            <ul>
                <li><a href="/dashboard"><i class="fas fa-home"></i> Accueil </a></li>
                <li><a href="/projets"><i class="fas fa-project-diagram"></i> Projets </a> </li>
                <li class="active"><a href="/tickets"><i class="fas fa-ticket-alt"></i> Tickets </a></li>
                <li><a href="/heures"><i class="fas fa-clock"></i> Mes Heures </a></li>
            </ul>

            <div style="padding: 10px 20px;">
                <button onclick="document.getElementById('modale').showModal()" style="width:100%; padding:10px; background:#6c63ff; color:white; border:none; border-radius:8px; cursor:pointer;">
                    <i class="fas fa-plus"></i> Ajout rapide
                </button>
            </div>

            <div class="Deconnexion">
                <a href="/logout"><i class="fas fa-sign-out-alt"></i> Deconnexion </a>
            </div>
        </nav>

        <main class="main-content">
    
            <header>
                <h1>Gestion des Tickets</h1> 
                <div class="user-info">
                    <span>Collaborateur</span>
                    <a href="/profil"><div class="profile-pic"> </div></a> 
                </div>
            </header>

            <div class="tickets-container">
                <h2>Tous les Tickets</h2>

                <div class="filters-header"></div>
                
                <div class="filters-actions">
                    <button id="btn-tous" class="filter-btn active">Tous</button>
                    <button id="btn-atraiter" class="filter-btn">À traiter</button>
                    <a href="/tickets/creer" class="btn-create">+ Nouveau Ticket</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sujet</th>       
                            <th>Client</th>   
                            <th>Collab</th>
                            <th>Temps</th>
                            <th>Priorité</th>    
                            <th>Statut</th>      
                            <th>Type</th>        
                            <th>Action</th>      
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if(isset($tickets))
                            @foreach ($tickets as $ticket)
                            <tr>
                                <td><strong>#{{ $ticket->id }}</strong></td>
                                <td>{{ $ticket->sujet }}</td>
                                
                                <td><span class="client-badge">{{ $ticket->projet->client ?? '-' }}</span></td>
                                <td><span class="collab-name">{{ $ticket->projet->nom ?? '-' }}</span></td>

                                <td class="time-cell">{{ $ticket->temps ?? '0 h' }}</td>
                                <td><span class="priority {{ $ticket->priorite_class ?? '' }}">{{ $ticket->priorite }}</span></td>
                                <td><span class="status {{ $ticket->statut_class ?? '' }}">{{ $ticket->statut }}</span></td>
                                <td><span class="type {{ $ticket->type_class ?? '' }}">{{ $ticket->type }}</span></td>
                                <td><a href="/tickets/{{ $ticket->id }}" class="btn-action"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="9" class="text-center">Chargement des données...</td></tr>
                        @endif

                    </tbody>
                </table>

                <!-- MODALE -->
                <dialog id="modale" style="border-radius:12px; padding:30px; width:400px; border:none;">
                    <h2 style="margin-bottom:20px;">Ajout rapide d'un ticket</h2>

                    <label>Sujet</label><br>
                    <input type="text" id="modal_sujet" style="width:100%; margin-bottom:15px; padding:8px;"><br>

                    <label>Description</label><br>
                    <textarea id="modal_description" style="width:100%; margin-bottom:15px; padding:8px;" rows="3"></textarea><br>

                    <label>Projet</label><br>
                    <select id="modal_projet" style="width:100%; margin-bottom:15px; padding:8px;">
                        <option value="" disabled selected>Choisir un projet...</option>
                        @foreach(\App\Models\Projet::all() as $p)
                            <option value="{{ $p->id }}">{{ $p->nom }}</option>
                        @endforeach
                    </select><br>


                    <label>Priorité</label><br>
                    <select id="modal_priorite" style="width:100%; margin-bottom:15px; padding:8px;">
                        <option value="Basse">Basse</option>
                        <option value="Moyenne" selected>Moyenne</option>
                        <option value="Haute">Haute</option>
                    </select><br>

                    <label>Temps estimé (h)</label><br>
                    <input type="number" id="modal_estimation" placeholder="Ex: 4" min="0" step="0.5" style="width:100%; margin-bottom:15px; padding:8px;"><br>

                    <label>Type</label><br>
                    <select id="modal_type" style="width:100%; margin-bottom:20px; padding:8px;">
                        <option value="inclus">Inclus</option>
                        <option value="facturable">Facturable</option>
                    </select><br>

                    <div style="display:flex; gap:10px; justify-content:flex-end;">
                        <button onclick="document.getElementById('modale').close()" style="padding:8px 16px; cursor:pointer;">Annuler</button>
                        <button onclick="envoyerTicket()" style="padding:8px 16px; background:#6c63ff; color:white; border:none; border-radius:6px; cursor:pointer;">Créer</button>
                    </div>

                </dialog>
            </div>

        </main>
    </div>
    
    <script src="{{ asset('JS/script.js') }}"></script>
</body>
</html>