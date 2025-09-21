<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos produits frais - Ferme Locale</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #22c55e;
            --primary-light: #4ade80;
            --primary-dark: #166534;
            --secondary: #ff4081;
            --background: #f9f7f3;
            --card-bg: #fff;
            --border-radius: 18px;
            --shadow: 0 4px 16px rgba(34,197,94,0.08);
            --transition: 0.2s cubic-bezier(.4,0,.2,1);
            --font-main: 'Poppins', Arial, sans-serif;
            --font-title: 'Playfair Display', serif;
        }
        body {
            background: var(--background);
            font-family: var(--font-main);
            color: #222;
            margin: 0;
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
        /* Nouveau design pour Favoris & Panier dans la navbar */
        .nav-links .nav-action {
            display: flex;
            align-items: center;
            gap: 0.7em;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.08rem;
            padding: 0.5em 1.3em 0.5em 1em;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(34,197,94,0.08);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            border: none;
        }
        .nav-links .nav-action.favoris {
            background: var(--secondary);
            color: #fff;
        }
        .nav-links .nav-action.favoris:hover {
            background: #ff6fa3;
            color: #fff;
            box-shadow: 0 4px 16px rgba(255,64,129,0.15);
        }
        .nav-links .nav-action.panier {
            background: var(--primary);
            color: #fff;
        }
        .nav-links .nav-action.panier:hover {
            background: var(--primary-dark);
            color: #fff;
            box-shadow: 0 4px 16px rgba(34,197,94,0.15);
        }
        .nav-links .nav-action .nav-icon {
            font-size: 1.2em;
        }
        .nav-links .nav-action .badge {
            margin-left: 0.7em;
            background: #fff;
            color: inherit;
            border-radius: 50%;
            min-width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1em;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .nav-links .nav-action.favoris .badge {
            background: var(--secondary);
            color: #fff;
        }
        .nav-links .nav-action.panier .badge {
            background: var(--primary);
            color: #fff;
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
        .cart-badge {
            background: #ff4081;
            color: white;
            border-radius: 9999px;
            padding: 0.2em 0.7em;
            font-size: 0.9em;
            position: absolute;
            top: -8px;
            right: -18px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(255,64,129,0.15);
        }
        .container {
            max-width: 1200px;
            margin: 2.5rem auto 0 auto;
            background: transparent;
            padding: 0 1.5rem 2rem 1.5rem;
        }
        .page-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .page-header h1 {
            font-family: var(--font-title);
            font-size: 2.7rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        .page-header p {
            color: #666;
            font-size: 1.15rem;
        }
        .search-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem 2rem;
            margin-bottom: 2.5rem;
        }
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .form-control, .form-select {
            border-radius: 50px;
            border: 1px solid #e0e0e0;
            padding: 0.7rem 1.2rem;
            font-size: 1rem;
            outline: none;
            transition: border var(--transition);
        }
        .form-control:focus, .form-select:focus {
            border: 1.5px solid var(--primary);
        }
        .btn.btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.7rem 1.5rem;
            transition: background var(--transition), transform var(--transition);
        }
        .btn.btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px) scale(1.04);
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.2rem;
        }
        .product-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: box-shadow var(--transition), transform var(--transition);
        }
        .product-card:hover {
            box-shadow: 0 8px 32px rgba(56,142,60,0.13);
            transform: translateY(-4px) scale(1.01);
        }
        .product-image {
            position: relative;
            width: 100%;
            height: 220px;
            background: #f3f3f3;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
        }
        .placeholder-icon {
            font-size: 4rem;
            color: var(--primary-light);
            opacity: 0.3;
        }
        .category-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--primary-light);
            color: white;
            padding: 0.4em 1em;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(56,142,60,0.10);
        }
        .wishlist-button {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.10);
            cursor: pointer;
            transition: var(--transition);
            z-index: 10;
            font-size: 1.3rem;
        }
        .wishlist-button:hover {
            background: var(--secondary);
            color: white;
            transform: scale(1.13);
        }
        .wishlist-button.active {
            color: var(--secondary);
        }
        .wishlist-button.active:hover {
            color: white;
            background: var(--secondary);
        }
        .product-content {
            padding: 1.5rem 1.3rem 1.2rem 1.3rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .product-title {
            font-family: var(--font-title);
            font-size: 1.45rem;
            color: var(--primary);
            margin: 0 0 0.5rem 0;
        }
        .product-info {
            display: flex;
            gap: 1.2rem;
            margin-bottom: 0.7rem;
            color: #666;
            font-size: 1rem;
        }
        .product-info i {
            color: var(--primary-light);
            margin-right: 0.3rem;
        }
        .product-description {
            color: #444;
            font-size: 1.08rem;
            margin: 0.7rem 0 1.1rem 0;
            flex: 1;
        }
        .product-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .btn-details {
            background: var(--secondary);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1.3rem;
            font-weight: 600;
            font-size: 1rem;
            transition: background var(--transition), transform var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .btn-details:hover {
            background: #ff6fa3;
            transform: translateY(-2px) scale(1.04);
        }
        .btn-cart {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1.3rem;
            font-weight: 600;
            font-size: 1rem;
            transition: background var(--transition), transform var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .btn-cart:hover {
            background: var(--primary-light);
            transform: translateY(-2px) scale(1.04);
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-top: 2rem;
        }
        .empty-state i {
            font-size: 5rem;
            color: var(--secondary);
            margin-bottom: 1.5rem;
            opacity: 0.3;
        }
        .empty-state h4 {
            font-size: 1.8rem;
            color: #666;
            margin-bottom: 1rem;
        }
        .pagination-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 2.5rem;
            gap: 0.7rem;
        }
        .pagination-summary {
            font-size: 1.08rem;
            color: #388e3c;
            font-weight: 500;
            background: #e8f5e9;
            border-radius: 22px;
            padding: 0.5em 1.5em;
            box-shadow: 0 2px 8px rgba(34,197,94,0.08);
            margin-bottom: 0.5rem;
        }
        .pagination-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .pagination {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .pagination li {
            display: inline-block;
        }
        .pagination .page-link {
            background: #fff;
            color: var(--primary-dark);
            border: 1.5px solid var(--primary-light);
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.2s, color 0.2s, border 0.2s;
            box-shadow: 0 2px 8px rgba(34,197,94,0.06);
            margin: 0 2px;
            text-decoration: none;
        }
        .pagination .page-item.active .page-link {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 4px 16px rgba(34,197,94,0.13);
        }
        .pagination .page-link:hover {
            background: var(--primary-light);
            color: #fff;
            border-color: var(--primary-light);
        }
        .pagination .page-item.disabled .page-link {
            background: #f3f3f3;
            color: #bbb;
            border-color: #e0e0e0;
            cursor: not-allowed;
        }
        .pagination .page-link i {
            font-size: 1.2em;
        }
        @media (max-width: 600px) {
            .pagination .page-link {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }
            .pagination-summary {
                font-size: 0.98rem;
                padding: 0.4em 1em;
            }
        }
        /* Footer */
        .footer {
            background: var(--primary);
            color: white;
            padding: 3rem 0 1.2rem 0;
            margin-top: 3rem;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2.5rem;
            padding: 0 2rem;
        }
        .footer-section h3 {
            font-family: var(--font-title);
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }
        .footer-section p {
            color: #e0e0e0;
            font-size: 1.05rem;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li {
            margin-bottom: 0.7rem;
        }
        .footer-links a {
            color: #e0e0e0;
            text-decoration: none;
            font-size: 1.05rem;
            transition: color var(--transition);
        }
        .footer-links a:hover {
            color: var(--secondary);
        }
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .social-link {
            color: #e0e0e0;
            font-size: 1.3rem;
            transition: color var(--transition);
        }
        .social-link:hover {
            color: var(--secondary);
        }
        .copyright {
            text-align: center;
            color: #e0e0e0;
            font-size: 1rem;
            margin-top: 2.5rem;
        }
        /* Responsive */
        @media (max-width: 900px) {
            .container, .footer-content {
                padding: 0 1rem;
            }
            .search-card {
                padding: 1rem 1rem;
            }
        }
        @media (max-width: 600px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
                padding: 0 1rem;
            }
            .product-grid {
                grid-template-columns: 1fr;
            }
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
        /* Barre de navigation style dashboard */
        .navbar-dashboard {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(56,142,60,0.05);
            color: #222;
            padding: 1.2rem 0;
            font-family: 'Figtree', Arial, sans-serif;
        }

        .navbar-dashboard .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .navbar-dashboard .nav-logo {
            font-size: 2rem;
            font-weight: 700;
            color: #388e3c;
            letter-spacing: 1px;
            font-family: 'Playfair Display', serif;
        }

        .navbar-dashboard .nav-links {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        .navbar-dashboard .nav-links a {
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            transition: color 0.2s;
            position: relative;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
        }

        .navbar-dashboard .nav-links a:hover {
            color: #388e3c;
            background: #f3f4f6;
        }

        .navbar-dashboard .cart-badge {
            background: #ff4081;
            color: white;
            border-radius: 9999px;
            padding: 0.2em 0.7em;
            font-size: 0.9em;
            position: absolute;
            top: -8px;
            right: -18px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(255,64,129,0.15);
        }

        @media (max-width: 900px) {
            .navbar-dashboard .nav-container {
                padding: 0 1rem;
            }
        }
        @media (max-width: 600px) {
            .navbar-dashboard .nav-container {
                flex-direction: column;
                gap: 1rem;
                padding: 0 1rem;
            }
            .navbar-dashboard .nav-links {
                flex-direction: column;
                gap: 1rem;
                width: 100%;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <!-- Message de succès -->
    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; border-radius: 14px; padding: 1em 2em; margin: 2em auto; max-width: 600px; box-shadow: 0 2px 8px rgba(34,197,94,0.10); font-weight: 600; display: flex; align-items: center; gap: 1em;">
            <i class="fas fa-check-circle" style="font-size: 1.5em;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <span class="logo-icon"><i class="fas fa-leaf"></i></span>
                Ferme Locale
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('client.dashboard') }}"><i class="fas fa-home nav-icon"></i>Accueil</a></li>
                <li>
                    <a href="{{ route('client.wishlist') }}" class="nav-action favoris">
                        <i class="fas fa-heart nav-icon"></i>
                        <span>Favoris</span>
                        <span class="badge" id="wishlist-count">{{ isset($userWishlist) ? count($userWishlist) : 0 }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.panier') }}" class="nav-action panier cart-link">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <span>Panier</span>
                        <span class="badge" id="cart-count">{{ isset($cartCount) ? $cartCount : (is_array(session('cart')) ? count(session('cart')) : 0) }}</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon"></i>Déconnexion
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <div class="container">
        <!-- En-tête de page -->
        <header class="page-header">
            <h1>Nos produits frais</h1>
            <p>Découvrez notre sélection de produits locaux, biologiques et artisanaux directement des producteurs de la région</p>
        </header>
        
        <!-- Formulaire de recherche -->
        <div class="search-card">
            <div class="card-body">
                <form method="GET" action="#" class="row g-3 align-items-center search-form">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Rechercher un produit...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="categorie" class="form-select">
                            <option value="">Toutes catégories</option>
                            <option value="legumes">Légumes</option>
                            <option value="fruits">Fruits</option>
                            <option value="huile_olive">Huile d'olive</option>
                            <option value="miel">Miel & Produits de la ruche</option>
                            <option value="produits_laitiers">Produits laitiers</option>
                            <option value="herbes_epices">Herbes & Épices</option>
                            <option value="bio">Produits biologiques</option>
                            <option value="artisanaux">Produits artisanaux</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i> Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Grille de produits -->
        <div class="product-grid">
            @forelse($produits as $produit)
                <div class="product-card" data-product-id="{{ $produit->id }}">
                    <div class="product-image">
                        @if($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}">
                        @else
                            <div class="placeholder-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                        @endif
                        <span class="category-badge badge">{{ $produit->categorie }}</span>
                        <!-- Bouton Wishlist -->
                        <button class="wishlist-button @if(in_array($produit->id, $userWishlist)) active @endif" 
                                data-product-id="{{ $produit->id }}">
                            <i class="@if(in_array($produit->id, $userWishlist)) fas @else far @endif fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">{{ $produit->nom }}</h3>
                        @php
                            $moyenne = $produit->avis->count() ? round($produit->avis->avg('note'), 1) : null;
                            $nbAvis = $produit->avis->count();
                        @endphp
                        <div style="margin-bottom:0.3rem; display:flex; align-items:center; gap:0.5rem;">
                            <span style="font-size:1.1rem; color:#ff9800;">
                                @if($moyenne)
                                    {!! str_repeat('★', round($moyenne)) . str_repeat('☆', 5-round($moyenne)) !!}
                                @else
                                    ☆☆☆☆☆
                                @endif
                            </span>
                            <span style="font-size:1rem; color:#333;">{{ $moyenne ? number_format($moyenne,1) : 'Pas de note' }}</span>
                            <span style="font-size:0.95rem; color:#888;">({{ $nbAvis }} avis)</span>
                        </div>
                        <div class="product-info">
                            <div class="producer">
                                <i class="fas fa-user"></i>
                                <span>{{ $produit->producteur->nom_entreprise ?? 'Producteur inconnu' }}</span>
                            </div>
                            <div class="quantity">
                                <i class="fas fa-box"></i>
                                <span>{{ $produit->quantite }} disponibles</span>
                            </div>
                        </div>
                        <p class="product-description">{{ $produit->description }}</p>

                        @if($produit->unite)
                            <div style="margin-top:0.5rem;">
                                <span style="font-weight:600; color:#388e3c;">
                                    Option :
                                </span>
                                <span style="color:#166534;">
                                    {{ $produit->unite }}
                                </span>
                            </div>
                        @endif

                        @if($nbAvis)
                            <div style="margin-top:0.5rem;">
                                @foreach($produit->avis->sortByDesc('created_at')->take(2) as $avis)
                                    <div style="font-size:0.97rem; color:#555; background:#f8f9fa; border-radius:8px; padding:0.5rem 1rem; margin-bottom:0.3rem;">
                                        <span style="color:#ff9800;">{!! str_repeat('★', $avis->note) . str_repeat('☆', 5-$avis->note) !!}</span>
                                        <span style="font-weight:500; margin-left:0.5rem;">{{ $avis->user->name ?? 'Utilisateur' }}</span>
                                        <span style="color:#aaa; font-size:0.9rem; margin-left:0.7rem;">{{ $avis->created_at ? $avis->created_at->format('d/m/Y') : '' }}</span>
                                        <div>{{ $avis->commentaire }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="product-actions">
                            <button type="button" class="btn-details" aria-label="Voir les détails du produit" tabindex="0" style="display:flex;align-items:center;gap:0.5rem;outline:none;">
                                <i class="fas fa-info-circle"></i> Détails
                            </button>
                            <form method="POST" action="{{ route('client.panier.ajouter') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                <button type="submit" class="btn-cart">
                                    <i class="fas fa-shopping-cart"></i> Ajouter au panier
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h4>Aucun produit trouvé</h4>
                    <p>Essayez de modifier vos filtres ou revenez plus tard.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination + Résumé -->
        <div class="pagination-block" style="display: flex; flex-direction: column; align-items: center; margin-top: 2.5rem; gap: 0.7rem;">
            <div class="pagination-summary" style="font-size: 1.08rem; color: #388e3c; font-weight: 500; background: #e8f5e9; border-radius: 22px; padding: 0.5em 1.5em; box-shadow: 0 2px 8px rgba(34,197,94,0.08); margin-bottom: 0.5rem;">
                <i class="fas fa-info-circle" style="color:#22c55e;margin-right:0.5em;"></i>
                Affichage de {{ $produits->firstItem() }} à {{ $produits->lastItem() }} sur {{ $produits->total() }} résultats
            </div>
            <div class="pagination-container" style="width: 100%; display: flex; justify-content: center;">
                <style>
                    .pagination {
                        display: flex;
                        gap: 0.5rem;
                        list-style: none;
                        padding: 0;
                        margin: 0;
                    }
                    .pagination li {
                        display: inline-block;
                    }
                    .pagination .page-link {
                        background: #fff;
                        color: var(--primary-dark);
                        border: 1.5px solid var(--primary-light);
                        border-radius: 50%;
                        width: 38px;
                        height: 38px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 1.1rem;
                        font-weight: 600;
                        transition: background 0.2s, color 0.2s, border 0.2s;
                        box-shadow: 0 2px 8px rgba(34,197,94,0.06);
                        margin: 0 2px;
                        text-decoration: none;
                    }
                    .pagination .page-item.active .page-link {
                        background: var(--primary);
                        color: #fff;
                        border-color: var(--primary);
                        box-shadow: 0 4px 16px rgba(34,197,94,0.13);
                    }
                    .pagination .page-link:hover {
                        background: var(--primary-light);
                        color: #fff;
                        border-color: var(--primary-light);
                    }
                    .pagination .page-item.disabled .page-link {
                        background: #f3f3f3;
                        color: #bbb;
                        border-color: #e0e0e0;
                        cursor: not-allowed;
                    }
                    .pagination .page-link i {
                        font-size: 1.2em;
                    }
                    @media (max-width: 600px) {
                        .pagination .page-link {
                            width: 32px;
                            height: 32px;
                            font-size: 1rem;
                        }
                        .pagination-summary {
                            font-size: 0.98rem;
                            padding: 0.4em 1em;
                        }
                    }
                </style>
                {!! $produits->onEachSide(1)->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
    
    <!-- Pied de page -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Ferme Locale</h3>
                <p>Votre plateforme de produits frais, locaux et biologiques directement des producteurs de votre région.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Catégories</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-apple-alt"></i>Légumes</a></li>
                    <li><a href="#"><i class="fas fa-apple-alt"></i> Fruits</a></li>
                    <li><a href="#"><i class="fas fa-wine-bottle"></i> Huile d'olive</a></li>
                    <li><a href="#"><i class="fas fa-honey-pot"></i> Miel & Produits de la ruche</a></li>
                    <li><a href="#"><i class="fas fa-cheese"></i> Produits laitiers</a></li>
                    <li><a href="#"><i class="fas fa-seedling"></i> Herbes & Épices</a></li>
                    <li><a href="#"><i class="fas fa-leaf"></i> Produits biologiques</a></li>
                    <li><a href="#"><i class="fas fa-hands-helping"></i> Produits artisanaux</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Liens utiles</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-shopping-cart"></i> Notre boutique</a></li>
                    <li><a href="#"><i class="fas fa-heart"></i> Ma liste de souhaits</a></li>
                    <li><a href="#"><i class="fas fa-tractor"></i> Nos producteurs</a></li>
                    <li><a href="#"><i class="fas fa-leaf"></i> Engagement bio</a></li>
                    <li><a href="#"><i class="fas fa-truck"></i> Livraison</a></li>
                    <li><a href="#"><i class="fas fa-question-circle"></i> FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> 12 Avenue de la Liberté, Tunis, Tunisie</a></li>
                    <li><a href="#"><i class="fas fa-phone"></i> +216 12 345 678</a></li>
                    <li><a href="#"><i class="fas fa-envelope"></i> contact@boutiquetunisie.tn</a></li>
                    <li><a href="#"><i class="fas fa-clock"></i> Lun-Sam: 8h-19h</a></li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            &copy; 2023 Ferme Locale. Tous droits réservés.
        </div>
    </footer>
    
    <script>
        // Auto-hide success message after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('.alert-success');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-100%)';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            }
            
            // Add loading state to cart buttons with enhanced UX
            const cartButtons = document.querySelectorAll('.btn-cart');
            cartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const originalText = this.innerHTML;
                    const originalBackground = this.style.background;
                    const originalTransform = this.style.transform;
                    
                    // Animation de chargement
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Ajout...';
                    this.style.background = '#4caf50';
                    this.style.transform = 'scale(0.95)';
                    this.disabled = true;
                    
                    // Soumettre le formulaire
                    const form = this.closest('form');
                    const formData = new FormData(form);
                    
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(() => {
                        // Animation de succès
                        this.innerHTML = '<i class="fas fa-check"></i> Ajouté !';
                        this.style.background = '#28a745';
                        
                        // Mettre à jour le compteur du panier
                        updateCartCount(1);
                        
                        // Restaurer après 2 secondes
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.background = originalBackground;
                            this.style.transform = originalTransform;
                            this.disabled = false;
                        }, 2000);
                        
                        // Afficher une notification toast
                        showToast('Produit ajouté au panier !', 'success');
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        this.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Erreur';
                        this.style.background = '#dc3545';
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.background = originalBackground;
                            this.style.transform = originalTransform;
                            this.disabled = false;
                        }, 2000);
                        
                        showToast('Erreur lors de l\'ajout au panier', 'error');
                    });
                });
            });
            
            // Gestion des boutons wishlist
            const wishlistButtons = document.querySelectorAll('.wishlist-button');
            wishlistButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const isActive = this.classList.contains('active');
                    
                    // Animation
                    const icon = this.querySelector('i');
                    icon.className = 'fas fa-spinner fa-spin';
                    
                    // Appel AJAX
                    fetch(`/wishlist/${productId}/toggle`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mise à jour de l'interface
                            this.classList.toggle('active');
                            icon.className = this.classList.contains('active') 
                                ? 'fas fa-heart' 
                                : 'far fa-heart';
                            
                            // Afficher une notification
                            showWishlistToast(
                                this.classList.contains('active') 
                                    ? 'Produit ajouté à vos favoris !' 
                                    : 'Produit retiré de vos favoris'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        icon.className = isActive ? 'fas fa-heart' : 'far fa-heart';
                        showToast('Erreur lors de la mise à jour des favoris', 'error');
                    });
                });
            });
            
            // Fonction pour mettre à jour le compteur du panier
            function updateCartCount(delta) {
                fetch('{{ route("client.panier.count") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const cartBadge = document.querySelector('.cart-badge');
                    if (data.count > 0) {
                        if (cartBadge) {
                            cartBadge.textContent = data.count;
                        } else {
                            // Créer le badge s'il n'existe pas
                            const cartLink = document.querySelector('.cart-link');
                            if (cartLink) {
                                const badge = document.createElement('span');
                                badge.className = 'cart-badge';
                                badge.textContent = data.count;
                                cartLink.appendChild(badge);
                            }
                        }
                    } else {
                        if (cartBadge) {
                            cartBadge.remove();
                        }
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour du compteur:', error);
                });
            }
            
            // Fonction pour afficher des notifications toast
            function showToast(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${type === 'success' ? '#28a745' : '#dc3545'};
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 1000;
                    transform: translateX(100%);
                    transition: transform 0.3s ease;
                    max-width: 300px;
                    font-weight: 500;
                `;
                
                const icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
                toast.innerHTML = `<i class="${icon} mr-2"></i>${message}`;
                
                document.body.appendChild(toast);
                
                // Animation d'entrée
                setTimeout(() => {
                    toast.style.transform = 'translateX(0)';
                }, 100);
                
                // Auto-suppression après 3 secondes
                setTimeout(() => {
                    toast.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
            }
            
            // Fonction pour afficher des notifications toast pour la wishlist
            function showWishlistToast(message) {
                const toast = document.createElement('div');
                toast.className = 'toast-wishlist';
                toast.innerHTML = `<i class="fas fa-heart"></i>${message}`;
                
                document.body.appendChild(toast);
                
                // Animation d'entrée
                setTimeout(() => {
                    toast.classList.add('show');
                }, 100);
                
                // Auto-suppression après 3 secondes
                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
            }
        });
    </script>
    
    <!-- Modal Produit -->
    <div id="productModal" class="modal" style="display:none; position:fixed; z-index:2000; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); align-items:center; justify-content:center;">
      <div class="modal-content" style="background:white; border-radius:16px; max-width:500px; width:90%; padding:2rem; position:relative;">
        <span class="close-modal" style="position:absolute; top:1rem; right:1rem; font-size:1.5rem; cursor:pointer;">&times;</span>
        <div id="modalProductDetails"></div>
        <div id="modalProductActions" style="margin-top:1.5rem;"></div>
        <div id="modalProductAvis" style="margin-top:2rem;"></div>
      </div>
    </div>
    <script>
    // Ouvrir la modale produit
    document.querySelectorAll('.btn-details').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.product-card');
            const produitId = card.querySelector('input[name="produit_id"]')?.value || card.dataset.produitId;
            openProductModal(produitId);
        });
    });

    function openProductModal(produitId) {
        const modal = document.getElementById('productModal');
        modal.style.display = 'flex';
        document.getElementById('modalProductDetails').innerHTML = '<div style="text-align:center"><i class="fas fa-spinner fa-spin"></i> Chargement...</div>';
        document.getElementById('modalProductActions').innerHTML = '';
        document.getElementById('modalProductAvis').innerHTML = '';

        fetch(`/client/produits/${produitId}/details`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })            .then(res => res.json())
            .then(data => {
                // Description produit
                document.getElementById('modalProductDetails').innerHTML = `
                    <h2 style="margin-bottom:0.3rem; font-size:2rem; color:#2e7d32;">${data.nom}</h2>
                    <div style="font-size:1.2rem; color:#ff9800; font-weight:bold; margin-bottom:0.2rem;">${data.prix} DT</div>
                    <div style="font-size:1rem; color:#888; margin-bottom:0.2rem;"><strong>Catégorie :</strong> ${data.categorie}</div>
                    <div style="font-size:1rem; color:#888; margin-bottom:0.2rem;"><strong>Producteur :</strong> ${data.producteur}</div>
                    <div style="margin:1rem 0 1.5rem 0; color:#444; font-size:1.08rem; background:#f8f9fa; border-radius:8px; padding:1rem;">${data.description}</div>
                `;
                // Boutons actions
                let actionsHtml = '<div style="display:flex; gap:1rem; margin-bottom:1.2rem;">';
                actionsHtml += `<button class="btn-cart" onclick="addToCart(${data.id}, this)"><i class='fas fa-shopping-cart'></i> Ajouter au panier</button>`;
                actionsHtml += `<button class="btn-wishlist" onclick="toggleWishlist(${data.id}, this)">`;
                actionsHtml += (data.inWishlist ? "<i class='fas fa-heart'></i> Retirer des favoris" : "<i class='far fa-heart'></i> Ajouter aux favoris");
                actionsHtml += '</button>';
                actionsHtml += '</div>';
                document.getElementById('modalProductActions').innerHTML = actionsHtml;

                // Section avis
                let moyenne = data.moyenne || 0;
                let avisHtml = `
                    <div style="border-top:1px solid #eee; padding-top:1.2rem;">
                        <div style="display:flex; align-items:center; gap:0.7rem; margin-bottom:0.7rem;">
                            <span style="font-size:1.3rem; color:#ff9800;">${moyenne ? '★'.repeat(Math.round(moyenne)) + '☆'.repeat(5-Math.round(moyenne)) : '☆☆☆☆☆'}</span>
                            <span style="font-size:1.1rem; color:#333; font-weight:500;">${moyenne ? moyenne.toFixed(1) : 'Pas encore de note'}</span>
                            <span style="font-size:1rem; color:#888;">(${data.avis.length} avis)</span>
                        </div>
                        <div style="margin-bottom:1rem;">
                            ${data.isAuth ? `<button class=\"btn-details\" id=\"showAvisFormBtn\" style=\"background:#ff9800; color:white;\"><i class=\"fas fa-star\"></i> Donner votre avis</button>` : `<span style=\"color:#888; font-size:0.97rem;\">Connectez-vous pour donner votre avis</span>`}
                        </div>
                        <div id="avisList" style="max-height:180px; overflow-y:auto; margin-bottom:1rem;">
                `;
                if (data.avis.length) {
                    avisHtml += data.avis.map(a => `
                        <div style="background:#f8f9fa; border-radius:8px; padding:0.7rem 1rem; margin-bottom:0.7rem;">
                            <div style="font-size:1.1rem; color:#ff9800; margin-bottom:0.2rem;">
                                ${'★'.repeat(a.note)}${'☆'.repeat(5-a.note)}
                                <span style="font-size:0.95rem; color:#333; margin-left:0.5rem; font-weight:500;">${a.user}</span>
                                ${a.date ? `<span style=\"font-size:0.9rem; color:#aaa; margin-left:0.7rem;\">${a.date}</span>` : ''}
                            </div>
                            <div style="font-size:0.97rem; color:#555;">${a.commentaire ? a.commentaire : ''}</div>
                        </div>
                    `).join('');
                } else {
                    avisHtml += '<div style="color:#888; text-align:center;">Aucun avis pour ce produit.</div>';
                }
                avisHtml += `</div><div id="avisFormContainer"></div></div>`;
                document.getElementById('modalProductAvis').innerHTML = avisHtml;

                // Affichage du formulaire d'avis au clic
                if (data.isAuth) {
                    const showAvisFormBtn = document.getElementById('showAvisFormBtn');
                    if (showAvisFormBtn) {
                        showAvisFormBtn.onclick = function() { showAvisForm(data.id); };
                    }
                }
            });
    }

    // Fermer la modale
    document.querySelector('.close-modal').onclick = function() {
        document.getElementById('productModal').style.display = 'none';
    };
    window.onclick = function(event) {
        const modal = document.getElementById('productModal');
        if (event.target === modal) modal.style.display = 'none';
    };

    // Ajouter au panier dynamiquement
    function addToCart(produitId, btn) {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ...';
        btn.disabled = true;
        fetch('{{ route("client.panier.ajouter") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' },
            body: new URLSearchParams({ produit_id: produitId })
        }).then(() => {
            btn.innerHTML = '<i class="fas fa-check"></i> Ajouté !';
            updateCartCount(1);
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-shopping-cart"></i> Ajouter au panier';
                btn.disabled = false;
            }, 1500);
        });
    }

    // Ajouter/retirer des favoris dynamiquement
    function toggleWishlist(produitId, btn) {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ...';
        btn.disabled = true;
        const url = btn.textContent.includes('Retirer') ? `/wishlist/${produitId}` : '{{ route("wishlist.add") }}';
        const method = btn.textContent.includes('Retirer') ? 'DELETE' : 'POST';
        fetch(url, {
            method: method,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' },
            body: method === 'POST' ? new URLSearchParams({ produit_id: produitId }) : null
        }).then(() => {
            btn.innerHTML = btn.textContent.includes('Retirer') ? '<i class="far fa-heart"></i> Ajouter aux favoris' : '<i class="fas fa-heart"></i> Retirer des favoris';
            btn.disabled = false;
        });
    }

    // Afficher le formulaire d'avis
    function showAvisForm(produitId) {
        document.getElementById('avisFormContainer').innerHTML = `
            <form id="avisForm" style="margin-top:1rem; background:#f8f9fa; border-radius:8px; padding:1rem;">
                <div style="margin-bottom:0.7rem;">
                    <label style="font-weight:500;">Note :</label>
                    <span id="starRating">
                        ${[1,2,3,4,5].map(i => `<i class=\"fa-star fa far\" data-value=\"${i}\" style=\"color:#ff9800; cursor:pointer; font-size:1.3rem;\"></i>`).join('')}
                    </span>
                    <input type="hidden" name="note" value="3">
                </div>
                <div style="margin-bottom:0.7rem;">
                    <textarea name="commentaire" placeholder="Votre commentaire (facultatif)" style="width:100%; border-radius:8px; padding:0.5rem; border:1px solid #ddd;"></textarea>
                </div>
                <button type="submit" class="btn-details" style="width:100%;" id="envoyerAvisBtn">Envoyer</button>
            </form>
        `;
        // Gestion étoiles
        let currentNote = 3;
        const stars = document.querySelectorAll('#starRating .fa-star');
        stars.forEach((star, idx) => {
            if(idx < currentNote) star.classList.replace('far','fas');
            star.onclick = function() {
                currentNote = parseInt(this.dataset.value);
                document.querySelector('input[name="note"]').value = currentNote;
                stars.forEach((s, i) => {
                    s.className = i < currentNote ? 'fa-star fas' : 'fa-star far';
                    s.style.color = '#ff9800';
                });
            };
        });
        // Soumission AJAX
        document.getElementById('avisForm').onsubmit = function(e) {
            e.preventDefault();
            const envoyerBtn = document.getElementById('envoyerAvisBtn');
            envoyerBtn.disabled = true;
            envoyerBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ...';
            const formData = new FormData(this);
            fetch(`/produits/${produitId}/avis`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            })
            .then(async res => {
                if (res.status === 403) {
                    const data = await res.json();
                    showToast(data.error || 'Vous avez déjà noté ce produit.', 'error');
                    envoyerBtn.disabled = false;
                    envoyerBtn.innerHTML = 'Envoyer';
                    return;
                }
                return res.json();
            })
            .then(data => {
                if (data && data.success) {
                    showToast('Merci pour votre avis !', 'success');
                    openProductModal(produitId); // Recharge les avis
                } else if (!data) {
                    // Erreur déjà gérée
                } else {
                    envoyerBtn.disabled = false;
                    envoyerBtn.innerHTML = 'Envoyer';
                }
            })
            .catch(() => {
                envoyerBtn.disabled = false;
                envoyerBtn.innerHTML = 'Envoyer';
                showToast('Erreur lors de l\'envoi de l\'avis', 'error');
            });
        };
    }
    </script>
</body>
</html>