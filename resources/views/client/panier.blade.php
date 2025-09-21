<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier d'achat - MaBoutique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            100: '#f0fdf4',
                            200: '#dcfce7',
                            300: '#bbf7d0',
                            400: '#86efac',
                            500: '#4ade80',
                            600: '#22c55e',
                            700: '#16a34a',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
        
    </script>
    <style>
        .cart-item {
            transition: all 0.3s ease;
        }
        .cart-item:hover {
            background-color: #f0fdf4;
            transform: translateY(-2px);
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .nav-anim-link {
            position: relative;
            overflow: hidden;
        }
        .nav-anim-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #22c55e 0%, #4ade80 100%);
            transform: scaleX(0);
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            transform-origin: left;
        }
        .nav-anim-link:hover::after, .nav-anim-link:focus::after {
            transform: scaleX(1);
        }
        .navbar-appear {
            opacity: 0;
            transform: translateY(-30px);
            transition: opacity 0.6s cubic-bezier(.4,0,.2,1), transform 0.6s cubic-bezier(.4,0,.2,1);
        }
        .navbar-appear.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .mobile-menu-anim {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.4s, transform 0.4s;
            pointer-events: none;
        }
        .mobile-menu-anim.open {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
    </style>
</head>
<body class="bg-green-50 min-h-screen">
   <!-- NAVBAR CLIENT STYLE PRODUCTEUR -->
    <nav class="bg-white shadow-lg rounded-b-2xl sticky top-0 z-50 navbar-appear">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center text-green-700 text-2xl font-bold">
                    <span class="mr-2"><i class="fas fa-store"></i></span> MaBoutique
                </div>
                <!-- Burger menu (mobile) -->
                <div class="flex md:hidden">
                    <button id="burger-menu" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-green-700 hover:text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-600" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Ouvrir le menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <!-- Links -->
                <div class="hidden md:flex md:items-center md:space-x-6">
                    <a href="{{ route('client.dashboard') }}" class="nav-anim-link flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium"><i class="fas fa-home mr-2"></i>Accueil</a>
                    <a href="{{ route('client.produits') }}" class="nav-anim-link flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium"><i class="fas fa-box mr-2"></i>Produits</a>
                    <a href="{{ route('client.panier') }}" class="nav-anim-link flex items-center px-3 py-2 rounded-lg text-green-700 bg-green-100 font-semibold shadow-inner"><i class="fas fa-shopping-cart mr-2"></i>Panier</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 hover:text-red-800 transition font-medium"><i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="md:hidden mobile-menu-anim" id="mobile-menu" style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-lg rounded-b-2xl">
                <a href="{{ route('client.dashboard') }}" class="nav-anim-link block px-3 py-2 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium"><i class="fas fa-home mr-2"></i>Accueil</a>
                <a href="{{ route('client.produits') }}" class="nav-anim-link block px-3 py-2 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium"><i class="fas fa-box mr-2"></i>Produits</a>
                <a href="{{ route('client.panier') }}" class="nav-anim-link block px-3 py-2 rounded-lg text-green-700 bg-green-100 font-semibold shadow-inner"><i class="fas fa-shopping-cart mr-2"></i>Panier</a>
                <a href="#" class="nav-anim-link block px-3 py-2 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium"><i class="fas fa-user mr-2"></i>Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 hover:text-red-800 transition font-medium"><i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Titre et message de succès -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-shopping-cart text-green-600 mr-3"></i>
                    Votre panier
                </h1>
                
                @if(session('success'))
                    <div class="mt-4 bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded-lg">
                        <p><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</p>
                    </div>
                @endif
            </div>

            <!-- Panier -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                @if(count($cart) > 0) <!-- Condition pour panier non vide -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Produit</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Quantité</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Prix unitaire</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($cart as $id => $item)
                                <tr class="cart-item">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-16">
                                                @if(isset($item['image']) && $item['image'])
                                                    <img class="h-16 w-16 rounded-lg object-cover" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['nom'] }}">
                                                @else
                                                    <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                                        <i class="fas fa-leaf text-gray-400 text-xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item['nom'] }}</div>
                                                @if(isset($item['producteur']['nom_entreprise']))
                                                    <div class="text-sm text-gray-500">
                                                        <i class="fas fa-user mr-1"></i>
                                                        {{ $item['producteur']['nom_entreprise'] }}
                                                    </div>
                                                    @if(isset($item['producteur']['adresse']))
                                                        <div class="text-xs text-gray-400">
                                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                                            {{ $item['producteur']['adresse'] }}
                                                        </div>
                                                    @endif
                                                    @if(isset($item['producteur']['telephone']))
                                                        <div class="text-xs text-gray-400">
                                                            <i class="fas fa-phone mr-1"></i>
                                                            {{ $item['producteur']['telephone'] }}
                                                        </div>
                                                    @endif
                                                @endif
                                                @if(isset($item['categorie']))
                                                    <div class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full inline-block mt-1">
                                                        {{ $item['categorie'] }}
                                                    </div>
                                                @endif
                                                @if(isset($item['description']))
                                                    <div class="text-xs text-gray-400 mt-1 max-w-xs truncate">
                                                        {{ Str::limit($item['description'], 60) }}
                                                    </div>
                                                @endif
                                                @if(isset($item['date_ajout']))
                                                    <div class="text-xs text-gray-300 mt-1">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        Ajouté le {{ \Carbon\Carbon::parse($item['date_ajout'])->format('d/m/Y H:i') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <button class="text-gray-500 hover:text-gray-700 px-2 py-1 rounded" onclick="updateQuantity({{ $id }}, -1)">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            <span class="mx-2 text-gray-800 font-medium">{{ $item['quantite'] }}</span>
                                            <button class="text-gray-500 hover:text-gray-700 px-2 py-1 rounded" onclick="updateQuantity({{ $id }}, 1)">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ number_format($item['prix'], 2) }} DT
                                        @if(isset($item['unite']))
                                            <span class="text-xs text-gray-500">/ {{ $item['unite'] }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ number_format($item['prix'] * $item['quantite'], 2) }} DT
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <form action="{{ route('client.panier.supprimer') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="produit_id" value="{{ $id }}">
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Voulez-vous supprimer ce produit du panier ?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-green-50">
                            @php
                                $total = 0;
                                foreach($cart as $item) {
                                    $total += $item['prix'] * $item['quantite'];
                                }
                            @endphp
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                                    Total général
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-700">
                                    {{ number_format($total, 2) }} DT
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <form action="{{ route('client.panier.vider') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment vider le panier ?');">
                                        @csrf
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-800">
                                            <i class="fas fa-trash-alt mr-1"></i> Vider le panier
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Informations des producteurs -->
                <div class="p-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-green-600 mr-2"></i>
                        Informations des producteurs
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @php
                            $producteurs = [];
                            foreach($cart as $item) {
                                if(isset($item['producteur']['id']) && $item['producteur']['id']) {
                                    $producteurId = $item['producteur']['id'];
                                    if(!isset($producteurs[$producteurId])) {
                                        $producteurs[$producteurId] = $item['producteur'];
                                    }
                                }
                            }
                        @endphp
                        
                        @forelse($producteurs as $producteur)
                            <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                                <h4 class="font-medium text-green-800 mb-2 flex items-center">
                                    <i class="fas fa-user-tie mr-2"></i>
                                    {{ $producteur['nom_entreprise'] }}
                                </h4>
                                @if(isset($producteur['adresse']))
                                    <p class="text-sm text-gray-600 mb-1 flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                                        {{ $producteur['adresse'] }}
                                    </p>
                                @endif
                                @if(isset($producteur['telephone']))
                                    <p class="text-sm text-gray-600 mb-1 flex items-center">
                                        <i class="fas fa-phone mr-2 text-green-600"></i>
                                        <a href="tel:{{ $producteur['telephone'] }}" class="hover:text-green-600">
                                            {{ $producteur['telephone'] }}
                                        </a>
                                    </p>
                                @endif
                                @if(isset($producteur['email']))
                                    <p class="text-sm text-gray-600 mb-1 flex items-center">
                                        <i class="fas fa-envelope mr-2 text-green-600"></i>
                                        <a href="mailto:{{ $producteur['email'] }}" class="hover:text-green-600">
                                            {{ $producteur['email'] }}
                                        </a>
                                    </p>
                                @endif
                                @if(isset($producteur['description']))
                                    <p class="text-xs text-gray-500 mt-2">
                                        {{ Str::limit($producteur['description'], 100) }}
                                    </p>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full text-center text-gray-500 py-4">
                                <i class="fas fa-info-circle text-2xl mb-2"></i>
                                <p>Aucune information de producteur disponible</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center">
                    <a href="{{ route('client.produits') }}" class="mb-4 sm:mb-0 flex items-center text-green-600 hover:text-green-800">
                        <i class="fas fa-arrow-left mr-2"></i> Continuer vos achats
                    </a>
                    <a href="{{ route('client.commande') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center">
                        <i class="fas fa-shopping-bag mr-2"></i> Passer la commande
                    </a>
                </div>
                @else
                <div class="p-12 text-center">
                    <div class="flex justify-center mb-6">
                        <i class="fas fa-shopping-cart text-gray-300 text-6xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Votre panier est vide</h3>
                    <p class="text-gray-500 mb-6">Commencez à ajouter des produits à votre panier !</p>
                    <a href="{{ route('client.produits') }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-store mr-2"></i> Découvrir nos produits
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-green-800 text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">MaBoutique</h3>
                    <p class="text-green-200 mb-4">Votre destination de shopping en ligne pour tous vos besoins.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-green-200 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-green-200 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-green-200 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-green-200 hover:text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-green-200 hover:text-white">Accueil</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Produits</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Catégories</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Promotions</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Nouveautés</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4">Compte</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-green-200 hover:text-white">Mon compte</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Mes commandes</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Mes favoris</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Paramètres</a></li>
                        <li>
                            <a href="#" class="text-green-200 hover:text-white">Déconnexion</a>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-green-200"></i>
                            <span class="text-green-200">12 Avenue de la Liberté, Tunis, Tunisie</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-green-200"></i>
                            <span class="text-green-200">+216 12 345 678</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-green-200"></i>
                            <span class="text-green-200">contact@boutiquetunisie.tn</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-green-700 mt-8 pt-8 text-center text-green-200">
                <p>&copy; 2023 MaBoutique. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bouton dark/light mode -->
    <button id="theme-toggle" class="fixed bottom-6 right-6 bg-green-600 text-white rounded-full p-3 shadow-lg">
        <i id="theme-icon" class="fas fa-sun"></i>
    </button>

    <script>
        // Toggle dark mode
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;
        
        // Basculer entre les thèmes
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            
            if (html.classList.contains('dark')) {
                themeIcon.classList.replace('fa-sun', 'fa-moon');
            } else {
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            }
        });

        // Fonction pour mettre à jour la quantité
        function updateQuantity(produitId, change) {
            const row = event.target.closest('tr');
            const quantitySpan = row.querySelector('span');
            let currentQuantity = parseInt(quantitySpan.textContent);
            let newQuantity = currentQuantity + change;
            
            if (newQuantity <= 0) {
                // Supprimer le produit si la quantité devient 0 ou négative
                if (confirm('Voulez-vous supprimer ce produit du panier ?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("client.panier.supprimer") }}';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    
                    const produitInput = document.createElement('input');
                    produitInput.type = 'hidden';
                    produitInput.name = 'produit_id';
                    produitInput.value = produitId;
                    
                    form.appendChild(csrfToken);
                    form.appendChild(produitInput);
                    document.body.appendChild(form);
                    form.submit();
                }
                return;
            }
            
            // Mettre à jour la quantité via AJAX
            fetch('{{ route("client.panier.quantite") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    produit_id: produitId,
                    quantite: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    quantitySpan.textContent = newQuantity;
                    
                    // Mettre à jour le total de la ligne
                    const prixCell = row.querySelector('td:nth-child(3)');
                    const totalCell = row.querySelector('td:nth-child(4)');
                    const prix = parseFloat(prixCell.textContent.replace('DT', '').trim());
                    const total = prix * newQuantity;
                    totalCell.textContent = total.toFixed(2) + ' DT';
                    
                    // Mettre à jour le total général
                    updateTotalGeneral();
                }
            })
            .catch(error => {
                console.error('Erreur lors de la mise à jour:', error);
                alert('Erreur lors de la mise à jour de la quantité');
            });
        }

        // Fonction pour mettre à jour le total général
        function updateTotalGeneral() {
            const rows = document.querySelectorAll('tbody tr');
            let total = 0;
            
            rows.forEach(row => {
                const totalCell = row.querySelector('td:nth-child(4)');
                const totalText = totalCell.textContent.replace('DT', '').trim();
                total += parseFloat(totalText);
            });
            
            const totalGeneralCell = document.querySelector('tfoot td:nth-child(4)');
            totalGeneralCell.textContent = total.toFixed(2) + ' DT';
        }

        // Apparition animée de la navbar
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.querySelector('.navbar-appear').classList.add('visible');
            }, 100);
            // Burger menu toggle + animation
            const burger = document.getElementById('burger-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            burger.addEventListener('click', function() {
                if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
                    mobileMenu.style.display = 'block';
                    setTimeout(function() {
                        mobileMenu.classList.add('open');
                    }, 10);
                } else {
                    mobileMenu.classList.remove('open');
                    setTimeout(function() {
                        mobileMenu.style.display = 'none';
                    }, 400);
                }
            });
        });
    </script>
</body>
</html>