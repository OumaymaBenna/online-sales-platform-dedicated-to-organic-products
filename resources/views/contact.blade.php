<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Marché Local</title>
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
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(105deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1800&q=80') center/cover no-repeat;
            color: white;
            padding: 120px 0 80px;
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
        
        /* Contact Form */
        .contact-form {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 8px;
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            padding: 14px 32px;
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
        
        /* Contact Info */
        .contact-info-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            height: 100%;
        }
        
        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }
        
        .contact-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
            color: white;
            transition: all 0.3s;
        }
        
        .contact-info-card:hover .contact-icon {
            transform: scale(1.1);
        }
        
        /* Map Section */
        .map-section {
            background: var(--light-green);
            padding: 80px 0;
            margin: 80px 0;
            border-radius: 20px;
        }
        
        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            height: 400px;
            background: #e8f5e9;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .map-placeholder {
            text-align: center;
            color: var(--primary);
        }
        
        .map-placeholder i {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        
        /* FAQ Section */
        .faq-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow-sm);
            margin: 40px 0;
        }
        
        .faq-item {
            border-bottom: 1px solid #e9ecef;
            padding: 20px 0;
        }
        
        .faq-item:last-child {
            border-bottom: none;
        }
        
        .faq-question {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 10px;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .faq-question:hover {
            color: var(--primary);
        }
        
        .faq-answer {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Alert Messages */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 16px 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.4rem;
            }
            
            .hero-section {
                padding: 100px 0 60px;
            }
            
            .contact-form {
                padding: 30px 20px;
            }
        }
        
        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
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
                <li class="nav-item"><a class="nav-link" href="{{ route('producteurs.liste') }}">Producteurs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">À propos</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Inscription</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Tableau de bord</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i> Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-decoration-none">
                                        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Contactez-nous</h1>
                <p>Nous sommes là pour vous aider ! Que vous ayez une question, une suggestion ou besoin d'assistance, n'hésitez pas à nous contacter.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form">
                    <h2 class="mb-4 text-center">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        Envoyez-nous un message
                    </h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label">
                                    <i class="fas fa-user me-1"></i> Nom complet *
                                </label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" name="nom" value="{{ old('nom') }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i> Email *
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">
                                    <i class="fas fa-phone me-1"></i> Téléphone
                                </label>
                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                       id="telephone" name="telephone" value="{{ old('telephone') }}" 
                                       placeholder="+216 XX XXX XXX">
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="type_contact" class="form-label">
                                    <i class="fas fa-tag me-1"></i> Type de demande *
                                </label>
                                <select class="form-select @error('type_contact') is-invalid @enderror" 
                                        id="type_contact" name="type_contact" required>
                                    <option value="">Choisir un type</option>
                                    <option value="general" {{ old('type_contact') == 'general' ? 'selected' : '' }}>Question générale</option>
                                    <option value="produit" {{ old('type_contact') == 'produit' ? 'selected' : '' }}>Question sur un produit</option>
                                    <option value="technique" {{ old('type_contact') == 'technique' ? 'selected' : '' }}>Support technique</option>
                                    <option value="partenariat" {{ old('type_contact') == 'partenariat' ? 'selected' : '' }}>Partenariat</option>
                                    <option value="autre" {{ old('type_contact') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('type_contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="sujet" class="form-label">
                                <i class="fas fa-heading me-1"></i> Sujet *
                            </label>
                            <input type="text" class="form-control @error('sujet') is-invalid @enderror" 
                                   id="sujet" name="sujet" value="{{ old('sujet') }}" required>
                            @error('sujet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">
                                <i class="fas fa-comment me-1"></i> Message *
                            </label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="6" required 
                                      placeholder="Décrivez votre demande en détail...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>
                                Envoyer le message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="contact-info-card text-center">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h4>Notre adresse</h4>
                            <p class="mb-0">12 Avenue de la Liberté<br>Tunis, Tunisie</p>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="contact-info-card text-center">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h4>Téléphone</h4>
                            <p class="mb-0">
                                <a href="tel:+21612345678" class="text-decoration-none">+216 12 345 678</a><br>
                                <small class="text-muted">Lun-Ven: 9h-18h</small>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="contact-info-card text-center">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h4>Email</h4>
                            <p class="mb-0">
                                <a href="mailto:contact@marchelocal.tn" class="text-decoration-none">contact@marchelocal.tn</a><br>
                                <small class="text-muted">Réponse sous 24h</small>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="contact-info-card text-center">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h4>Horaires</h4>
                            <p class="mb-0">
                                Lundi - Vendredi: 9h - 18h<br>
                                Samedi: 9h - 13h<br>
                                <small class="text-muted">Dimanche: Fermé</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-4">Trouvez-nous facilement</h2>
                    <p class="lead mb-4">Notre équipe est située au cœur de Tunis, facilement accessible en transport en commun ou en voiture.</p>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-bus text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Transport en commun</h6>
                                    <p class="mb-0 small">Lignes 1, 3, 5 - Arrêt Liberté</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-car text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Parking</h6>
                                    <p class="mb-0 small">Parking gratuit disponible</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="map-container">
                        <div class="map-placeholder">
                            <i class="fas fa-map"></i>
                            <h5>Carte interactive</h5>
                            <p>Intégration Google Maps à venir</p>
                            <a href="https://maps.google.com/?q=12+Avenue+de+la+Liberté+Tunis+Tunisie" 
                               target="_blank" class="btn btn-outline-primary">
                                <i class="fas fa-external-link-alt me-2"></i>
                                Voir sur Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="container">
        <div class="faq-section">
            <h2 class="text-center mb-5">
                <i class="fas fa-question-circle me-2 text-primary"></i>
                Questions fréquentes
            </h2>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="faq-item">
                        <h5 class="faq-question">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Comment passer une commande ?
                        </h5>
                        <p class="faq-answer">
                            Parcourez notre catalogue de produits, ajoutez-les à votre panier et suivez les étapes de commande. Vous pouvez choisir entre livraison à domicile ou retrait chez le producteur.
                        </p>
                    </div>
                    
                    <div class="faq-item">
                        <h5 class="faq-question">
                            <i class="fas fa-truck me-2"></i>
                            Quels sont les délais de livraison ?
                        </h5>
                        <p class="faq-answer">
                            Les délais varient selon le producteur et votre localisation. En général, comptez 1-3 jours ouvrés pour la livraison, et 24h pour le retrait en magasin.
                        </p>
                    </div>
                    
                    <div class="faq-item">
                        <h5 class="faq-question">
                            <i class="fas fa-undo me-2"></i>
                            Comment retourner un produit ?
                        </h5>
                        <p class="faq-answer">
                            Contactez-nous dans les 48h suivant la réception. Nous nous engageons à vous rembourser ou à remplacer tout produit défectueux ou non conforme.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="faq-item">
                        <h5 class="faq-question">
                            <i class="fas fa-user-plus me-2"></i>
                            Comment devenir producteur ?
                        </h5>
                        <p class="faq-answer">
                            Créez un compte producteur, remplissez votre profil et soumettez vos produits. Notre équipe validera votre inscription sous 48h.
                        </p>
                    </div>
                    
                    <div class="faq-item">
                        <h5 class="faq-question">
                            <i class="fas fa-credit-card me-2"></i>
                            Quels moyens de paiement acceptez-vous ?
                        </h5>
                        <p class="faq-answer">
                            Nous acceptons les cartes bancaires, les virements bancaires et le paiement à la livraison pour les commandes locales.
                        </p>
                    </div>
                    
                    <div class="faq-item">
                        <h5 class="faq-question">
                            <i class="fas fa-leaf me-2"></i>
                            Vos produits sont-ils bio ?
                        </h5>
                        <p class="faq-answer">
                            Chaque producteur indique ses méthodes de production. Nous privilégions l'agriculture responsable et durable, avec ou sans certification bio.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5><i class="fas fa-leaf me-2"></i>Marché Local</h5>
                <p>Plateforme de mise en relation directe entre producteurs locaux et consommateurs. Fraîcheur garantie, circuit court et agriculture responsable.</p>
                <div class="d-flex">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4">
                <h4 class="mb-4">Liens rapides</h4>
                <div class="footer-links">
                    <a href="{{ route('accueil') }}" class="text-light">Accueil</a>
                    <a href="{{ route('producteurs.liste') }}" class="text-light">Producteurs</a>
                    <a href="{{ route('about') }}" class="text-light">À propos</a>
                    <a href="{{ route('contact') }}" class="text-light">Contact</a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4">
                <h4 class="mb-4">Catégories</h4>
                <div class="footer-links">
                    <a href="#" class="text-light">Fruits & Légumes</a>
                    <a href="#" class="text-light">Huile d'olive</a>
                    <a href="#" class="text-light">Miel & Produits</a>
                    <a href="#" class="text-light">Produits laitiers</a>
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
<script>
    // Animation pour les cartes de contact
    document.addEventListener('DOMContentLoaded', function() {
        const contactCards = document.querySelectorAll('.contact-info-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });
        
        contactCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
        
        // Validation du formulaire en temps réel
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid') && this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
</script>
</body>
</html> 