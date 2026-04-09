<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Projet - Prisma</title>
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
            
            <header>
                <h1>Nouveau Projet</h1>
                <div class="user-info">
                    <span>Collaborateur</span>
                    <a href="/profil"><div class="profile-pic">  </div></a> 
                </div>
            </header>

            <div class="projet-form-container">
                
                <form action="/projets/creer" method="POST" class="glass-form" id="projetForm" novalidate>
                    @csrf
                    
                    
                    <div class="form-group full-width">
                        <label for="nom">Nom du projet <span class="required">*</span></label>
                        <input type="text" id="nom" name="nom" placeholder="Ex: Refonte Site E-commerce" required>
                        <div id="nom_error" class="error-text titanic">Il faut choisir un nom de projet</div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="client">Client <span class="required">*</span></label>
                            
                            <input type="text" id="client" name="client" list="clients_existants" placeholder="Tapez ou choisissez..." autocomplete="off" required>
                            <datalist id="clients_existants">
                                @if(isset($liste_clients))
                                    @foreach ($liste_clients as $c)
                                        <option value="{{ $c->client }}">
                                    @endforeach
                                @endif
                            </datalist>

                            <div id="client_error" class="error-text titanic">Il faut choisir un Client</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="date">Date de fin (Deadline)</label>
                            <input type="date" id="date" name="date_fin" required>
                            <div id="date_error" class="error-text titanic">Il faut choisir une date</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="budget">Budget (Heures)</label>
                            <input type="number" id="budget" name="budget" placeholder="Ex: 200">
                            <div id="Budget_error" class="error-text titanic">Il faut choisir un Budget</div>
                        </div>
                        
                        <div class="form-group">
                            <label>Statut</label>
                            <select name="statut">
                                <option value="En cours">En cours</option>
                                <option value="En attente">En attente</option>
                                <option value="Terminé">Terminé</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="description">Description & Objectifs</label>
                        <textarea id="description" name="description" rows="5" placeholder="Décrivez le contexte du projet..." required></textarea>
                        <div id="description_error" class="error-text titanic">Il faut une description</div>
                    </div>

                    <div class="projet-form-actions">
                        <a href="/projets" class="btn-cancel">Annuler</a>
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </div>

                </form>

            </div>

        </main>
        <script src="{{ asset('JS/script.js') }}"></script>
    </div>
    
</body>
</html>