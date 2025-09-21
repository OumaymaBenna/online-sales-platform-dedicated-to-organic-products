<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma liste de souhaits - Ferme Locale</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #f4f7ed;
            margin: 0;
            color: #2d3a2e;
        }

        .navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.07);
            padding: 1.2rem 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #4caf50;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: #2d3a2e;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            transition: color 0.2s;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }

        .nav-links a.active, .nav-links a:hover {
            background: #e8f5e9;
            color: #388e3c;
        }

        .cart-badge {
            background: #ff4081;
            color: #fff;
            border-radius: 50%;
            padding: 0.2em 0.6em;
            font-size: 0.9em;
            margin-left: 0.3em;
            font-weight: bold;
        }

        .container {
            max-width: 1100px;
            margin: 2.5rem auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 32px rgba(44, 62, 80, 0.08);
            padding: 2.5rem 2rem;
        }

        .wishlist-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .wishlist-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: #388e3c;
            font-weight: 700;
            margin: 0;
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: #fafcf8;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(44, 62, 80, 0.07);
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
            position: relative;
            display: flex;
            flex-direction: column;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: none; }
        }

        .product-card:hover {
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.13);
            transform: translateY(-4px) scale(1.02);
        }

        .product-image {
            position: relative;
            height: 220px;
            background: #e8f5e9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            max-width: 100%;
            max-height: 180px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        }

        .placeholder-icon {
            font-size: 4rem;
            color: #b2dfdb;
        }

        .category-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: #fffde7;
            color: #ff9800;
            font-weight: 600;
            padding: 0.3em 1em;
            border-radius: 12px;
            font-size: 0.95em;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.07);
        }

        .wishlist-button {
            position: absolute;
            top: 16px;
            right: 16px;
            background: #fff;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ff4081;
            font-size: 1.4rem;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.07);
            transition: background 0.2s, color 0.2s;
        }

        .wishlist-button.active, .wishlist-button:hover {
            background: #ff4081;
            color: #fff;
        }

        .product-content {
            padding: 1.5rem 1.2rem 1.2rem 1.2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: #2d3a2e;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-info {
            display: flex;
            gap: 1.2rem;
            margin-bottom: 0.7rem;
            font-size: 1rem;
            color: #388e3c;
        }

        .product-info .producer, .product-info .quantity {
            display: flex;
            align-items: center;
            gap: 0.4em;
        }

        .product-description {
            color: #5d6d5d;
            font-size: 1.05rem;
            margin-bottom: 1.2rem;
            flex: 1;
        }

        .wishlist-item-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-move-to-cart, .btn-remove-wishlist, .btn-details {
            background: #388e3c;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.7em 1.3em;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5em;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.07);
        }

        .btn-move-to-cart:hover, .btn-details:hover {
            background: #43a047;
            transform: translateY(-2px) scale(1.04);
        }

        .btn-remove-wishlist {
            background: #ff4081;
        }

        .btn-remove-wishlist:hover {
            background: #e91e63;
            transform: translateY(-2px) scale(1.04);
        }

        .empty-wishlist {
            text-align: center;
            color: #bdbdbd;
            padding: 3rem 0;
        }

        .empty-wishlist i {
            font-size: 3.5rem;
            color: #ff4081;
            margin-bottom: 1rem;
        }

        .toast {
            opacity: 0.97;
            box-shadow: 0 4px 16px rgba(44, 62, 80, 0.18);
            border-radius: 10px;
            font-size: 1.1rem;
            font-family: 'Poppins', Arial, sans-serif;
            letter-spacing: 0.01em;
        }

        @media (max-width: 900px) {
            .container {
                padding: 1.2rem 0.5rem;
            }
            .wishlist-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.7rem;
            }
            .wishlist-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 600px) {
            .wishlist-grid {
                grid-template-columns: 1fr;
                gap: 1.2rem;
            }
            .container {
                padding: 0.5rem 0.2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">Ferme Locale</div>
            <ul class="nav-links">
                <li><a href="{{ route('client.dashboard') }}">Accueil</a></li>
                <li><a href="{{ route('client.wishlist') }}" class="active"><i class="fas fa-heart"></i> Favoris <span id="wishlist-count" class="cart-badge">{{ count($wishlistItems) }}</span></a></li>
                <li>
                    <a href="{{ route('client.panier') }}" class="cart-link">
                        <i class="fas fa-shopping-cart"></i>
                        Panier
                        <span id="cart-count" class="cart-badge">{{ isset(
                            $cartCount) ? $cartCount : (is_array(session('cart')) ? count(session('cart')) : 0) }}</span>
                    </a>
                </li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a></li>
            </ul>
        </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <div class="container">
        <div class="wishlist-header">
            <h2 class="wishlist-title"><i class="fas fa-heart" style="color:#ff4081; margin-right:10px;"></i> Ma liste de souhaits</h2>
            <p>{{ count($wishlistItems) }} produit(s) dans vos favoris</p>
        </div>
        
        @if(count($wishlistItems) > 0)
            <div class="wishlist-grid">
                @foreach($wishlistItems as $produit)
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
                            <button class="wishlist-button active" 
                                    data-product-id="{{ $produit->id }}">
                                <i class="fas fa-heart"></i>
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
                            <div class="wishlist-item-actions">
                                <button class="btn-remove-wishlist" data-product-id="{{ $produit->id }}">
                                    <i class="fas fa-trash-alt"></i> Retirer
                                </button>
                                <button class="btn-move-to-cart-wishlist" data-product-id="{{ $produit->id }}">
                                    <i class="fas fa-exchange-alt"></i> Déplacer au panier
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-wishlist">
                <i class="fas fa-heart-broken"></i>
                <h3>Votre liste de souhaits est vide</h3>
                <p>Commencez à ajouter des produits à vos favoris pour les retrouver ici</p>
                <a href="{{ route('client.dashboard') }}" class="btn-details" style="margin-top:1.5rem;">
                    <i class="fas fa-store"></i> Voir nos produits
                </a>
            </div>
        @endif
    </div>
    
    <!-- Pied de page (copier le même footer que précédemment) -->
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des boutons wishlist sur la page wishlist
            const wishlistButtons = document.querySelectorAll('.wishlist-button');
            wishlistButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    
                    // Animation
                    const icon = this.querySelector('i');
                    icon.className = 'fas fa-spinner fa-spin';
                    
                    // Appel AJAX pour retirer de la wishlist
                    fetch(`/wishlist/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Supprimer l'élément visuellement
                            const card = this.closest('.product-card');
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.9)';
                            setTimeout(() => {
                                card.remove();
                                
                                // Mettre à jour le compteur
                                document.querySelector('.wishlist-header p').textContent = 
                                    document.querySelectorAll('.product-card').length + ' produit(s) dans vos favoris';
                                updateWishlistCount(-1);
                                if (document.querySelectorAll('.product-card').length === 0) {
                                    document.querySelector('.wishlist-grid').innerHTML = `
                                        <div class="empty-wishlist">
                                            <i class="fas fa-heart-broken"></i>
                                            <h3>Votre liste de souhaits est vide</h3>
                                            <p>Commencez à ajouter des produits à vos favoris pour les retrouver ici</p>
                                            <a href="{{ route('client.dashboard') }}" class="btn-details" style="margin-top:1.5rem;">
                                                <i class="fas fa-store"></i> Voir nos produits
                                            </a>
                                        </div>
                                    `;
                                }
                            }, 300);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        icon.className = 'fas fa-heart';
                    });
                });
            });
            
            // Gestion des boutons "Retirer" sur la page wishlist
            const removeButtons = document.querySelectorAll('.btn-remove-wishlist');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    
                    // Appel AJAX pour retirer de la wishlist
                    fetch(`/wishlist/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Supprimer l'élément visuellement
                            const card = this.closest('.product-card');
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.9)';
                            setTimeout(() => {
                                card.remove();
                                
                                // Mettre à jour le compteur
                                document.querySelector('.wishlist-header p').textContent = 
                                    document.querySelectorAll('.product-card').length + ' produit(s) dans vos favoris';
                                updateWishlistCount(-1);
                                if (document.querySelectorAll('.product-card').length === 0) {
                                    document.querySelector('.wishlist-grid').innerHTML = `
                                        <div class="empty-wishlist">
                                            <i class="fas fa-heart-broken"></i>
                                            <h3>Votre liste de souhaits est vide</h3>
                                            <p>Commencez à ajouter des produits à vos favoris pour les retrouver ici</p>
                                            <a href="{{ route('client.dashboard') }}" class="btn-details" style="margin-top:1.5rem;">
                                                <i class="fas fa-store"></i> Voir nos produits
                                            </a>
                                        </div>
                                    `;
                                }
                            }, 300);
                            
                            // Afficher une notification
                            showToast('Produit retiré de vos favoris', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                    });
                });
            });
            
            // Gestion des boutons "Déplacer au panier" sur la page wishlist
            const moveToCartButtons = document.querySelectorAll('.btn-move-to-cart-wishlist');
            moveToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ...';
                    fetch(`/client/wishlist/move-to-cart/${productId}`, {
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
                            // Supprimer l'élément visuellement
                            const card = this.closest('.product-card');
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.9)';
                            setTimeout(() => {
                                card.remove();
                                document.querySelector('.wishlist-header p').textContent = 
                                    document.querySelectorAll('.product-card').length + ' produit(s) dans vos favoris';
                                updateWishlistCount(-1);
                                updateCartCount(1);
                                if (document.querySelectorAll('.product-card').length === 0) {
                                    document.querySelector('.wishlist-grid').innerHTML = `
                                        <div class="empty-wishlist">
                                            <i class="fas fa-heart-broken"></i>
                                            <h3>Votre liste de souhaits est vide</h3>
                                            <p>Commencez à ajouter des produits à vos favoris pour les retrouver ici</p>
                                            <a href="{{ route('client.dashboard') }}" class="btn-details" style="margin-top:1.5rem;">
                                                <i class="fas fa-store"></i> Voir nos produits
                                            </a>
                                        </div>
                                    `;
                                }
                            }, 300);
                            showToast('Produit déplacé au panier', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        this.disabled = false;
                        this.innerHTML = '<i class="fas fa-exchange-alt"></i> Déplacer au panier';
                        showToast('Erreur lors du déplacement', 'error');
                    });
                });
            });
            
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

            // Mettre à jour le compteur wishlist
            function updateWishlistCount(delta) {
                const badge = document.getElementById('wishlist-count');
                let count = parseInt(badge.textContent) || 0;
                count += delta;
                badge.textContent = count;
                if (count <= 0) badge.style.display = 'none';
                else badge.style.display = '';
            }
            // Mettre à jour le compteur panier
            function updateCartCount(delta) {
                const badge = document.getElementById('cart-count');
                let count = parseInt(badge.textContent) || 0;
                count += delta;
                badge.textContent = count;
                if (count <= 0) badge.style.display = 'none';
                else badge.style.display = '';
            }
        });
    </script>
</body>
</html>