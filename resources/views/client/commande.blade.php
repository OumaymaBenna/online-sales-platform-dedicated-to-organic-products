<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finaliser la commande - MaBoutique</title>
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
        .form-input:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
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
    </style>
</head>
<body class="bg-green-50 min-h-screen">
    <!-- NAVBAR CLIENT -->
    <nav class="bg-white shadow-lg rounded-b-2xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center text-green-700 text-2xl font-bold">
                    <span class="mr-2"><i class="fas fa-store"></i></span> MaBoutique
                </div>
                <!-- Links -->
                <div class="hidden md:flex md:items-center md:space-x-6">
                    <a href="{{ route('client.dashboard') }}" class="nav-anim-link flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium"><i class="fas fa-home mr-2"></i>Accueil</a>
                    <a href="{{ route('client.produits') }}" class="nav-anim-link flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium"><i class="fas fa-box mr-2"></i>Produits</a>
                    <a href="{{ route('client.panier') }}" class="nav-anim-link flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium"><i class="fas fa-shopping-cart mr-2"></i>Panier</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 hover:text-red-800 transition font-medium"><i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Titre -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-credit-card text-green-600 mr-3"></i>
                    Finaliser votre commande
                </h1>
                <p class="text-gray-600 mt-2">Veuillez remplir vos informations pour finaliser votre commande</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Formulaire d'informations -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-user text-green-600 mr-2"></i>
                            Informations personnelles
                        </h2>

                        @if(session('error'))
                            <div class="mb-4 bg-red-100 border-l-4 border-red-600 text-red-800 p-4 rounded-lg">
                                <p><i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('client.paiement') }}" method="GET">
                            @csrf
                            
                            <!-- Informations de base -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-user mr-1"></i> Nom complet *
                                    </label>
                                    <input type="text" id="nom" name="nom" value="{{ old('nom', $user->name ?? '') }}" 
                                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                           required>
                                    @error('nom')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-1"></i> Email *
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" 
                                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                           required>
                                    @error('email')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Téléphone -->
                            <div class="mb-6">
                                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-phone mr-1"></i> Téléphone *
                                </label>
                                <input type="tel" id="telephone" name="telephone" value="{{ old('telephone', $client->telephone ?? '') }}" 
                                       class="form-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                       placeholder="+216 XX XXX XXX" required>
                                @error('telephone')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Adresse de livraison -->
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                                    Adresse de livraison
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    <div>
                                        <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-home mr-1"></i> Adresse *
                                        </label>
                                        <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" 
                                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                               placeholder="123 Rue de la Paix" required>
                                        @error('adresse')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-city mr-1"></i> Ville *
                                        </label>
                                        <input type="text" id="ville" name="ville" value="{{ old('ville') }}" 
                                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                               placeholder="Tunis" required>
                                        @error('ville')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="code_postal" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-mail-bulk mr-1"></i> Code postal *
                                        </label>
                                        <input type="text" id="code_postal" name="code_postal" value="{{ old('code_postal') }}" 
                                               class="form-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                               placeholder="1000" required>
                                        @error('code_postal')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="pays" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-flag mr-1"></i> Pays *
                                        </label>
                                        <select id="pays" name="pays" 
                                                class="form-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                                required>
                                            <option value="">Sélectionner un pays</option>
                                            <option value="Tunisie" {{ old('pays') == 'Tunisie' ? 'selected' : '' }}>Tunisie</option>
                                            <option value="France" {{ old('pays') == 'France' ? 'selected' : '' }}>France</option>
                                            <option value="Canada" {{ old('pays') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                            <option value="Belgique" {{ old('pays') == 'Belgique' ? 'selected' : '' }}>Belgique</option>
                                            <option value="Suisse" {{ old('pays') == 'Suisse' ? 'selected' : '' }}>Suisse</option>
                                        </select>
                                        @error('pays')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Notes de commande -->
                            <div class="mb-6">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-sticky-note mr-1"></i> Notes de commande (optionnel)
                                </label>
                                <textarea id="notes" name="notes" rows="3" 
                                          class="form-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                          placeholder="Instructions spéciales pour la livraison...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Boutons -->
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('client.panier') }}" 
                                   class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-arrow-left mr-2"></i> Retour au panier
                                </a>
                                <button type="submit" 
                                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-check mr-2"></i> Continuer vers le paiement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Résumé de la commande -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-shopping-cart text-green-600 mr-2"></i>
                            Résumé de la commande
                        </h3>

                        <!-- Produits -->
                        <div class="space-y-3 mb-6">
                            @foreach($cart as $id => $item)
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">{{ $item['nom'] }}</p>
                                        <p class="text-sm text-gray-500">Quantité: {{ $item['quantite'] }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-800">{{ number_format($item['prix'] * $item['quantite'], 2) }} DT</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Total -->
                        <div class="border-t border-gray-200 pt-4">
                            @php
                                $total = 0;
                                foreach($cart as $item) {
                                    $total += $item['prix'] * $item['quantite'];
                                }
                            @endphp
                            <div class="flex justify-between items-center text-lg font-bold text-gray-800">
                                <span>Total</span>
                                <span class="text-green-600">{{ number_format($total, 2) }} DT</span>
                            </div>
                        </div>

                        <!-- Informations de livraison -->
                        <div class="mt-6 p-4 bg-green-50 rounded-lg">
                            <h4 class="font-medium text-green-800 mb-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Informations importantes
                            </h4>
                            <ul class="text-sm text-green-700 space-y-1">
                                <li>• Livraison gratuite à partir de 50 DT</li>
                                <li>• Délai de livraison: 2-5 jours ouvrables</li>
                                <li>• Paiement sécurisé</li>
                                <li>• Retours acceptés sous 14 jours</li>
                            </ul>
                        </div>
                    </div>
                </div>
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
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-green-200 hover:text-white bg-transparent border-none p-0">Déconnexion</button>
                            </form>
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
</body>
</html> 