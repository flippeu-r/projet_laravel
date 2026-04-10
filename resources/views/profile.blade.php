<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Prisma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles_tick_colab.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="logo"><h2>Prisma <span style="font-weight: 300; font-size: 0.8em;">Tickets</span></h2></div>
            <ul>
                <li><a href="/dashboard"><i class="fas fa-home"></i> Accueil </a></li>
                <li><a href="/projets"><i class="fas fa-project-diagram"></i> Projets </a></li>
                <li><a href="/tickets"><i class="fas fa-ticket-alt"></i> Tickets </a></li>
                <li><a href="/heures"><i class="fas fa-clock"></i> Mes Heures </a></li>
            </ul>
            <div class="Deconnexion"><a href="/logout"><i class="fas fa-sign-out-alt"></i> Deconnexion </a></div>
        </nav>

        <main class="main-content">
            <div class="ticket-header-wrapper">
                <h1 class="ticket-title">Mon Profil</h1>
                <a href="/parametres" class="btn-create btn-settings">
                    <i class="fas fa-cog"></i> Paramètres
                </a>
            </div>

            <div class="profile-container">
                <div class="profile-header-card">

                    <h2>{{ Auth::user()->name }}</h2>
                    <p class="opacity-70">{{ Auth::user()->email }}</p>

                    
                    <span class="role-badge-large">Développeur Fullstack</span>

                    <div class="profile-stats">
                        <div class="stat-box">
                            <h4>{{ $mes_tickets ?? 0 }} Tickets</h4>
                            <span>Gérés</span>
                        </div>
                        <div class="stat-box">
                            <h4>{{ $mes_heures ?? 0 }}h</h4>
                            <span>Ce mois</span>
                        </div>
                    </div>
                </div>

                <div class="glass-form">
                    <h3>Informations personnelles</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" value="{{ $telephone ?? 'Non renseigné' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Département</label>
                            <input type="text" value="Technique / RSE" readonly>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label>Bio / Compétences</label>
                        <textarea readonly>Expert Dev ops, Dev fullstack, major en Osint.</textarea>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>