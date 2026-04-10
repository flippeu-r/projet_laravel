<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - Prisma</title>
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
            
            <header>
                <h1>Paramètres</h1>
                <div class="user-info">
                    <span>Collaborateur</span>
                    <a href="/profil"><div class="profile-pic">  </div></a> 
                </div>
            </header>

            <div class="settings-container">
                
                <div class="settings-section">
                    <h3>Notifications</h3>
                    
                    <div class="setting-row">
                        <div class="setting-info">
                            <h4>Emails de ticket</h4>
                            <p>Recevoir un email quand un ticket m'est assigné</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-row">
                        <div class="setting-info">
                            <h4>Nouveaux commentaires</h4>
                            <p>Notification quand un client répond</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <div class="settings-section">
                    <h3>Sécurité</h3>
                    
                    <form action="/parametres" method="POST">
                        @csrf

                        @if(session('erreur'))
                            <p style="color:red;">{{ session('erreur') }}</p>
                        @endif

                        @if(session('succes'))
                            <p style="color:green;">{{ session('succes') }}</p>
                        @endif

                        <div class="form-group full-width">
                            <label>Ancien mot de passe</label>
                            <input type="password" name="ancien_password" class="glass-input">
                        </div>
                        <div class="grid-2-cols">
                            <div class="form-group">
                                <label>Nouveau mot de passe</label>
                                <input type="password" name="nouveau_password" class="glass-input">
                            </div>
                            <div class="form-group">
                                <label>Confirmer</label>
                                <input type="password" name="confirmer_password" class="glass-input">
                            </div>
                        </div>
                        <button type="submit" class="btn-danger">
                            Mettre à jour le mot de passe
                        </button>
                    </form>


                </div>

            </div>

        </main>
    </div>
</body>
</html>