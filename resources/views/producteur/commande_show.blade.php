<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la commande - MaBoutique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-green-50 min-h-screen">
    <!-- NAVBAR PRODUCTEUR -->
    <nav class="bg-white shadow-lg rounded-b-2xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center text-green-700 text-2xl font-bold">
                    <span class="mr-2"><i class="fas fa-store"></i></span> MaBoutique
                </div>
                <div class="hidden md:flex md:items-center md:space-x-6">
                    <a href="{{ route('producteur.dashboard') }}" class="text-gray-700 hover:text-green-700 transition">Dashboard</a>
                    <a href="{{ route('producteur.produits.create') }}" class="text-gray-700 hover:text-green-700 transition">Ajouter un produit</a>
                    <a href="{{ route('producteur.commandes') }}" class="text-green-700 bg-green-100 px-3 py-2 rounded-lg font-semibold">Mes Commandes</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 transition">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-shopping-bag text-green-600 mr-3"></i>
                            Commande #{{ $commande->numero_commande }}
                        </h1>
                        <p class="text-gray-600 mt-2">Détails de la commande reçue</p>
                    </div>
                    <a href="{{ route('producteur.commandes') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Retour aux commandes
                    </a>
                </div>
            </div>

            <!-- Messages de succès -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Informations de la commande -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Détails de la commande -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-green-600 mr-2"></i>
                            Informations de la commande
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-medium text-gray-700 mb-2">Client</h3>
                                <p class="text-gray-900">{{ $commande->user->name }}</p>
                                <p class="text-gray-600">{{ $commande->user->email }}</p>
                            </div>
                            
                            <div>
                                <h3 class="font-medium text-gray-700 mb-2">Statut</h3>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                    @if($commande->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                    @elseif($commande->statut === 'confirmee') bg-blue-100 text-blue-800
                                    @elseif($commande->statut === 'expediee') bg-purple-100 text-purple-800
                                    @elseif($commande->statut === 'livree') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                </span>
                            </div>
                            
                            <div>
                                <h3 class="font-medium text-gray-700 mb-2">Date de commande</h3>
                                <p class="text-gray-900">{{ $commande->date_commande->format('d/m/Y à H:i') }}</p>
                            </div>
                            
                            <div>
                                <h3 class="font-medium text-gray-700 mb-2">Méthode de paiement</h3>
                                <p class="text-gray-900">{{ ucfirst($commande->methode_paiement) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Produits commandés -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-box text-green-600 mr-2"></i>
                            Produits commandés
                        </h2>
                        
                        <div class="space-y-4">
                            @php
                                $produitsProducteur = $commande->produits->where('producteur_id', $producteur->id);
                                $totalProducteur = $produitsProducteur->sum('prix_total');
                            @endphp
                            
                            @foreach($produitsProducteur as $commandeProduit)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-green-50 transition duration-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-leaf text-green-600 text-xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900 text-lg">{{ $commandeProduit->produit->nom }}</h3>
                                                <p class="text-gray-600">{{ $commandeProduit->produit->description }}</p>
                                                <div class="flex items-center space-x-4 mt-2">
                                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">
                                                        📦 {{ $commandeProduit->quantite }} {{ $commandeProduit->produit->unite }}
                                                    </span>
                                                    <span class="text-gray-500 text-sm">
                                                        Prix unitaire : {{ number_format($commandeProduit->prix_unitaire, 2) }} DT
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-green-600">
                                                {{ number_format($commandeProduit->prix_total, 2) }} DT
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Total pour ce produit
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($produitsProducteur->count() === 0)
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-box-open text-4xl mb-4"></i>
                                    <p>Aucun produit de votre boutique dans cette commande</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Résumé et actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-calculator text-green-600 mr-2"></i>
                            Résumé
                        </h3>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Produits commandés :</span>
                                <span class="font-medium">{{ $produitsProducteur->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total de vos produits :</span>
                                <span class="font-bold text-green-600">{{ number_format($totalProducteur, 2) }} DT</span>
                            </div>
                            <hr class="my-3">
                            <div class="flex justify-between text-lg">
                                <span class="font-semibold">Total commande :</span>
                                <span class="font-bold text-green-600">{{ number_format($commande->total, 2) }} DT</span>
                            </div>
                        </div>

                        <!-- Adresse de livraison -->
                        <div class="border-t pt-4">
                            <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                                Adresse de livraison
                            </h4>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p>{{ $commande->adresse_livraison }}</p>
                                <p>{{ $commande->code_postal }} {{ $commande->ville }}</p>
                                <p>{{ $commande->pays }}</p>
                                <p class="mt-2">
                                    <i class="fas fa-phone mr-1"></i>
                                    {{ $commande->telephone }}
                                </p>
                            </div>
                        </div>

                        @if($commande->notes)
                            <div class="border-t pt-4 mt-4">
                                <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-sticky-note text-green-600 mr-2"></i>
                                    Notes du client
                                </h4>
                                <p class="text-sm text-gray-600 italic">{{ $commande->notes }}</p>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="border-t pt-4 mt-4 space-y-2">
                            @if($commande->statut === 'en_attente')
                                <form action="{{ route('producteur.commande.confirmer', $commande->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300" onclick="return confirm('Êtes-vous sûr de vouloir confirmer cette commande ?')">
                                        <i class="fas fa-check mr-2"></i> Confirmer la commande
                                    </button>
                                </form>
                            @endif
                            
                            @if($commande->statut === 'confirmee')
                                <form action="{{ route('producteur.commande.expedier', $commande->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300" onclick="return confirm('Êtes-vous sûr de vouloir marquer cette commande comme expédiée ?')">
                                        <i class="fas fa-truck mr-2"></i> Marquer comme expédiée
                                    </button>
                                </form>
                            @endif
                            
                            @if($commande->statut === 'expediee')
                                <div class="w-full bg-purple-100 text-purple-800 font-bold py-2 px-4 rounded-lg text-center">
                                    <i class="fas fa-shipping-fast mr-2"></i> Commande expédiée
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 