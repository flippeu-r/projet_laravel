<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Ticket #{{ $ticket->id ?? '...' }} - Prisma</title>

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
                <li><a href="/dashboard"><i class="fas fa-home"></i> Accueil </a></li>
                <li><a href="/projets"><i class="fas fa-project-diagram"> </i> Projets </a> </li>
                <li class="active"><a href="/tickets"><i class="fas fa-ticket-alt"></i> Tickets </a></li>
                <li><a href="/heures"><i class="fas fa-clock"></i> Mes Heures </a></li>
            </ul>

            <div class="Deconnexion">
                <a href="/login" id="logout"><i class="fas fa-sign-out-alt"></i> Deconnexion </a>
            </div>

        </nav>

        <main class ="main-content"> 
            
            <header>
                <h1>
                    Ticket #{{ $ticket->id ?? '...' }}
                </h1>
                <div class="user-info"><span>Collaborateur</span>  <a href="/profil"><div class="profile-pic">  </div></a>     </div>
            </header>


            <div class="detail-header-row">
                <h2 class="text-white m-0">{{ $ticket->sujet ?? 'Chargement...' }}</h2>
                <a href="/tickets" class="btn-back-link"><i class="fas fa-arrow-left"></i> Retour aux tickets</a>
            </div>


            <div class="stats-container">
                
                <div class="card">
                    <h3>Client</h3>
                    <p class="stat-value">{{ $ticket->projet->client ?? '-' }}</p>
                    <span>Facturation : {{ $ticket->type ?? '-' }}</span>
                </div>

                <div class="card">
                    <h3>Statut</h3>
                    <p class="stat-value">{{ $ticket->statut ?? '-' }}</p>
                    <span>Priorité : {{ $ticket->priorite ?? '-' }}</span>
                </div>

              <div class="card">   <h3>Temps Passé</h3>     <p class="stat-value">{{ $total_heures ?? 0 }} h</p>     <span>Cumul total</span>      </div>
            </div>


            <div class="tickets-container">
                <h2>Historique des interventions</h2>

                @if (isset($historique_heures) && count($historique_heures) > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Collaborateur</th>
                                <th>Durée</th>
                                <th>Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($historique_heures as $h)
                            <tr>
                                <td>{{ $h->date_saisie }}</td>
                                <td>{{ explode('@', $h->collab_email)[0] ?? 'Inconnu' }}</td>
                                <td><strong>{{ $h->nb_heures }} h</strong></td>
                                <td class="text-muted-sm">{{ $h->commentaire }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                @else
                    <p class="empty-state-text">Aucune heure n'a encore été saisie sur ce ticket.</p>
                @endif

            </div>

        </main>

    </div>

</body>
</html>