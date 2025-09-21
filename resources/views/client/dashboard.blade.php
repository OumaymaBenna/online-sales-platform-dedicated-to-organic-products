<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme Client - MaBoutique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        * {
            transition: all 0.3s ease;
        }
        
        body {
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
            color: #22c55e;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        /* Effet de feuilles flottantes */
        .leaf {
            position: absolute;
            z-index: -1;
            opacity: 0.15;
            animation: float 8s ease-in-out infinite;
        }
        
        .leaf:nth-child(2n) {
            animation-delay: 1s;
            animation-duration: 9s;
        }
        
        .leaf:nth-child(3n) {
            animation-delay: 2s;
            animation-duration: 7s;
        }

        nav, .bg-white, .shadow-xl, .rounded-2xl {
            background: rgba(255, 255, 255, 0.92) !important;
            color: #166534 !important;
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.08);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(220, 252, 231, 0.5);
        }

        .active-tab {
            background: rgba(220, 252, 231, 0.6);
            border-radius: 16px;
            position: relative;
            font-weight: 600;
        }

        .active-tab::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 4px;
            background: #22c55e;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .text-primary-600, .text-primary-400, .text-primary-100 {
            color: #166534 !important;
        }

        .bg-primary-600, .bg-primary-400, .bg-primary-100 {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
            color: #fff !important;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        .bg-primary-600::before, .bg-primary-400::before, .bg-primary-100::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s ease;
        }

        button, .primary-button, .bg-primary-600 {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: #fff !important;
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.25);
            font-weight: 600;
            padding: 0.8em 2.2em;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        button::before, .primary-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.6s ease;
            z-index: -1;
        }

        button:hover::before, .primary-button:hover::before {
            left: 100%;
        }

        button:hover, .primary-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(34, 197, 94, 0.35);
        }

        .category-card, .product-card {
            background: rgba(255, 255, 255, 0.9) !important;
            border: 1px solid rgba(187, 247, 208, 0.5);
            border-radius: 24px;
            box-shadow: 0 8px 20px rgba(187, 247, 208, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(6px);
            overflow: hidden;
        }

        .category-card:hover, .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 35px rgba(187, 247, 208, 0.4);
            border-color: #86efac;
        }

        .category-card::after, .product-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #22c55e, #86efac, #22c55e);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }

        .category-card:hover::after, .product-card:hover::after {
            transform: scaleX(1);
        }

        input, select, textarea {
            border: 2px solid #dcfce7 !important;
            background: #f0fdf4 !important;
            color: #166534 !important;
            border-radius: 14px;
            padding: 0.9em 1.4em;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #22c55e !important;
            outline: none;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.2);
            background: #ffffff !important;
        }

        footer {
            background: linear-gradient(135deg, #166534 0%, #14532d 100%) !important;
            color: #fff !important;
            border-radius: 30px 30px 0 0;
            box-shadow: 0 -8px 30px rgba(20, 83, 45, 0.15);
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #22c55e, #86efac, #22c55e);
        }

        footer a {
            color: #dcfce7 !important;
            font-weight: 500;
            position: relative;
        }

        footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #86efac;
            transition: width 0.3s ease;
        }

        footer a:hover::after {
            width: 100%;
        }

        .notification-item {
            transition: all 0.3s ease;
            transform-origin: top;
        }

        .notification-item:hover {
            transform: translateX(5px);
        }

        .notification-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #22c55e;
            border-radius: 0 4px 4px 0;
            transform: scaleY(0);
            transform-origin: top;
            transition: transform 0.4s ease;
        }

        .notification-item:hover::before {
            transform: scaleY(1);
        }
        
        .profile-circle {
            position: relative;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 0 0 3px #dcfce7, 0 0 0 6px #86efac;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .profile-circle:hover {
            transform: scale(1.05);
            box-shadow: 0 0 0 3px #dcfce7, 0 0 0 8px #4ade80;
        }
        
        .cart-icon {
            transition: all 0.3s ease;
        }
        
        .cart-icon:hover {
            transform: rotate(-10deg) scale(1.1);
        }
        
        .cart-count {
            animation: pulse-slow 2s infinite;
        }
        
        .welcome-section {
            background: linear-gradient(135deg, #22c55e 0%, #166534 100%);
            border-radius: 24px;
            overflow: hidden;
            position: relative;
        }
        
        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            transform: rotate(30deg);
            animation: float 10s linear infinite;
        }
        
        .feature-icon {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .feature-icon:hover {
            transform: translateY(-5px) rotate(5deg);
            filter: drop-shadow(0 5px 10px rgba(34, 197, 94, 0.3));
        }
        
        .tab-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .tab-link:hover {
            color: #166534;
        }
        
        .tab-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: #22c55e;
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        
        .tab-link:hover::after {
            width: 100%;
        }
        
        .footer-logo {
            filter: drop-shadow(0 0 8px rgba(187, 247, 208, 0.5));
            transition: all 0.4s ease;
        }
        
        .footer-logo:hover {
            filter: drop-shadow(0 0 12px rgba(187, 247, 208, 0.7));
            transform: rotate(5deg);
        }
        
        .social-icon {
            transition: all 0.3s ease;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .social-icon:hover {
            transform: translateY(-3px) scale(1.1);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .section-title {
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60%;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #bbf7d0);
            border-radius: 4px;
        }
        
        .new-badge {
            animation: bounce-slow 2s infinite;
        }
        
        .product-image {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        
        .action-card {
            transition: all 0.3s ease;
            transform-style: preserve-3d;
        }
        
        .action-card:hover {
            transform: translateY(-5px) rotateX(5deg);
            box-shadow: 0 15px 30px rgba(187, 247, 208, 0.3);
        }
        
        .action-card .icon-wrapper {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .action-card:hover .icon-wrapper {
            transform: scale(1.2) rotate(10deg);
        }
        
        .theme-toggle {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .theme-toggle:hover {
            transform: rotate(15deg) scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        :root {
            --primary: #22c55e;
            --primary-dark: #166534;
            --primary-light: #079037;
            --accent: #ff9800;
            --shadow: 0 8px 32px rgba(34,197,94,0.10);
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .navbar {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            color: var(--primary-dark);
            padding: 1rem 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 100;
            border-radius: 18px;
            transition: box-shadow 0.3s;
            border: 1.5px solid var(--primary-light);
        }
        .navbar:hover {
            box-shadow: 0 12px 32px rgba(34,197,94,0.18);
        }
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-logo {
            font-size: 1.7rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            color: var(--primary-dark);
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 0.7em;
        }
        .nav-logo .logo-icon {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            border-radius: 50%;
            width: 2.2em;
            height: 2.2em;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
            box-shadow: 0 2px 8px rgba(34,197,94,0.10);
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
            align-items: center;
        }
        .nav-links li {
            position: relative;
            display: flex;
            align-items: center;
        }
        .nav-links li a, .nav-links li form button {
            color: var(--primary-dark);
            font-weight: 600;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 1.08rem;
            padding: 0.5em 1.1em 0.5em 0.9em;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.6em;
            transition: color 0.3s, background 0.3s, box-shadow 0.3s;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        .nav-links li a .nav-icon, .nav-links li form button .nav-icon {
            font-size: 1.1em;
            color: var(--primary);
            transition: color 0.3s;
        }
        .nav-links li a:hover, .nav-links li form button:hover {
            color: #fff;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            box-shadow: 0 2px 12px rgba(34,197,94,0.10);
        }
        .nav-links li a:hover .nav-icon, .nav-links li form button:hover .nav-icon {
            color: #fff;
        }
        .burger {
            display: none;
            flex-direction: column;
            justify-content: center;
            width: 32px;
            height: 32px;
            cursor: pointer;
            margin-left: 1rem;
            transition: transform 0.3s;
        }
        .burger span {
            height: 4px;
            width: 100%;
            background: var(--primary-dark);
            margin-bottom: 5px;
            border-radius: 2px;
            transition: 0.4s cubic-bezier(.4,2,.6,1);
        }
        .burger span:last-child {
            margin-bottom: 0;
        }
        .burger.open span:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
            background: var(--primary);
        }
        .burger.open span:nth-child(2) {
            opacity: 0;
        }
        .burger.open span:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
            background: var(--primary);
        }
        @media (max-width: 900px) {
            .nav-container {
                padding: 0 0.5rem;
            }
        }
        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                background: rgba(255,255,255,0.97);
                backdrop-filter: blur(12px);
                position: absolute;
                top: 70px;
                right: 0;
                width: 220px;
                padding: 1rem;
                display: none;
                border-radius: 0 0 0 18px;
                box-shadow: var(--shadow);
            }
            .nav-links.active {
                display: flex;
            }
            .burger {
                display: flex;
            }
        }
        .nav-links li.logout-btn form button {
            display: flex;
            align-items: center;
            gap: 0.7em;
            background: transparent;
            color: var(--primary-dark) !important;
            font-weight: 700;
            border-radius: 999px;
            padding: 0.5em 1.5em 0.5em 1.1em;
            border: 2px solid var(--primary);
            box-shadow: 0 2px 8px rgba(46,125,50,0.06);
            position: relative;
            z-index: 1;
            transition: box-shadow 0.25s, border 0.25s, color 0.25s, background 0.25s;
            font-size: 1.08rem;
        }
        .nav-links li.logout-btn form button .logout-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--primary);
            border-radius: 50%;
            width: 2em;
            height: 2em;
            font-size: 1.1em;
            box-shadow: 0 2px 8px rgba(34,197,94,0.10);
            margin-right: 0.1em;
            transition: background 0.25s, color 0.25s;
        }
        .nav-links li.logout-btn form button:hover {
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            color: #fff !important;
            border: 2px solid var(--primary-light);
            box-shadow: 0 6px 24px rgba(34,197,94,0.13);
        }
        .nav-links li.logout-btn form button:hover .logout-icon {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen relative">
    <!-- Effet de feuilles décoratives -->
    <div class="leaf" style="top: 5%; left: 5%; transform: rotate(20deg);">
        <i class="fas fa-leaf text-primary-400 text-4xl"></i>
    </div>
    <div class="leaf" style="top: 15%; right: 8%; transform: rotate(-15deg);">
        <i class="fas fa-leaf text-primary-400 text-3xl"></i>
    </div>
    <div class="leaf" style="bottom: 20%; left: 10%; transform: rotate(10deg);">
        <i class="fas fa-leaf text-primary-300 text-5xl"></i>
    </div>
    <div class="leaf" style="bottom: 15%; right: 7%; transform: rotate(-25deg);">
        <i class="fas fa-leaf text-primary-300 text-4xl"></i>
    </div>
    <div class="leaf" style="top: 30%; left: 15%; transform: rotate(5deg);">
        <i class="fas fa-leaf text-primary-500 text-3xl"></i>
    </div>

    <!-- NAVBAR CLIENT STYLE PRODUCTEUR -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo"><span class="logo-icon"><i class="fas fa-store"></i></span> MaBoutique</div>
            <div class="burger" id="burger-menu" aria-label="Ouvrir le menu" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="nav-links">
                <li><a href="{{ route('client.dashboard') }}"><span class="nav-icon"><i class="fas fa-home"></i></span> Accueil</a></li>
                <li><a href="{{ route('client.produits') }}"><span class="nav-icon"><i class="fas fa-box"></i></span> Produits</a></li>
                <li><a href="{{ route('client.panier') }}"><span class="nav-icon"><i class="fas fa-shopping-cart"></i></span> Panier</a></li>
                <li><a href="#"><span class="nav-icon"><i class="fas fa-user"></i></span> Profil</a></li>
                <li class="logout-btn">
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit"><span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span> Déconnexion</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section de bienvenue -->
            <div class="mb-12">
                <div class="welcome-section rounded-2xl shadow-xl p-8 relative overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between relative z-10">
                        <div class="flex items-center mb-6 md:mb-0">
                            <div class="bg-white bg-opacity-20 p-4 rounded-full mr-6 shadow-lg">
                                <i class="fas fa-user text-white text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl md:text-3xl font-bold text-primary-600 mb-2">Bienvenue, {{ $user->name }} !</h3>
                                <p class="text-primary-100 font-medium">{{ $totalProduits }} produits disponibles dans notre boutique</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <button class="bg-white bg-opacity-90 text-primary-700 hover:bg-opacity-100 font-medium py-3 px-6 rounded-xl transition flex items-center shadow-md">
                                <i class="fas fa-envelope mr-3 text-lg"></i> 
                                <span>Voir messages</span>
                            </button>
                            <button class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-medium py-3 px-6 rounded-xl transition flex items-center shadow-md">
                                <i class="fas fa-box mr-3 text-lg"></i> 
                                <span>Suivre commandes</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Actions rapides -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl mb-12">
                <div class="p-8">
                    <h3 class="section-title text-2xl font-bold text-primary-600 dark:text-white mb-8">Actions rapides</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($actionsRapides as $action)
                            <a href="{{ $action['lien'] }}" class="action-card flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-700 rounded-xl transition">
                                <div class="icon-wrapper bg-{{ $action['couleur'] }}-100 dark:bg-{{ $action['couleur'] }}-900 p-4 rounded-full mb-4">
                                    <i class="{{ $action['icone'] }} text-{{ $action['couleur'] }}-600 dark:text-{{ $action['couleur'] }}-400 text-2xl"></i>
                                </div>
                                <span class="font-semibold text-gray-800 dark:text-gray-200 text-center">{{ $action['titre'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Section Catégories -->
            <div class="mb-14">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="section-title text-2xl font-bold text-primary-600 dark:text-white">Catégories de produits</h2>
                    <a href="{{ route('client.produits') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-semibold flex items-center group">
                        <span class="mr-2">Voir toutes les catégories</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach($categories as $categorie)
                        @php
                            $categoryData = \App\Helpers\CategoryHelper::getCategoryData($categorie);
                        @endphp
                        <div class="category-card bg-white dark:bg-gray-800 overflow-hidden">
                            <div class="bg-gradient-to-br {{ $categoryData['couleur'] }} h-40 flex items-center justify-center">
                                <i class="{{ $categoryData['icone'] }} text-white text-5xl feature-icon"></i>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-lg text-primary-600 dark:text-white mb-3">{{ ucfirst($categorie) }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $categoryData['description'] }}</p>
                                <div>
                                    <a href="{{ route('client.produits', ['categorie' => $categorie]) }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium text-sm flex items-center group">
                                        <span class="mr-2">Voir produits</span>
                                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Produits populaires -->
            <div class="mb-14">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="section-title text-2xl font-bold text-primary-600 dark:text-white">Produits populaires</h2>
                    <a href="{{ route('client.produits') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-semibold flex items-center group">
                        <span class="mr-2">Voir tous les produits</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($produitsPopulaires as $produit)
                        <div class="product-card bg-white dark:bg-gray-800 overflow-hidden">
                            <div class="relative h-56 overflow-hidden">
                                @if($produit->image)
                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-full object-cover product-image">
                                @else
                                    <div class="bg-gray-200 border-2 border-dashed rounded-t-xl w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <button class="bg-white rounded-full p-2 shadow-lg text-gray-500 hover:text-red-500 transform hover:scale-110">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="font-bold text-lg text-primary-600 dark:text-white mb-1">{{ $produit->nom }}</h3>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">{{ Str::limit($produit->description, 50) }}</p>
                                        @if($produit->producteur)
                                            <p class="text-xs text-primary-600 dark:text-primary-400 font-medium">Par {{ $produit->producteur->nom_entreprise }}</p>
                                        @endif
                                    </div>
                                    @if($produit->created_at->diffInDays(now()) < 7)
                                        <span class="new-badge bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">Nouveau</span>
                                    @endif
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-gray-800 dark:text-white">{{ number_format($produit->prix, 2) }} DT</span>
                                    <form action="{{ route('client.panier.ajouter') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                        <button type="submit" class="primary-button bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-lg flex items-center">
                                            <i class="fas fa-cart-plus mr-2"></i> Ajouter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Dernières notifications -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="section-title text-2xl font-bold text-primary-600 dark:text-white">Dernières notifications</h3>
                        <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-semibold flex items-center group">
                            <span class="mr-2">Voir tout</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                    <div class="space-y-5">
                        @foreach($notifications as $notification)
                            <div class="notification-item flex items-start p-5 rounded-xl bg-gray-50 dark:bg-gray-700 relative">
                                <div class="bg-{{ $notification['couleur'] }}-100 dark:bg-{{ $notification['couleur'] }}-900 p-3 rounded-full mr-5">
                                    <i class="{{ $notification['icone'] }} text-{{ $notification['couleur'] }}-600 dark:text-{{ $notification['couleur'] }}-400 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-lg text-gray-800 dark:text-white mb-1">{{ $notification['titre'] }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300 mb-2">{{ $notification['message'] }}</p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $notification['temps'] }}</span>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 ml-4">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-16 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center mb-5">
                        <div class="bg-primary-500 p-2 rounded-full mr-3 footer-logo">
                            <i class="fas fa-store text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold">MaBoutique</h3>
                    </div>
                    <p class="text-gray-300 mb-6">Votre destination de shopping en ligne pour tous vos besoins.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-5">Liens rapides</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('client.dashboard') }}">Accueil</a></li>
                        <li><a href="{{ route('client.produits') }}">Produits</a></li>
                        <li><a href="#">Catégories</a></li>
                        <li><a href="#">Promotions</a></li>
                        <li><a href="#">Nouveautés</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-5">Compte</h3>
                    <ul class="space-y-3">
                        <li><a href="#">Mon compte</a></li>
                        <li><a href="#">Mes commandes</a></li>
                        <li><a href="#">Mes favoris</a></li>
                        <li><a href="#">Paramètres</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-300 hover:text-white bg-transparent border-none p-0">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-5">Contact</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-gray-300"></i>
                            <span class="text-gray-300">12 Avenue de la Liberté, Tunis, Tunisie</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-gray-300"></i>
                            <span class="text-gray-300">+216 12 345 678</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-gray-300"></i>
                            <span class="text-gray-300">contact@boutiquetunisie.tn</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} MaBoutique. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bouton dark/light mode -->
    <button id="theme-toggle" class="theme-toggle fixed bottom-8 right-8 bg-primary-600 text-white rounded-full p-4 shadow-xl z-50">
        <i id="theme-icon" class="fas fa-moon text-xl"></i>
    </button>

    <script>
        // Toggle dark mode
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;
        
        // Vérifier le thème préféré de l'utilisateur
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
            themeIcon.classList.replace('fa-moon', 'fa-sun');
        } else {
            html.classList.remove('dark');
            themeIcon.classList.replace('fa-sun', 'fa-moon');
        }
        
        // Basculer entre les thèmes
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            
            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            } else {
                localStorage.setItem('theme', 'light');
                themeIcon.classList.replace('fa-sun', 'fa-moon');
            }
        });
        
        // Animation pour les notifications
        document.querySelectorAll('.notification-item').forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });

        const burger = document.getElementById('burger-menu');
        const navLinks = document.getElementById('nav-links');
        burger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            burger.classList.toggle('open');
        });
        // Accessibilité : fermer le menu au focus out ou touche Echap
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') navLinks.classList.remove('active');
        });
        document.addEventListener('click', function(e) {
            if (!navLinks.contains(e.target) && !burger.contains(e.target)) {
                navLinks.classList.remove('active');
                burger.classList.remove('open');
            }
        });
    </script>
</body>
</html>