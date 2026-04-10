<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/style_dash_colab.css') }}">
    
</head>
<body>


    <div class="dashboard-container">

        <nav class ="sidebar">

            <div class="logo">
                <h2>
                    Prisma <span style="font-weight: 300; font-size: 0.8em;">Tickets</span>
                </h2>
            </div>

            <ul>
                <li class="active"><a href="/dashboard"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href="/projets"><i class="fas fa-project-diagram"></i> Projets</a></li>
                <li><a href="/tickets"><i class="fas fa-ticket-alt"></i> Tickets</a></li>
                <li><a href="/heures"><i class="fas fa-clock"></i> Mes Heures</a></li>
                @if(Auth::check() && Auth::user()->role == 'admin')
                    <li><a href="/admin"><i class="fas fa-users-cog"></i> Admin</a></li>
                @endif
            
            </ul>

            <div class="Deconnexion">
                <a href="/logout" id="logout"><i class="fas fa-sign-out-alt"></i> Deconnexion</a>
            </div>

        </nav>

        <main class ="main-content"> 
            
            <header>
                <h1>Tableau de Bord</h1>
                <div class="user-info">
                    <span>Bonjour, {{ Auth::user()->name }}</span>
                    <a href="/profil"><div class="profile-pic"> </div></a>    
                </div>
            </header>

            <div class="stats-container">
                <div class="card">   <h3>Tickets Actifs</h3>     <p>{{ $tickets_actifs ?? 0 }}</p>      <span>En cours / Nouveau</span>    </div>
                <div class="card">   <h3>Total Projets</h3>     <p>{{ $total_projets ?? 0 }}</p>     <span>Projets enregistrés</span>       </div>
                <div class="card">   <h3>Total Tickets</h3>     <p>{{ $total_tickets ?? 0 }}</p>     <span>Depuis le début</span>      </div>
            </div>

            <div class="tickets-container">
                <h2>Derniers Tickets</h2>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sujet</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Priorité</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if(isset($derniers_tickets))
                            @foreach ($derniers_tickets as $ticket)
                                @php 
                                    $statut_class = strtolower(str_replace(' ', '-', $ticket->status)); 
                                    $type_class = ($ticket->type == 'facturable') ? 'facturable' : 'inclus';
                                @endphp
                                <tr>
                                    <td>#{{ $ticket->id }}</td>
                                    <td>{{ $ticket->sujet }}</td>
                                    <td>{{ $ticket->projet->client ?? '-' }}</td>
                                    <td><span class="status">{{ $ticket->statut }}</span></td>
                                    <td>{{ $ticket->priorite }}</td>
                                    <td><span class="{{ $ticket->type }}">{{ $ticket->type }}</span></td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="6" class="text-center">Chargement des données...</td></tr>
                        @endif

                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script src="{{ asset('JS/script.js') }}"></script>
</body>
</html>