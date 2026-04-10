<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets - Prisma</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles_proj_colab.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <nav class ="sidebar">
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
                <a href="/logout"><i class="fas fa-sign-out-alt"></i> Deconnexion </a>
            </div>
        </nav>

        <main class="main-content">
    
            <header>
                <div class="header-title-row">
                    <h1>Mes Projets</h1>
                    <a href="/projets/creer" class="btn-create">
                         <h3>+ Créer un projet</h3>
                    </a>
                </div>

                <div class="user-info">
                    <span>Collaborateur</span>
                    <a href="/profil"><div class="profile-pic"> </div></a> 
                </div>
            </header>

            <div class="tickets-container">
                <h2>Tous les projets</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Projet</th>
                            <th>Tickets</th> 
                            <th>Heures</th>
                            <th>Progression</th> 
                            <th>Action</th>      
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if(isset($projets))
                            @foreach ($projets as $projet)
                            <tr>
                                <td><span class="client-badge">{{ $projet->client }}</span></td>
                                <td>{{ $projet->nom }}</td>
                                <td>{{ $projet->tickets->count() }}</td>
                                <td>{{ $projet->budget }} h</td>
                                <td>{{ $projet->date_fin }}</td>
                                <td><a href="/projets/{{ $projet->id }}" class="btn-action"><i class="fas fa-eye"></i></a></td>
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