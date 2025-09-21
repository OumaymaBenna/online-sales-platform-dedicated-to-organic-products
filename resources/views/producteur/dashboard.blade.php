<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos Produits - Ferme Locale</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary: #f9f5e8;
            --accent: #ff9800;
            --light: #f8f9fa;
            --dark: #2d3748;
            --text: #4a5568;
            --border-radius: 12px;
            --shadow: 0 8px 20px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f5f7fa;
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
        }
        
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .section-title h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }
        
        .section-title p {
            color: var(--text);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .products-section {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }
        
        .section-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f9f9f9;
        }
        
        .section-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .add-product-btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .add-product-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }
        
        .no-products {
            text-align: center;
            padding: 3rem 2rem;
        }
        
        .no-products i {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 1.5rem;
        }
        
        .no-products h4 {
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .no-products p {
            margin-bottom: 2rem;
            color: var(--text);
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }
        
        .product-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: var(--primary-light);
        }
        
        .product-image {
            height: 180px;
            position: relative;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .placeholder-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            background: linear-gradient(45deg, #f5f5f5, #e0e0e0);
            color: #bdbdbd;
            font-size: 3rem;
        }
        
        .category-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .product-content {
            padding: 1.5rem;
        }
        
        .product-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .product-description {
            color: var(--text);
            margin-bottom: 1rem;
            font-size: 0.95rem;
            height: 60px;
            overflow: hidden;
        }
        
        .product-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .product-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .product-stock {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--text);
        }
        
        .product-stock.low {
            color: #e53e3e;
        }
        
        .product-actions {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #e2e8f0;
            padding-top: 1rem;
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .view-btn {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: none;
        }
        
        .view-btn:hover {
            background: rgba(59, 130, 246, 0.2);
        }
        
        .edit-btn {
            background: rgba(101, 163, 13, 0.1);
            color: #65a30d;
            border: none;
        }
        
        .edit-btn:hover {
            background: rgba(101, 163, 13, 0.2);
        }
        
        .delete-btn {
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            border: none;
        }
        
        .delete-btn:hover {
            background: rgba(220, 38, 38, 0.2);
        }
        
        .footer {
            text-align: center;
            padding: 2rem 0;
            color: var(--text);
            font-size: 0.9rem;
            margin-top: 2rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .dashboard-container {
                padding: 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .section-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
        
        @media (max-width: 576px) {
            .product-actions {
                flex-direction: column;
                gap: 0.8rem;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }
        .navbar {
    background-color: var(--primary);
    color: white;
    padding: 1rem 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow);
}

.nav-container {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-logo {
    font-size: 1.5rem;
    font-weight: 700;
    font-family: 'Poppins', sans-serif;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 1.5rem;
}

.nav-links li a {
    color: white;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s ease;
}

.nav-links li a:hover {
    color: var(--accent);
}

/* Responsive navbar */
@media (max-width: 768px) {
    .nav-links {
        flex-direction: column;
        background-color: var(--primary-dark);
        position: absolute;
        top: 70px;
        right: 0;
        width: 200px;
        padding: 1rem;
        display: none;
    }

    .nav-links.active {
        display: flex;
    }
}

    </style>
</head>
<body>
    <nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">Ferme Locale</div>
        <ul class="nav-links">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('producteur.produits.create') }}">Ajouter Produit</a></li>
            <li style="position: relative;">
                                <a href="#" class="notification-btn" id="notificationDropdown" style="position: relative;">
                    <i class="fas fa-bell"></i>
                    @php
                    $unreadCount = Auth::user()->unreadNotifications->count();
                    $commentCount = Auth::user()->notifications->filter(function($notification) {
                        return isset($notification->data['commentaire']) && !$notification->read_at;
                    })->count();
                    @endphp
                    @if($unreadCount > 0)
                    <span class="notification-badge" style="position: absolute; top: -8px; right: -8px; background: #e53e3e; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem; font-weight: bold;">
                        {{ $unreadCount }}
                    </span>
                    @endif
                    @if($commentCount > 0)
                    <span class="comment-badge" style="position: absolute; top: -8px; left: -8px; background: #ff9800; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem; font-weight: bold;">
                        <i class="fas fa-comment" style="font-size: 0.7rem;"></i>
                    </span>
                    @endif
                </a>
                <!-- Dropdown notifications -->
                <div id="notificationList" style="display:none; position:absolute; right:0; background:white; min-width:320px; box-shadow:0 4px 16px rgba(0,0,0,0.12); border-radius:8px; z-index:100; max-height: 400px; overflow-y: auto;">
                    @php
                    $allNotifications = Auth::user()->notifications->take(20);
                    @endphp
                    @if($allNotifications->count())
                        <ul style="list-style:none; margin:0; padding:0;">
                            @foreach($allNotifications as $notification)
                                <li style="padding:1.2em; border-bottom:1px solid #eee; @if($notification->read_at === null) background:#f0fdf4; @endif">
                                    <div style="display:flex; align-items:flex-start; gap:0.8em;">
                                        <div style="background:#ff9800; color:white; border-radius:50%; width:2.5em; height:2.5em; display:flex; align-items:center; justify-content:center; font-size:1.2em;">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                        <div style="flex:1;">
                                            <div style="font-weight:600; color:#1f2937; margin-bottom:0.3em;">
                                                @if($notification->type === 'App\\Notifications\\StockFaible')
                                                    <span style="color:#b45309"><i class="fas fa-exclamation-triangle"></i> Stock faible / rupture</span>
                                                @else
                                                    {{ $notification->data['titre'] ?? 'Notification' }}
                                                @endif
                                            </div>
                                            <div style="color:#6b7280; margin-bottom:0.5em;">
                                                @if($notification->type === 'App\\Notifications\\StockFaible')
                                                    {{ $notification->data['message'] }}<br>
                                                    <span style="font-size:0.95em; color:#bfa94a;">
                                                        Produit : <b>{{ $notification->data['produit_nom'] }}</b> | Quantité : <b>{{ $notification->data['quantite_restante'] }} {{ $notification->data['unite'] }}</b>
                                                    </span>
                                                @else
                                                    {{ $notification->data['message'] ?? $notification->data['commentaire'] ?? 'Nouvelle notification' }}
                                                @endif
                                            </div>
                                            <div style="color:#9ca3af; font-size:0.85em;">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        @if($notification->read_at === null)
                                            <form method="POST" action="{{ route('producteur.notifications.markAsRead', $notification->id) }}" style="margin:0;">
                                                @csrf
                                                <button type="submit" style="background:#22c55e; color:white; border:none; padding:0.4em 0.8em; border-radius:6px; font-size:0.85em; cursor:pointer; transition:all 0.2s;" onmouseover="this.style.background='#16a34a'" onmouseout="this.style.background='#22c55e'">
                                                    <i class="fas fa-check mr-1"></i>Marquer comme lu
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div style="padding:1em;">Aucune notification</div>
                    @endif
                </div>
            </li>
            
            <li><a href="{{ route('producteur.dashboard.stats') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a></li>
        </ul>
    </div>
</nav>

<!-- Message de succès -->
@if(session('success'))
    <div style="background: #dcfce7; color: #166534; border-radius: 14px; padding: 1em 2em; margin: 2em auto; max-width: 600px; box-shadow: 0 2px 8px rgba(34,197,94,0.10); font-weight: 600; display: flex; align-items: center; gap: 1em;">
        <i class="fas fa-check-circle" style="font-size: 1.5em;"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif
<!-- Message d'erreur -->
@if($errors->any())
    <div style="background: #fee2e2; color: #991b1b; border-radius: 14px; padding: 1em 2em; margin: 2em auto; max-width: 600px; box-shadow: 0 2px 8px rgba(220,38,38,0.10); font-weight: 600; display: flex; align-items: center; gap: 1em;">
        <i class="fas fa-exclamation-triangle" style="font-size: 1.5em;"></i>
        <ul style="margin: 0; padding-left: 1em;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

    <div class="dashboard-container">
        {{-- Notifications de limitation de stock --}}
        @php
            $stockFaibleNotifications = Auth::user()->notifications->where('type', 'App\\Notifications\\StockFaible')->take(5);
        @endphp
        @if($stockFaibleNotifications->count())
            <div style="background: #fffbe6; border: 1.5px solid #ffe066; border-radius: 12px; padding: 1.2em 2em; margin-bottom: 2em; box-shadow: 0 2px 8px rgba(255,193,7,0.10);">
                <h3 style="color: #b45309; font-weight: bold; margin-bottom: 0.7em;"><i class="fas fa-exclamation-triangle"></i> Alertes stock faible / rupture</h3>
                <ul style="list-style: none; margin: 0; padding: 0;">
                    @foreach($stockFaibleNotifications as $notif)
                        <li style="margin-bottom: 1em; border-bottom: 1px dashed #ffe066; padding-bottom: 0.7em;">
                            <div style="font-weight: 600; color: #b45309;">{{ $notif->data['message'] }}</div>
                            <div style="color: #7c4700; font-size: 0.98em;">
                                Produit : <b>{{ $notif->data['produit_nom'] }}</b> | Quantité restante : <b>{{ $notif->data['quantite_restante'] }} {{ $notif->data['unite'] }}</b>
                            </div>
                            <div style="color: #bfa94a; font-size: 0.9em;">
                                <i class="fas fa-clock"></i> {{ $notif->created_at->diffForHumans() }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="section-title">
            <h1>Vos Produits</h1>
            <p>Gérez votre catalogue de produits agricoles et suivez vos stocks</p>
            
        </div>
        
        <!-- Section des produits -->
        <div class="products-section">
            <div class="section-header">
                <h3>Liste de vos produits</h3>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('producteur.commandes') }}" class="add-product-btn" style="background: #ff9800;">
                        <i class="fas fa-shopping-bag"></i> Mes Commandes
                    </a>
                    <a href="{{ route('producteur.produits.create') }}" class="add-product-btn">
                        <i class="fas fa-plus"></i> Ajouter un produit
                    </a>
                </div>
            </div>
            
            <div class="products-grid">
                @forelse($produits as $produit)
                    <div class="product-card">
                        <div class="product-image">
                            @if($produit->image)
                                <img src="{{ Storage::url($produit->image) }}" alt="{{ $produit->nom }}">
                            @else
                                <div class="placeholder-icon">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                            <span class="category-badge">{{ $produit->categorie }}</span>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title">{{ $produit->nom }}</h3>
                            <p class="product-description">{{ $produit->description }}</p>
                            <div class="product-meta">
                                <div class="product-price">{{ number_format($produit->prix, 2) }} DT</div>
                                <div class="product-stock">
                                    <i class="fas fa-box"></i> {{ $produit->quantite }} {{ $produit->unite }}
                                </div>
                            </div>
                            <div class="product-actions">
                                <a href="{{ route('producteur.produits.show', $produit->id) }}" class="action-btn view-btn">
                                    <i class="fas fa-eye"></i> 
                                </a>
                                <a href="{{ route('producteur.produits.edit', $produit->id) }}" class="action-btn edit-btn">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <form action="{{ route('producteur.produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-products">
                        <i class="fas fa-box-open"></i>
                        <h4>Aucun produit trouvé</h4>
                        <p>Ajoutez votre premier produit pour le voir apparaître ici.</p>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; 2023 Boutique Tunisie. Tous droits réservés. | Tableau de bord Producteur</p>
            <div style="margin-top:8px;">
                <span><i class="fas fa-map-marker-alt"></i> 12 Avenue de la Liberté, Tunis, Tunisie</span> |
                <span><i class="fas fa-phone"></i> +216 12 345 678</span> |
                <span><i class="fas fa-envelope"></i> contact@boutiquetunisie.tn</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Animation des cartes produits
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = "0";
                    card.style.transform = "translateY(20px)";
                    card.style.transition = "opacity 0.5s ease, transform 0.5s ease";
                    setTimeout(() => {
                        card.style.opacity = "1";
                        card.style.transform = "translateY(0)";
                    }, 100);
                }, index * 100);
            });

            // Gestion des événements pour les boutons
            document.querySelectorAll('.action-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.querySelector('i').className;
                    let message = '';
                    if (action.includes('eye')) {
                        message = "Affichage des détails du produit";
                    } else if (action.includes('edit')) {
                        message = "Modification du produit";
                    } else if (action.includes('trash')) {
                        message = "Suppression du produit";
                    } else if (action.includes('plus')) {
                        message = "Ajout d'un nouveau produit";
                    }
                    alert(message);
                });
            });

            // Confirmation pour la déconnexion
            const logoutLink = document.querySelector('a[href="{{ route('logout') }}"]');
            if (logoutLink) {
                logoutLink.addEventListener('click', function(e) {
                    if (!confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                        e.preventDefault();
                    }
                });
            }

            // Gestion du dropdown notifications
            const dropdownBtn = document.getElementById('notificationDropdown');
            const notificationList = document.getElementById('notificationList');
            if (dropdownBtn && notificationList) {
                dropdownBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    notificationList.style.display = notificationList.style.display === 'block' ? 'none' : 'block';
                });
                // Fermer le dropdown si on clique en dehors
                window.addEventListener('click', function(e) {
                    if (!dropdownBtn.contains(e.target) && !notificationList.contains(e.target)) {
                        notificationList.style.display = 'none';
                    }
                });
            }
        });
    </script>

</body>
</html>