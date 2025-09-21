<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Marché Local</title>
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
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(105deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1800&q=80') center/cover no-repeat;
            color: white;
            padding: 120px 0 80px;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            max-width: 800px;
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
            padding: 80px 0;
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
        
        /* Story Section */
        .story-section {
            background: white;
            border-radius: 20px;
            padding: 60px;
            margin-bottom: 60px;
            box-shadow: var(--shadow-sm);
        }
        
        .story-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        
        .story-text h3 {
            color: var(--primary);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 25px;
        }
        
        .story-text p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--gray);
            margin-bottom: 20px;
        }
        
        .story-image {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }
        
        .story-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        /* Mission & Values */
        .mission-values {
            background: var(--light-green);
            border-radius: 20px;
            padding: 60px;
            margin-bottom: 60px;
        }
        
        .mission-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            height: 100%;
            transition: all 0.4s ease;
        }
        
        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .mission-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
            color: white;
        }
        
        .mission-card h4 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .mission-card p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Team Section */
        .team-section {
            background: white;
            border-radius: 20px;
            padding: 60px;
            margin-bottom: 60px;
            box-shadow: var(--shadow-sm);
        }
        
        .team-member {
            text-align: center;
            padding: 30px;
            border-radius: 16px;
            transition: all 0.4s ease;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            box-shadow: var(--shadow-sm);
        }
        
        .team-member h4 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .team-member .role {
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .team-member p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Stats Section */
        .stats-section {
            background: var(--gradient-primary);
            color: white;
            padding: 80px 0;
            border-radius: 20px;
            margin-bottom: 60px;
        }
        
        .stat-item {
            text-align: center;
            padding: 30px;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 15px;
            display: block;
        }
        
        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* Values Grid */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }
        
        .value-card {
            background: white;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            border-left: 5px solid var(--primary);
        }
        
        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-md);
        }
        
        .value-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.1), rgba(76, 175, 80, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
            color: var(--primary);
            transition: all 0.3s;
        }
        
        .value-card:hover .value-icon {
            background: var(--gradient-primary);
            color: white;
            transform: scale(1.1);
        }
        
        .value-card h4 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .value-card p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Contact Section */
        .contact-section {
            background: var(--light-green);
            border-radius: 20px;
            padding: 60px;
            text-align: center;
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .contact-item {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: var(--shadow-sm);
        }
        
        .contact-item i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        .contact-item h5 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .contact-item p {
            color: var(--gray);
            margin: 0;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .story-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
        
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.4rem;
            }
            
            .section {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .story-section,
            .mission-values,
            .team-section,
            .contact-section {
                padding: 40px 30px;
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('producteurs.liste') }}">Producteurs</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('about') }}">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Notre Histoire</h1>
                <p>Découvrez l'histoire derrière Marché Local et notre engagement pour une agriculture durable et des circuits courts.</p>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="container">
        <div class="story-section">
            <div class="story-content">
                <div class="story-text">
                    <h3>Comment tout a commencé</h3>
                    <p>Marché Local est né d'une vision simple mais puissante : reconnecter les consommateurs avec les producteurs locaux. En 2025, notre équipe a constaté que de nombreux producteurs talentueux avaient du mal à écouler leurs produits, tandis que les consommateurs cherchaient des produits frais et de qualité.</p>
                    <p>Nous avons créé cette plateforme pour faciliter cette connexion, en supprimant les intermédiaires et en permettant aux producteurs de vendre directement leurs produits aux consommateurs. Notre objectif est de promouvoir une agriculture durable et de soutenir l'économie locale.</p>
                </div>
                <div class="story-image">
                    <img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Histoire Marché Local">
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="container">
        <div class="mission-values">
            <h2 class="section-title">Notre Mission & Nos Valeurs</h2>
            <p class="section-subtitle">Nous nous engageons à promouvoir une agriculture durable et à faciliter l'accès aux produits locaux de qualité.</p>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4>Circuit Court</h4>
                        <p>Nous facilitons la vente directe entre producteurs et consommateurs, éliminant les intermédiaires pour des prix plus justes.</p>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h4>Agriculture Durable</h4>
                        <p>Nous soutenons les pratiques agricoles respectueuses de l'environnement et la biodiversité locale.</p>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4>Communauté</h4>
                        <p>Nous créons des liens entre les producteurs et les consommateurs, renforçant le tissu social local.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Grid -->
    <section class="container">
        <h2 class="section-title">Nos Valeurs Fondamentales</h2>
        <p class="section-subtitle">Ces valeurs guident chacune de nos actions et décisions.</p>
        
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4>Écologie</h4>
                <p>Nous privilégions les producteurs engagés dans des pratiques respectueuses de l'environnement et encourageons la réduction des déchets.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <h4>Équité</h4>
                <p>Nous nous assurons que les producteurs reçoivent une rémunération juste pour leur travail et leurs produits.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4>Transparence</h4>
                <p>Nous encourageons la transparence sur les méthodes de production et l'origine des produits.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h4>Solidarité</h4>
                <p>Nous soutenons les petits producteurs et favorisons l'entraide au sein de la communauté agricole.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h4>Qualité</h4>
                <p>Nous nous engageons à proposer uniquement des produits de qualité, frais et savoureux.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h4>Local</h4>
                <p>Nous privilégions les produits locaux pour réduire l'empreinte carbone et soutenir l'économie régionale.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container">
        <div class="stats-section">

            
            <div class="row text-center">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number" id="producteursCount">{{ $stats['producteurs'] }}</span>
                        <div class="stat-label">Producteurs Locaux</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number" id="produitsCount">{{ $stats['produits'] }}</span>
                        <div class="stat-label">Produits Disponibles</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number" id="clientsCount">{{ $stats['clients'] }}</span>
                        <div class="stat-label">Clients Satisfaits</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number" id="commandesCount">{{ $stats['commandes'] }}</span>
                        <div class="stat-label">Commandes Passées</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number" id="anneeCreation">{{ $stats['annee_creation'] }}</span>
                        <div class="stat-label">Année de Création</div>
                    </div>
                </div>
            </div>
            

        </div>
    </section>



    <!-- Contact Section -->
    <section class="container">
        <div class="contact-section">
            <h2 class="section-title">Contactez-Nous</h2>
            <p class="section-subtitle">Nous sommes là pour vous accompagner dans votre expérience Marché Local.</p>
            
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <h5>Adresse</h5>
                    <p>12 Avenue de la Liberté<br>Tunis, Tunisie</p>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <h5>Téléphone</h5>
                    <p>+216 12 345 678</p>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <h5>Email</h5>
                    <p>contact@marchelocal.tn</p>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <h5>Horaires</h5>
                    <p>Lun-Ven: 9h-18h<br>Sam: 9h-13h</p>
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
    <script src="{{ asset('js/stats-manager.js') }}"></script>
    <script>
        // Animation des compteurs de statistiques
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

            const stats = [
                { id: 'producteursCount', target: {{ $stats['producteurs'] }} },
                { id: 'produitsCount', target: {{ $stats['produits'] }} },
                { id: 'clientsCount', target: {{ $stats['clients'] }} },
                { id: 'commandesCount', target: {{ $stats['commandes'] }} },
                { id: 'anneeCreation', target: {{ $stats['annee_creation'] }} }
            ];
            
            // Fonction pour animer un compteur
            function animateCounter(element, target) {
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    element.textContent = Math.round(current);
                }, 30);
            }
            
            // Observer pour déclencher l'animation quand la section est visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        stats.forEach(stat => {
                            const element = document.getElementById(stat.id);
                            if (element) {
                                animateCounter(element, stat.target);
                            }
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            // Observer la section des statistiques
            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }
        });


    </script>
</body>
</html> 