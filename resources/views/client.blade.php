<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Client - Prisma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles_proj_colab.css') }}">
</head>
<body>
    <div class="dashboard-container">

        <nav class="sidebar">
            <div class="logo">
                <h2>Prisma <span style="font-weight:300; font-size:0.8em;">Tickets</span></h2>
            </div>
            <ul>
                <li class="active"><a href="/client"><i class="fas fa-home"></i> Mes Projets</a></li>
            </ul>
            <div class="Deconnexion">
                <a href="/logout"><i class="fas fa-sign-out-alt"></i> Deconnexion</a>
            </div>
        </nav>

        <main class="main-content">
            <header>
                <h1>Mon Espace Client</h1>
                <div class="user-info">
                    <span>{{ Auth::user()->name }}</span>
                    <div class="profile-pic"></div>
                </div>
            </header>

            <div class="tickets-container">
                <h2>Mes Projets</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Projet</th>
                            <th>Statut</th>
                            <th>Date de fin</th>
                            <th>Tickets</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($projets->count() > 0)
                            @foreach($projets as $projet)
                            <tr>
                                <td>{{ $projet->nom }}</td>
                                <td><span class="client-badge">{{ $projet->statut }}</span></td>
                                <td>{{ $projet->date_fin ?? 'Non définie' }}</td>
                                <td>
                                    @foreach($projet->tickets as $ticket)
                                        <div style="margin-bottom:5px;">
                                            <span class="status">{{ $ticket->sujet }}</span>
                                            — {{ $ticket->statut }}
                                            @if($ticket->type == 'facturable')
                                                <span style="color:orange; font-weight:bold;">(Facturable)</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="4" class="text-center">Aucun projet associé.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>