<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producteur->nom_entreprise }} - Marché Local</title>
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
        
        /* Producer Profile Header */
        .producer-profile-header {
            background: var(--gradient-primary);
            color: white;
            padding: 80px 0 60px;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }
        
        .producer-profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80') center/cover;
            opacity: 0.1;
        }
        
        .producer-profile-header .container {
            position: relative;
            z-index: 2;
        }
        
        .producer-avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 3rem;
            border: 4px solid rgba(255,255,255,0.3);
        }
        
        .producer-name-large {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .producer-location-large {
            font-size: 1.1rem;
            opacity: 0.9;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .btn-light {
            background: rgba(255,255,255,0.9);
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 30px;
            color: var(--primary);
        }
        
        .btn-light:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        /* Producer Info Section */
        .producer-info-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
        }
        
        .info-section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .info-section-title i {
            margin-right: 10px;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: var(--light-green);
            border-radius: 12px;
            transition: all 0.3s;
        }
        
        .contact-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }
        
        .contact-item i {
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .contact-details h5 {
            margin: 0;
            font-size: 1rem;
            color: var(--dark);
        }
        
        .contact-details p {
            margin: 0;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Products Section */
        .products-section {
            margin-bottom: 60px;
        }
        
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .product-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s;
        }
        
        .product-card:hover .product-img {
            transform: scale(1.05);
        }
        
        .product-body {
            padding: 20px;
        }
        
        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }
        
        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .product-description {
            color: var(--gray);
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .product-stock {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: var(--light-green);
            border-radius: 8px;
        }
        
        .stock-info {
            font-size: 0.9rem;
            color: var(--primary);
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 25px;
            width: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.3);
        }
        
        /* Stats Section */
        .stats-section {
            background: var(--light-green);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            display: block;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
            margin-top: 5px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .producer-name-large {
                font-size: 2rem;
            }
            
            .contact-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .contact-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('accueil') }}">
                <i class="fas fa-leaf"></i>Marché Local
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('accueil') }}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('producteurs.liste') }}">Producteurs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Tableau de bord</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Connexion</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i> Inscription</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Producer Profile Header -->
    <section class="producer-profile-header">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="producer-avatar-large">
                        <i class="fas fa-user"></i>
                    </div>
                    <h1 class="producer-name-large">{{ $producteur->nom_entreprise }}</h1>
                    <p class="producer-location-large">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ $producteur->adresse }}
                    </p>
                    <div class="contact-buttons">
                        <a href="tel:{{ $producteur->telephone }}" class="btn btn-light">
                            <i class="fas fa-phone me-2"></i>Appeler
                        </a>
                        @if($producteur->email)
                            <a href="mailto:{{ $producteur->email }}" class="btn btn-light">
                                <i class="fas fa-envelope me-2"></i>Email
                            </a>
                        @endif
                        <a href="{{ route('producteurs.liste') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Producer Information -->
    <section class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="producer-info-card">
                    <h2 class="info-section-title">
                        <i class="fas fa-info-circle"></i>À propos
                    </h2>
                    <p class="lead">{{ $producteur->description }}</p>
                </div>

                <!-- Products Section -->
                <div class="products-section">
                    <h2 class="info-section-title">
                        <i class="fas fa-box"></i>Produits disponibles
                    </h2>
                    
                    @if($producteur->produits->count() > 0)
                        <div class="row g-4">
                            @foreach($producteur->produits as $produit)
                                <div class="col-md-6 col-lg-4">
                                    <div class="product-card">
                                        <img src="{{ $produit->image_url ?? 'https://via.placeholder.com/400x200?text=Produit' }}" 
                                             class="product-img" alt="{{ $produit->nom }}">
                                        <div class="product-body">
                                            <h5 class="product-title">{{ $produit->nom }}</h5>
                                            <div class="product-price">{{ number_format($produit->prix, 2) }} TND</div>
                                            <p class="product-description">{{ Str::limit($produit->description, 80) }}</p>
                                            
                                            <div class="product-stock">
                                                <span class="stock-info">
                                                    <i class="fas fa-box me-1"></i>
                                                    Stock: {{ $produit->quantite }} {{ $produit->unite }}
                                                </span>
                                                @if($produit->disponible && $produit->quantite > 0)
                                                    <span class="badge bg-success">Disponible</span>
                                                @else
                                                    <span class="badge bg-danger">Rupture</span>
                                                @endif
                                            </div>
                                            
                                            @if($produit->disponible && $produit->quantite > 0)
                                                <button class="btn btn-primary" onclick="addToCart({{ $produit->id }})">
                                                    <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                                                </button>
                                            @else
                                                <button class="btn btn-secondary" disabled>
                                                    <i class="fas fa-times me-2"></i>Indisponible
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Aucun produit disponible</h4>
                            <p class="text-muted">Ce producteur n'a pas encore ajouté de produits.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Contact Information -->
                <div class="producer-info-card">
                    <h2 class="info-section-title">
                        <i class="fas fa-address-book"></i>Contact
                    </h2>
                    
                    <div class="contact-grid">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div class="contact-details">
                                <h5>Téléphone</h5>
                                <p>{{ $producteur->telephone }}</p>
                            </div>
                        </div>
                        
                        @if($producteur->email)
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div class="contact-details">
                                    <h5>Email</h5>
                                    <p>{{ $producteur->email }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="contact-details">
                                <h5>Adresse</h5>
                                <p>{{ $producteur->adresse }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="tel:{{ $producteur->telephone }}" class="btn btn-primary">
                            <i class="fas fa-phone me-2"></i>Appeler maintenant
                        </a>
                        @if($producteur->email)
                            <a href="mailto:{{ $producteur->email }}" class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-2"></i>Envoyer un email
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Statistics -->
                <div class="stats-section">
                    <h2 class="info-section-title">
                        <i class="fas fa-chart-bar"></i>Statistiques
                    </h2>
                    
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">{{ $producteur->produits->count() }}</span>
                            <span class="stat-label">Produits</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $producteur->produits->where('disponible', true)->count() }}</span>
                            <span class="stat-label">Disponibles</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $producteur->produits->where('quantite', '>', 0)->count() }}</span>
                            <span class="stat-label">En stock</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $producteur->produits->avg('prix') ? number_format($producteur->produits->avg('prix'), 1) : '0' }}</span>
                            <span class="stat-label">Prix moyen</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-leaf me-2"></i>Marché Local</h5>
                    <p>Plateforme de mise en relation directe entre producteurs locaux et consommateurs.</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('accueil') }}" class="text-light">Accueil</a></li>
                        <li><a href="{{ route('producteurs.liste') }}" class="text-light">Producteurs</a></li>
                        <li><a href="#" class="text-light">À propos</a></li>
                        <li><a href="#" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Contact</h5>
                    <p><i class="fas fa-envelope me-2"></i>contact@marchelocal.tn</p>
                    <p><i class="fas fa-phone me-2"></i>+216 12 345 678</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2025 Marché Local. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function addToCart(produitId) {
            // Fonction pour ajouter au panier (à implémenter selon votre logique)
            alert('Fonctionnalité d\'ajout au panier à implémenter pour le produit ID: ' + produitId);
        }
    </script>
</body>
</html> 