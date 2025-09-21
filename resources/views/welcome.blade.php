@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marché Local - Produits frais des producteurs locaux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #60ad64;
            --primary-dark: #1b5e20;
            --secondary: #ff9800;
            --secondary-light: #ffb74d;
            --secondary-dark: #f57c00;
            --light: #f8f9fa;
            --light-green: #e8f5e9;
            --dark: #212121;
            --gray-light: #f5f5f5;
            --gray: #6c757d;
            --gradient-primary: linear-gradient(135deg, var(--primary), var(--primary-dark));
            --gradient-secondary: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            --shadow-sm: 0 5px 15px rgba(0,0,0,0.06);
            --shadow-md: 0 8px 25px rgba(0,0,0,0.1);
            --shadow-lg: 0 12px 35px rgba(0,0,0,0.15);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark);
            background-color: #f9f9f9;
            padding-top: 80px;
            overflow-x: hidden;
        }
        
        /* Navigation */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 12px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            letter-spacing: -0.5px;
        }
        
        .navbar-brand i {
            color: var(--primary);
            margin-right: 12px;
            font-size: 1.8rem;
        }
        
        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            color: var(--dark);
            padding: 10px 18px !important;
            border-radius: 30px;
            margin: 0 5px;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(46, 125, 50, 0.1);
            color: var(--primary);
        }
        
        /* Boutons */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            padding: 12px 32px;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 30px;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-primary:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transition: all 0.5s;
            z-index: -1;
        }
        
        .btn-primary:hover:before {
            width: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(46, 125, 50, 0.3);
        }
        
        .btn-secondary {
            background: var(--gradient-secondary);
            border: none;
            padding: 12px 32px;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 30px;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-secondary:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary-dark), var(--secondary));
            transition: all 0.5s;
            z-index: -1;
        }
        
        .btn-secondary:hover:before {
            width: 100%;
        }
        
        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 152, 0, 0.3);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(105deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), 
                        url('https://justaplate.com/wp-content/uploads/2022/06/fruits_anD_vegetables_carrots_pepper_tomato_broccoli_pumpkin-1024x683.jpg') center/cover no-repeat;
            color: white;
            padding: 180px 0 140px;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        
        .hero-content {
            max-width: 750px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .hero-content h1 {
            font-weight: 800;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            line-height: 1.2;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }
        
        .hero-content p {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 35px;
            line-height: 1.6;
        }
        
        /* Sections */
        .section {
            padding: 100px 0;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 50px;
            text-align: center;
            font-weight: 800;
            color: var(--primary);
            font-size: 2.5rem;
            letter-spacing: -0.5px;
        }
        
        .section-title:after {
            content: "";
            position: absolute;
            width: 120px;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
        }
        
        .section-subtitle {
            text-align: center;
            font-size: 1.25rem;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto 60px;
            line-height: 1.7;
        }
        
        /* Category Gallery */
        .category-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 25px;
            margin-bottom: 60px;
        }
        
        .category-card {
            background: white;
            border-radius: 16px;
            padding: 25px 15px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            cursor: pointer;
            border: 1px solid rgba(46, 125, 50, 0.1);
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
            border-color: rgba(46, 125, 50, 0.3);
        }
        
        .category-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.1), rgba(76, 175, 80, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: var(--primary);
            transition: all 0.3s;
        }
        
        .category-card:hover .category-icon {
            background: var(--gradient-primary);
            color: white;
            transform: scale(1.1);
        }
        
        .category-name {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 5px;
            font-size: 1.1rem;
        }
        
        .product-count {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        /* Product Card */
        .product-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            height: 100%;
            background: white;
            position: relative;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .product-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s;
        }
        
        .product-card:hover .product-img {
            transform: scale(1.05);
        }
        
        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent 60%);
            opacity: 0;
            transition: opacity 0.4s;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            z-index: 2;
        }
        
        .product-card:hover .product-overlay {
            opacity: 1;
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
            font-size: 0.85rem;
            padding: 6px 15px;
            border-radius: 30px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .product-body {
            padding: 20px;
            position: relative;
            z-index: 1;
            background: white;
        }
        
        .producer-badge {
            background-color: rgba(46, 125, 50, 0.1);
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.85rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .producer-badge i {
            margin-right: 5px;
        }
        
        /* Features */
        .feature-box {
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            height: 100%;
            background-color: white;
            text-align: center;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 25px;
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.1), rgba(76, 175, 80, 0.1));
            transition: all 0.3s;
        }
        
        .feature-box:hover .feature-icon {
            background: var(--gradient-primary);
            color: white;
            transform: scale(1.1);
        }
        
        /* Stats Section */
        .stats-section {
            background: var(--gradient-primary);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 15%, 100% 0, 100% 85%, 0 100%);
            margin: 100px 0;
        }
        
        .stat-box {
            text-align: center;
            padding: 30px;
            position: relative;
            z-index: 2;
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(to right, white, var(--light-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-label {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        /* How It Works */
        .how-it-works {
            position: relative;
            overflow: hidden;
        }
        
        .step-card {
            text-align: center;
            padding: 40px 25px;
            border-radius: 16px;
            background-color: white;
            box-shadow: var(--shadow-sm);
            position: relative;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.4s;
        }
        
        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .step-number {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.3rem;
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
        }
        
        .step-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .step-card:hover .step-icon {
            color: var(--secondary);
            transform: scale(1.1);
        }
        
        /* Testimonials */
        .testimonial-card {
            padding: 35px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            background-color: white;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.4s;
            position: relative;
        }
        
        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .testimonial-card:before {
            content: """;
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 5rem;
            color: rgba(46, 125, 50, 0.1);
            font-family: Georgia, serif;
            line-height: 1;
        }
        
        .testimonial-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Newsletter */
        .newsletter-section {
            background: var(--gradient-primary);
            color: white;
            padding: 80px 0;
            border-radius: 20px;
            margin: 100px 0;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }
        
        .newsletter-section:before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(to bottom, #1a3c1e, var(--dark));
            color: white;
            padding: 100px 0 40px;
            clip-path: polygon(0 5%, 100% 0, 100% 100%, 0 100%);
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 12px;
            transition: all 0.3s;
            font-size: 1.05rem;
        }
        
        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }
        
        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            transition: all 0.3s;
            font-size: 1.2rem;
        }
        
        .social-icon:hover {
            background-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animated {
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
        }
        
        .delay-1 {
            animation-delay: 0.1s;
        }
        
        .delay-2 {
            animation-delay: 0.2s;
        }
        
        .delay-3 {
            animation-delay: 0.3s;
        }
        
        /* Cart */
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #e53935;
            color: white;
            border-radius: 50%;
            min-width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(229, 57, 53, 0.4);
            border: 2px solid white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }
        
        .cart-badge.empty {
            background-color: #6c757d;
            box-shadow: 0 2px 8px rgba(108, 117, 125, 0.4);
        }
        
        .cart-icon {
            transition: all 0.3s ease;
            color: var(--primary);
        }
        
        .cart-icon:hover {
            transform: scale(1.1);
            color: var(--primary-dark);
        }
        
        .cart-container {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 8px 12px;
            border-radius: 8px;
        }
        
        .cart-container:hover {
            background-color: rgba(46, 125, 50, 0.1);
            transform: translateY(-2px);
        }
        
        .cart-container:hover .cart-badge {
            transform: scale(1.1);
        }
        
        .cart-container.pulse {
            animation: cartPulse 0.6s ease-in-out;
        }
        
        @keyframes cartPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        .cart-container.active .cart-icon {
            color: #e53935;
            font-weight: bold;
            transform: scale(1.15);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.4rem;
            }
            
            .hero-section {
                padding: 140px 0 100px;
            }
            
            .section {
                padding: 80px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-leaf"></i>Marché Local
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('accueil') }}">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('producteurs.liste') }}">Producteurs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">À propos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3">
                    <a href="{{ route('client.panier') }}" class="nav-link cart-container" title="Voir mon panier">
                        <i class="fas fa-cart-plus fs-5 cart-icon"></i>
                        <span class="cart-badge" id="cartCount" aria-label="Nombre d'articles dans le panier">0</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i> Compte
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2"></i> Connexion</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus me-2"></i> Inscription</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Tableau de bord</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content animated">
                <h1 class="display-4 fw-bold mb-4">Des produits locaux, frais et sans intermédiaires</h1>
                <p class="lead mb-5">Découvrez les meilleurs produits de votre région directement auprès des producteurs. Fraîcheur garantie, circuit court et agriculture responsable.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="#products" class="btn btn-primary btn-lg">Découvrir les produits</a>
                    <a href="#inscription" class="btn btn-outline-light btn-lg">Devenir producteur</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Produits -->
    <section class="container" id="products">
        <div class="text-center mb-5">
            <h2 class="section-title">Nouveaux produits</h2>
            <p class="section-subtitle">Découvrez les derniers produits ajoutés</p>
        </div>
        <div class="row g-4">
            @foreach($nouveauxProduits as $produit)
                @php
                    $image = $produit->image_url;
                    if (!$image) {
                        $image = 'https://tse1.mm.bing.net/th/id/OIP.W8MfORr0e7vew_TvLXCxNQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3';
                    } elseif (!Str::startsWith($image, ['http://', 'https://'])) {
                        $image = asset($image);
                    }
                @endphp
                <div class="col-md-4 col-lg-3">
                    <div class="product-card">
                        <div class="position-relative">
                            <img src="{{ $image }}" class="product-img" alt="{{ $produit->nom }}">
                            <span class="product-badge bg-success">{{ $produit->categorie ?? 'Produit' }}</span>
                            <div class="product-overlay">
                                <div class="text-white">
                                    <h5 class="mb-1">{{ $produit->nom }}</h5>
                                    <p class="mb-0">{{ $produit->producteur->nom ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="product-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="mb-0">{{ $produit->nom }}</h5>
                                <span class="fw-bold text-success">{{ number_format($produit->prix, 2) }} TND</span>
                            </div>
                            <div class="mb-2">
                                <span class="producer-badge">
                                    <i class="fas fa-user"></i> {{ $produit->producteur->nom ?? '' }}
                                </span>
                            </div>
                            <p class="mb-3 small">{{ $produit->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('client.produits.show', $produit->id) }}" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-info-circle me-1"></i> Détails
                                </a>
                                <form action="{{ route('client.panier.ajouter') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-cart-plus me-1"></i> Ajouter
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Features Section -->
    <section class="container section">
        <div class="text-center mb-5">
            <h2 class="section-title">Pourquoi choisir Marché Local ?</h2>
            <p class="section-subtitle">Notre plateforme offre des avantages uniques pour tous</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 animated">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3>Circuit court</h3>
                    <p>Des produits frais directement du producteur au consommateur, sans intermédiaires ni stockage prolongé.</p>
                </div>
            </div>
            
            <div class="col-md-4 animated delay-1">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Agriculture responsable</h3>
                    <p>Nous privilégions les producteurs engagés dans une agriculture durable et respectueuse de l'environnement.</p>
                </div>
            </div>
            
            <div class="col-md-4 animated delay-2">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3>Rémunération équitable</h3>
                    <p>Les producteurs reçoivent une rémunération juste pour leur travail, sans marges excessives des distributeurs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 animated">
                    <div class="stat-box">
                        <div class="stat-number" id="producersCount">{{ $stats['producteurs'] }}</div>
                        <div class="stat-label">Producteurs locaux</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 animated delay-1">
                    <div class="stat-box">
                        <div class="stat-number" id="productsCount">{{ $stats['produits'] }}</div>
                        <div class="stat-label">Produits disponibles</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 animated delay-2">
                    <div class="stat-box">
                        <div class="stat-number" id="customersCount">{{ $stats['clients'] }}</div>
                        <div class="stat-label">Clients satisfaits</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 animated delay-3">
                    <div class="stat-box">
                        <div class="stat-number" id="ordersCount">{{ $stats['commandes'] }}</div>
                        <div class="stat-label">Commandes passées</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="container section how-it-works">
        <div class="text-center mb-5">
            <h2 class="section-title">Comment ça marche ?</h2>
            <p class="section-subtitle">Trois étapes simples pour profiter des produits locaux</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 animated">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="mb-3">
                        <i class="fas fa-search fa-3x text-primary step-icon"></i>
                    </div>
                    <h4>Découvrez</h4>
                    <p>Parcourez notre catalogue de produits frais et de saison, directement issus des fermes locales.</p>
                </div>
            </div>
            
            <div class="col-md-4 animated delay-1">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="mb-3">
                        <i class="fas fa-shopping-cart fa-3x text-primary step-icon"></i>
                    </div>
                    <h4>Commandez</h4>
                    <p>Sélectionnez vos produits préférés et passez commande en quelques clics. Livraison ou retrait à la ferme.</p>
                </div>
            </div>
            
            <div class="col-md-4 animated delay-2">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="mb-3">
                        <i class="fas fa-utensils fa-3x text-primary step-icon"></i>
                    </div>
                    <h4>Savourez</h4>
                    <p>Recevez vos produits frais et profitez de saveurs authentiques tout en soutenant l'économie locale.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="container section">
        <div class="text-center mb-5">
            <h2 class="section-title">Ils nous font confiance</h2>
            <p class="section-subtitle">Découvrez ce que nos clients et producteurs disent de nous</p>
        </div>
        <div class="row g-4">
            @foreach($avis->take(3) as $avisItem)
                <div class="col-md-4 animated">
                    <div class="testimonial-card text-center">
                        <!--<img src="https://randomuser.me/api/portraits/men/{{ $avisItem->user->id % 100 }}.jpg" alt="{{ $avisItem->user->name }}" class="testimonial-img">-->
                        <div class="mb-3 text-warning">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $avisItem->note)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <blockquote class="fst-italic mb-4">"{{ $avisItem->commentaire }}"</blockquote>
                        <h5>{{ $avisItem->user->name }}</h5>
                        <p class="text-muted mb-0">
                            @if($avisItem->user->isProducteur())
                                Producteur
                            @else
                                Client
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="container">
        <div class="newsletter-section">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                    <h3 class="mb-3">Restez informés</h3>
                    <p class="mb-0">Recevez nos actualités, les arrivages de saison et les offres spéciales</p>
                </div>
                <div class="col-lg-6">
                    <form class="newsletter-form d-flex">
                        <input type="email" class="form-control" placeholder="Votre email" required>
                        <button class="btn btn-light" type="submit">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Become Producer Section -->
    <section id="inscription" class="container section">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 animated">
                <div class="rounded-3 overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Producteur" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5 animated delay-1">
                <h2 class="mb-4">Vous êtes producteur local ?</h2>
                <p class="lead mb-4">Rejoignez notre communauté et vendez vos produits directement aux consommateurs</p>
                
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <div><strong>Gagnez plus</strong> en supprimant les intermédiaires</div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <div><strong>Fidélisez</strong> vos clients grâce à une relation directe</div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <div><strong>Valorisez</strong> votre travail et vos méthodes de production</div>
                    </li>
                    <li class="mb-4 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <div><strong>Développez</strong> votre activité avec une plateforme simple et efficace</div>
                    </li>
                </ul>
                
                <a href="#" class="btn btn-secondary btn-lg">
                    <i class="fas fa-user-plus me-2"></i> Devenir producteur
                </a>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h3 class="mb-4">
                    <i class="fas fa-leaf me-2"></i>Marché Local
                </h3>
                <p class="mb-4">Plateforme de mise en relation directe entre producteurs locaux et consommateurs. Fraîcheur garantie, circuit court et agriculture responsable.</p>
                <div class="d-flex">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-5 mb-md-0">
                <h4 class="mb-4">Liens rapides</h4>
                <div class="footer-links">
                    <a href="#">Accueil</a>
                    <a href="#">Produits</a>
                    <a href="#">Producteurs</a>
                    <a href="#">À propos</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-5 mb-md-0">
                <h4 class="mb-4">Catégories</h4>
                <div class="footer-links">
                    <a href="#">Fruits & Légumes</a>
                    <a href="#">Huile d'olive</a>
                    <a href="#">Miel & Produits</a>
                    <a href="#">Produits laitiers</a>
                    <a href="#">Herbes & Épices</a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4">
                <h4 class="mb-4">Contact</h4>
                <ul class="list-unstyled">
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        12 Avenue de la Liberté, Tunis, Tunisie
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-phone me-2"></i>
                        +216 12 345 678
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-envelope me-2"></i>
                        contact@marchelocal.tn
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="my-5 border-light">
        
        <div class="text-center">
            <p class="mb-0">&copy; 2025 Marché Local. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/stats-manager.js') }}"></script>
<script>
            // Animation for stats
        document.addEventListener('DOMContentLoaded', function() {
            // Vérifier si les statistiques ont été mises à jour
            @if(session('stats_updated'))
                // Déclencher la mise à jour des statistiques
                setTimeout(() => {
                    if (window.statsManager) {
                        window.statsManager.forceUpdate();
                    }
                }, 1000);
            @endif

            // Récupérer le nombre réel d'articles dans le panier
            function updateCartCount() {
                fetch('{{ route("client.panier.count") }}')
                    .then(response => response.json())
                    .then(data => {
                        const cartBadge = document.getElementById('cartCount');
                        const cartContainer = document.querySelector('.cart-container');
                        if (data.count > 0) {
                            cartBadge.classList.remove('empty');
                            cartBadge.style.display = 'flex';
                            cartContainer.classList.add('active');
                        } else {
                            cartBadge.classList.add('empty');
                            cartBadge.style.display = 'none';
                            cartContainer.classList.remove('active');
                        }
                        updateCartCount();
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération du nombre d\'articles:', error);
                        const cartBadge = document.getElementById('cartCount');
                        const cartContainer = document.querySelector('.cart-container');
                        cartBadge.textContent = '0';
                        cartBadge.classList.add('empty');
                        cartBadge.style.display = 'none';
                        cartContainer.classList.remove('active');
                    });
            }

            // Mettre à jour le compteur au chargement de la page
            updateCartCount();
            
            // Rafraîchir le compteur toutes les 30 secondes
            setInterval(updateCartCount, 30000);

            // Stats counter animation
            const stats = [
                { id: 'producersCount', target: {{ $stats['producteurs'] }} },
                { id: 'productsCount', target: {{ $stats['produits'] }} },
                { id: 'customersCount', target: {{ $stats['clients'] }} },
                { id: 'ordersCount', target: {{ $stats['commandes'] }} }
            ];
        
        stats.forEach(stat => {
            const element = document.getElementById(stat.id);
            let count = 0;
            const increment = stat.target / 50;
            
            const timer = setInterval(() => {
                count += increment;
                if (count >= stat.target) {
                    count = stat.target;
                    clearInterval(timer);
                }
                element.textContent = Math.round(count);
            }, 30);
        });
        
        // Category selection
        const categoryCards = document.querySelectorAll('.category-card');
        categoryCards.forEach(card => {
            card.addEventListener('click', function() {
                categoryCards.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                
                // In a real application, this would filter products by category
                alert(`Catégorie sélectionnée : ${this.querySelector('.category-name').textContent}`);
            });
        });
        
        // Add to cart buttons
        const addToCartForms = document.querySelectorAll('form[action*="panier/ajouter"]');
        let cartCount = 3;
        
        addToCartForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const button = this.querySelector('button[type="submit"]');
                const productName = this.closest('.product-card').querySelector('h5').textContent;
                
                // Animation effect
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Ajout...';
                button.disabled = true;
                
                // Submit form via AJAX
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(new FormData(this))
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Réponse AJAX ajout panier:', data);
                    if (data.success) {
                        // Update cart count
                        const cartBadge = document.getElementById('cartCount');
                        const cartContainer = document.querySelector('.cart-container');
                        if (data.cart_count > 0) {
                            cartBadge.classList.remove('empty');
                            cartBadge.style.display = 'flex';
                            cartContainer.classList.add('active');
                        } else {
                            cartBadge.classList.add('empty');
                            cartBadge.style.display = 'none';
                            cartContainer.classList.remove('active');
                        }
                        updateCartCount();
                        // Success animation
                        button.innerHTML = '<i class="fas fa-check me-1"></i> Ajouté';
                        button.classList.add('btn-primary');
                        button.classList.remove('btn-success');
                        // Animation de l'icône panier
                        const cartContainer = document.querySelector('.cart-container');
                        cartContainer.classList.add('pulse');
                        setTimeout(() => {
                            cartContainer.classList.remove('pulse');
                        }, 600);
                        // Notification
                        showNotification(`${productName} ajouté au panier!`);
                        // Reset button after animation
                        setTimeout(() => {
                            button.innerHTML = '<i class=\'fas fa-cart-plus me-1\'></i> Ajouter';
                            button.classList.remove('btn-primary');
                            button.classList.add('btn-success');
                            button.disabled = false;
                        }, 1500);
                    } else {
                        // Error handling
                        button.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i> Erreur';
                        button.classList.add('btn-danger');
                        button.classList.remove('btn-success');
                        
                        showNotification(data.message || 'Erreur lors de l\'ajout au panier', 'error');
                        
                        setTimeout(() => {
                            button.innerHTML = '<i class="fas fa-cart-plus me-1"></i> Ajouter';
                            button.classList.remove('btn-danger');
                            button.classList.add('btn-success');
                            button.disabled = false;
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    button.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i> Erreur';
                    button.classList.add('btn-danger');
                    button.classList.remove('btn-success');
                    
                    showNotification('Erreur lors de l\'ajout au panier', 'error');
                    
                    setTimeout(() => {
                        button.innerHTML = '<i class="fas fa-cart-plus me-1"></i> Ajouter';
                        button.classList.remove('btn-danger');
                        button.classList.add('btn-success');
                        button.disabled = false;
                    }, 2000);
                });
            });
        });
        
        // Show notification function
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = 'position-fixed bottom-0 end-0 p-3';
            notification.style.zIndex = '1100';
            
            const bgColor = type === 'success' ? 'bg-success' : 'bg-danger';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
            
            notification.innerHTML = `
                <div class="toast show" role="alert">
                    <div class="toast-header ${bgColor} text-white">
                        <strong class="me-auto">
                            <i class="fas ${icon} me-2"></i>Marché Local
                        </strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        
        // Animation on scroll
        const observerOptions = {
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animated').forEach(el => {
            observer.observe(el);
        });
    });
</script>
</body>
</html>