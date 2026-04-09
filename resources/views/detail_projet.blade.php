<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet : Refonte Site Web</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles_tick_colab.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles_tick_det.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <nav class="sidebar">
            <div class="logo">
                <h2>Prisma <span style="font-weight: 300; font-size: 0.8em;">Tickets</span></h2>
            </div>
            <ul>
                <li><a href="/dashboard"><i class="fas fa-home"></i> Accueil </a></li>
                <li class="active"><a href="/projets"><i class="fas fa-project-diagram"></i> Projets </a></li>
                <li><a href="/tickets"><i class="fas fa-ticket-alt"></i> Tickets </a></li>
                <li><a href="/heures"><i class="fas fa-clock"></i> Mes Heures </a></li>
            </ul>
            <div class="Deconnexion">
                <a href="/login"><i class="fas fa-sign-out-alt"></i> Deconnexion </a>
            </div>
        </nav>

        <main class="main-content">
            
            <div class="ticket-header-wrapper">
                <div class="header-left">
                    <a href="/projets" class="btn-back"><i class="fas fa-arrow-left"></i> Liste des projets</a>
                    <h1 class="ticket-title">{{ $projet->nom }} <span class="client-badge badge-align-middle">{{ $projet->client }}</span></h1>
                </div>
                
                <a href="/projets/modifier/{{ $projet->id }}" class="btn-create btn-create-outline">
                    <i class="fas fa-pen"></i> Modifier le projet
                </a>
            </div>

            <div class="ticket-grid">
                
                <div class="ticket-conversation">
                    <h3 class="section-subtitle">Tickets associés</h3>
                    
                    <table class="associated-tickets-table">
                        <thead>
                            <tr>
                                <th class="th-left">ID</th>
                                <th class="th-left">Sujet</th>
                                <th class="th-center">Statut</th>
                                <th class="th-center">Priorité</th>
                                <th class="th-center">Action</th>
                            </tr>
                        </thead>
                       <tbody>
                        
                        @if($tickets->count() > 0)
                            @foreach ($tickets as $ticket)
                            <tr>
                                <td><strong>#{{ $ticket->id }}</strong></td>
                                <td>{{ $ticket->sujet }}</td>
                                <td><span class="client-badge">{{ $ticket->statut }}</span></td>
                                <td>{{ $ticket->priorite }}</td>
                                <td class="th-center"><a href="/tickets/{{ $ticket->id }}" class="btn-action"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="5" class="th-center">Aucun ticket associé pour le moment.</td></tr>
                        @endif

                    </tbody>
                    </table>
                    
                    <a href="/tickets/creer" class="btn-add-time btn-add-ticket-link">
                        <i class="fas fa-plus"></i> Créer un nouveau ticket
                    </a>
                </div>

                
                <div class="ticket-sidebar">
    
                    <div class="info-card">
                        <h3>Informations</h3>
                        <div class="info-row">
                            <label>Statut</label>
                            <strong>{{ $projet->statut }}</strong>
                        </div>
                        <div class="info-row mt-15">
                            <label>Budget Heures</label>
                            <span>{{ $projet->budget ?? 0 }}h</span>
                        </div>
                        <div class="info-row mt-15">
                            <label>Date de fin</label>
                            <span>{{ $projet->date_fin ?? 'Non définie' }}</span>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3>Contexte</h3>
                        <p class="context-text">
                            {{ $projet->description ?? 'Aucune description.' }}
                        </p>
                    </div>

                </div>

            </div>

        </main>

    </div>
    <script src="{{ asset('JS/script.js') }}"></script>
</body>
</html>