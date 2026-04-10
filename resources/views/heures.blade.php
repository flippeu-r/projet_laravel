<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Heures - Prisma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_dash_colab.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <nav class ="sidebar">
            <div class="logo"><h2>Prisma <span style="font-weight: 300; font-size: 0.8em;">Tickets</span></h2></div>
            <ul>
                <li><a href="/dashboard"><i class="fas fa-home"></i> Accueil </a></li>
                <li><a href="/projets"><i class="fas fa-project-diagram"></i> Projets </a> </li>
                <li><a href="/tickets"><i class="fas fa-ticket-alt"></i> Tickets </a></li>
                <li class="active"><a href="/heures"><i class="fas fa-clock"></i> Mes Heures </a></li>
            </ul>
            <div class="Deconnexion"><a href="/logout"><i class="fas fa-sign-out-alt"></i> Deconnexion </a></div>
        </nav>

        <main class ="main-content"> 
            <header>
                <h1>Saisie du Temps</h1>
                <div class="user-info">
                    <span>Collaborateur</span> 
                    <a href="/profil"><div class="profile-pic"> </div></a>    
                </div>
            </header>

            <div class="tickets-container">
                <form action="/heures" method="POST" class="heures-form">
                    @csrf
                    <div class="heures-form-row">
                        <div class="form-group heures-form-group-large">
                            <label>Ticket associé</label>
                            <select name="id_ticket">
                                <option value="" disabled selected>Choisir un ticket...</option>
                                @if(isset($liste_tickets))
                                    @foreach ($liste_tickets as $t)
                                        <option value="{{ $t->id }}">{{ $t->sujet }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group heures-form-group-small">
                            <label>Nombre d'heures</label>
                            <input type="number" name="nb_heures" step="0.5" placeholder="Ex: 2.5" >
                        </div>
                        <div class="form-group heures-form-group-small">
                            <label>Date</label>
                            <input type="date" name="date_saisie" value="{{ date('Y-m-d') }}" >
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label>Commentaire (Optionnel)</label>
                        <textarea name="commentaire" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn-submit-heures">
                        <i class="fas fa-plus"></i> Enregistrer les heures
                    </button>
                </form>
            </div>

            <div class="tickets-container mt-30">
                <h2>Mon Historique</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ticket</th>
                            <th>Durée</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($historique))
                            @foreach ($historique as $h)
                            <tr>
                                <td>{{ $h->date_saisie }}</td>
                                <td>{{ $h->sujet }}</td>
                                <td><strong>{{ $h->nb_heures }} h</strong></td>
                                <td class="opacity-70">{{ $h->commentaire }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="4" class="text-center">Chargement des données...</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>