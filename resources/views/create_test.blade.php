<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Ticket - Prisma Tickets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">

</head>
<body>

    <div class="dashboard-container">

        <nav class="sidebar">
            <div class="logo">
                <h2>Prisma <span style="font-weight: 300; font-size: 0.8em;">Tickets</span></h2>
            </div>
            <ul>
                <li><a href="/dashboard"><i class="fas fa-home"></i> Accueil </a></li>
                <li><a href="/projets"><i class="fas fa-project-diagram"></i> Projets </a></li>
                <li class="active"><a href="/tickets"><i class="fas fa-ticket-alt"></i> Tickets </a></li>
                <li><a href="/heures"><i class="fas fa-clock"></i> Mes Heures </a></li>
            </ul>
            <div class="Deconnexion">
                <a href="/logout"><i class="fas fa-sign-out-alt"></i> Deconnexion </a>
            </div>
        </nav>

        <main class="main-content">
            
            <header>
                <h1>Créer un ticket</h1>
                <div class="user-info">
                    <span>Collaborateur</span>
                    <a href="/profil"><div class="profile-pic">  </div></a> 
                </div>
                
            </header>

            <div class="form-container">
                
                <form id="ticket_form" method="POST" action="/tickets/creer">
                    
                    @csrf
                    
                    <div class="form-group full-width">
                        <label for="title">Sujet du ticket <span class="required">*</span></label>
                        <input type="text" id="title" name="title" placeholder="Ex: Bug affichage menu..." required>
                        <div id="title_error" class="error-text titanic">Le sujet est obligatoire.</div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="project">Projet associé <span class="required">*</span></label>
                           
                            <select id="project" name="project" required>
                                <option value="" disabled selected>Choisir un projet...</option>
                                
                                @if(isset($liste_projets))
                                    @foreach ($liste_projets as $projet)
                                        <option value="{{ $projet->id }}">
                                            {{ $projet->client }} - {{ $projet->nom }}
                                        </option>
                                    @endforeach
                                @endif
                                
                            </select>
                            
                            <div id="project_error" class="error-text titanic">il faut choisir un projet</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Type <span class="required">*</span></label>
                            <select id="type" name="type" required>
                                <option value="inclus">Inclus au contrat</option>
                                <option value="facturable">Facturable (Hors contrat)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="priority">Priorité</label>
                            <select id="priority" name="priority">
                                <option value="low">Basse</option>
                                <option value="medium" selected>Moyenne</option>
                                <option value="high">Haute</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estimation">Temps estimé (h)</label>
                            <input type="number" id="estimation" placeholder="Ex: 4" min="0" step="0.5">
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="description">Description détaillée <span class="required">*</span></label>
                        <textarea id="description" name="description" rows="6" placeholder="..." required></textarea>
                        <div id="description_error" class="error-text titanic">Une description est nécessaire pour aider l'équipe technique.</div>
                    </div>

                    <div class="form-actions">
                        <a href="/tickets" class="btn-cancel">Annuler</a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-check"></i> Créer le ticket
                        </button>
                    </div>

                </form>

            </div>

        </main>
    <script src="{{ asset('JS/script.js') }}"></script>
    </div>

</body>
</html>