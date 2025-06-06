<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Plateforme Séminaires'))</title>
    
    <!-- Intégration de Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles intégrés pour éviter les dépendances externes -->
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #f9fafb;
            --accent: #f59e0b;
            --text: #1f2937;
            --text-light: #6b7280;
            --success: #10b981;
            --danger: #ef4444;
            --border: #e5e7eb;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f9fafb;
            color: var(--text);
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Layout principal */
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
            font-weight: 700;
        }
        
        .logo i {
            background: white;
            color: var(--primary);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .nav-menu {
            padding: 1rem;
        }
        
        .nav-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0.75rem;
            padding: 0 0.5rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            margin-bottom: 0.25rem;
            transition: all 0.2s;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }
        
        .nav-link i {
            width: 24px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
            text-align: center;
        }
        
        .sidebar-footer {
            padding: 1.5rem 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
        }
        
        .user-info h4 {
            font-weight: 600;
            margin-bottom: 0.15rem;
        }
        
        .user-info p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Contenu principal */
        .main-content {
            flex: 1;
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Topbar */
        .topbar {
            background: white;
            padding: 1rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text);
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .logout-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s;
        }
        
        .logout-btn:hover {
            background: var(--primary-dark);
        }
        
        /* Contenu de la page */
        .content-wrapper {
            flex: 1;
            padding: 1.5rem;
        }
        
        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        /* Alertes */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .alert-success {
            background: #ecfdf5;
            border-left: 4px solid var(--success);
            color: #065f46;
        }
        
        .alert-error {
            background: #fef2f2;
            border-left: 4px solid var(--danger);
            color: #b91c1c;
        }
        
        /* Version mobile */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: -260px;
            height: 100vh;
            width: 260px;
            z-index: 2000;
            transition: left 0.3s ease;
        }
        
        .mobile-sidebar.active {
            left: 0;
        }
        
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1500;
        }
        
        .overlay.active {
            display: block;
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body class="app-container">
    <!-- Sidebar pour desktop -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Plateforme Séminaires</span>
            </div>
        </div>
        
        <div class="nav-menu">
            <div class="nav-title">Navigation Principale</div>
            
            @if (Auth::user()->role === 'presentateur')
                <a href="{{ route('presentateur.dashboard') }}" class="nav-link @if(request()->routeIs('presentateur.dashboard')) active @endif">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
                
                <a href="{{ route('seminaire.create') }}" class="nav-link @if(request()->routeIs('seminaire.create')) active @endif">
                    <i class="fas fa-plus-circle"></i>
                    <span>Demander un séminaire</span>
                </a>
                
                <a href="{{ route('etudiants.seminaires') }}" class="nav-link @if(request()->routeIs('etudiants.seminaires')) active @endif">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Séminaires disponibles</span>
                </a>
            @elseif (Auth::user()->role === 'secretaire')
                <a href="{{ route('secretaire.dashboard') }}" class="nav-link @if(request()->routeIs('secretaire.dashboard')) active @endif">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
                
                <a href="{{ route('etudiants.seminaires') }}" class="nav-link @if(request()->routeIs('etudiants.seminaires')) active @endif">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Séminaires disponibles</span>
                </a>
                
                <a href="{{ route('secretaire.seminaires.attente') }}" class="nav-link @if(request()->routeIs('secretaire.seminaires.attente')) active @endif">
                    <i class="fas fa-clock"></i>
                    <span>Séminaires en attente</span>
                </a>
            @elseif (Auth::user()->role === 'etudiant')
                <a href="{{ route('etudiants.seminaires') }}" class="nav-link @if(request()->routeIs('etudiants.seminaires')) active @endif">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Séminaires disponibles</span>
                </a>
            @endif
        </div>
        
        <a href="{{ route('profile.edit') }}" class="user-profile" style="text-decoration: none;">
    <div class="user-avatar">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>
    <div class="user-info">
        <h4>{{ Auth::user()->name }}</h4>
        <p>{{ ucfirst(Auth::user()->role) }}</p>
    </div>
</a>

        <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Se déconnecter
                    </button>
                </form>
    </aside>
    
    <!-- Sidebar pour mobile -->
    <div class="overlay" id="sidebarOverlay"></div>
    <aside class="mobile-sidebar" id="mobileSidebar">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Plateforme Séminaires</span>
                </div>
            </div>
            
            <div class="nav-menu">
                <div class="nav-title">Navigation Principale</div>
                
                @if (Auth::user()->role === 'presentateur')
                    <a href="{{ route('presentateur.dashboard') }}" class="nav-link @if(request()->routeIs('presentateur.dashboard')) active @endif">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                    
                    <a href="{{ route('seminaire.create') }}" class="nav-link @if(request()->routeIs('seminaire.create')) active @endif">
                        <i class="fas fa-plus-circle"></i>
                        <span>Demander un séminaire</span>
                    </a>
                    
                    <a href="{{ route('etudiants.seminaires') }}" class="nav-link @if(request()->routeIs('etudiants.seminaires')) active @endif">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Séminaires disponibles</span>
                    </a>
                @elseif (Auth::user()->role === 'secretaire')
                    <a href="{{ route('secretaire.dashboard') }}" class="nav-link @if(request()->routeIs('secretaire.dashboard')) active @endif">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                    
                    <a href="{{ route('etudiants.seminaires') }}" class="nav-link @if(request()->routeIs('etudiants.seminaires')) active @endif">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Séminaires disponibles</span>
                    </a>
                    
                    <a href="{{ route('secretaire.seminaires.attente') }}" class="nav-link @if(request()->routeIs('secretaire.seminaires.attente')) active @endif">
                        <i class="fas fa-clock"></i>
                        <span>Séminaires en attente</span>
                    </a>
                @elseif (Auth::user()->role === 'etudiant')
                    <a href="{{ route('etudiants.seminaires') }}" class="nav-link @if(request()->routeIs('etudiants.seminaires')) active @endif">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Séminaires disponibles</span>
                    </a>
                @endif
            </div>
            
            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p>{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    
    <!-- Contenu principal -->
    <div class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div>
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">@yield('title', 'Bienvenue')</h1>
            </div>
            
            <div class="user-actions">
                <span>👋 Bonjour, {{ Auth::user()->name }}</span>
                
            </div>
        </header>
        
        <!-- Contenu de la page -->
        <div class="content-wrapper">
            <!-- Messages flash -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif
            
            <!-- Contenu spécifique à chaque page -->
            <div class="content-card">
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        // Gestion du menu mobile
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileSidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            function toggleSidebar() {
                mobileSidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleSidebar);
            }
            
            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }
            
            // Fermer le menu mobile lorsqu'on clique sur un lien
            const navLinks = document.querySelectorAll('.mobile-sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', toggleSidebar);
            });
        });
    </script>
    
    <!-- Scripts additionnels spécifiques aux pages -->
    @stack('scripts')
</body>
</html>