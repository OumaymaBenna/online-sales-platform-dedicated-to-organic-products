<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Producteurs - Marché Local</title>
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
        
        /* Header Section */
        .page-header {
            background: var(--gradient-primary);
            color: white;
            padding: 80px 0 60px;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80') center/cover;
            opacity: 0.1;
        }
        
        .page-header .container {
            position: relative;
            z-index: 2;
        }
        
        .page-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
        }
        
        /* Producer Card */
        .producer-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .producer-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .producer-header {
            background: var(--gradient-primary);
            color: white;
            padding: 30px 25px;
            text-align: center;
            position: relative;
        }
        
        .producer-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 2rem;
            border: 3px solid rgba(255,255,255,0.3);
        }
        
        .producer-name {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .producer-location {
            font-size: 0.95rem;
            opacity: 0.9;
        }
        
        .producer-body {
            padding: 25px;
        }
        
        .producer-description {
            color: var(--gray);
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .contact-info {
            margin-bottom: 20px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            color: var(--dark);
        }
        
        .contact-item i {
            width: 20px;
            margin-right: 12px;
            color: var(--primary);
        }
        
        .stats-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px 0;
            border-top: 1px solid var(--gray-light);
            border-bottom: 1px solid var(--gray-light);
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: block;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 30px;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.3);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 30px;
            letter-spacing: 0.5px;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Search and Filter */
        .search-section {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: var(--shadow-sm);
        }
        
        .search-input {
            border: 2px solid var(--gray-light);
            border-radius: 30px;
            padding: 12px 20px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
        }
        
        /* Pagination */
        .pagination .page-link {
            color: var(--primary);
            border: 1px solid var(--gray-light);
            margin: 0 2px;
            border-radius: 8px;
        }
        
        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }
            
            .producer-header {
                padding: 20px 15px;
            }
            
            .producer-body {
                padding: 20px 15px;
            }
            
            .stats-row {
                flex-direction: column;
                gap: 15px;
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

    <!-- Header Section -->
    <section class="page-header">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="page-title">Nos Producteurs Locaux</h1>
                    <p class="page-subtitle">Découvrez les producteurs passionnés qui vous fournissent des produits frais et de qualité. Contactez-les directement pour vos commandes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="container">
        <div class="search-section">
            <form method="GET" action="{{ route('producteurs.liste') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control search-input" placeholder="Rechercher un producteur..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Rechercher
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Producers List -->
    <section class="container">
        <div class="row g-4">
            @forelse($producteurs as $producteur)
                <div class="col-lg-4 col-md-6">
                    <div class="producer-card">
                        <div class="producer-header">
                            <div class="producer-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <h3 class="producer-name">{{ $producteur->nom_entreprise }}</h3>
                            <p class="producer-location">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $producteur->adresse }}
                            </p>
                        </div>
                        
                        <div class="producer-body">
                            <p class="producer-description">
                                {{ Str::limit($producteur->description, 120) }}
                            </p>
                            
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>{{ $producteur->telephone }}</span>
                                </div>
                                @if($producteur->email)
                                    <div class="contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $producteur->email }}</span>
                                    </div>
                                @endif
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $producteur->adresse }}</span>
                                </div>
                            </div>
                            
                            <div class="stats-row">
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
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('producteurs.show', $producteur->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye me-2"></i>Voir le profil
                                </a>
                                <a href="tel:{{ $producteur->telephone }}" class="btn btn-outline-primary">
                                    <i class="fas fa-phone me-2"></i>Appeler
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-3x text-muted"></i>
                    </div>
                    <h3 class="text-muted">Aucun producteur trouvé</h3>
                    <p class="text-muted">Essayez de modifier vos critères de recherche.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($producteurs->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $producteurs->links() }}
            </div>
        @endif
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
</body>
</html> 