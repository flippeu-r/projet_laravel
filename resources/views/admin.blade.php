<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Prisma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles_tick_colab.css') }}">
</head>
<body>
    <div class="dashboard-container">

        <nav class="sidebar">
            <div class="logo">
                <h2>Prisma <span style="font-weight:300; font-size:0.8em;">Tickets</span></h2>
            </div>
            <ul>
                <li><a href="/dashboard"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href="/projets"><i class="fas fa-project-diagram"></i> Projets</a></li>
                <li><a href="/tickets"><i class="fas fa-ticket-alt"></i> Tickets</a></li>
                <li><a href="/heures"><i class="fas fa-clock"></i> Mes Heures</a></li>
                <li class="active"><a href="/admin"><i class="fas fa-users-cog"></i> Admin</a></li>
            </ul>
            <div class="Deconnexion">
                <a href="/logout"><i class="fas fa-sign-out-alt"></i> Deconnexion</a>
            </div>
        </nav>

        <main class="main-content">
            <header>
                <h1>Gestion des Utilisateurs</h1>
            </header>

            <div class="tickets-container">
                <h2>Tous les utilisateurs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle actuel</th>
                            <th>Changer le rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>#{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="client-badge">{{ $user->role }}</span></td>
                            <td>
                                <form action="/admin/users/{{ $user->id }}/role" method="POST" style="display:flex; gap:8px;">
                                    @csrf
                                    <select name="role" style="padding:5px; border-radius:6px;">
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="collaborateur" {{ $user->role == 'collaborateur' ? 'selected' : '' }}>Collaborateur</option>
                                        <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                                    </select>
                                    <button type="submit" style="padding:5px 10px; background:#6c63ff; color:white; border:none; border-radius:6px; cursor:pointer;">
                                        Sauvegarder
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>