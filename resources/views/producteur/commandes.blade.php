<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - MaBoutique</title>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
                <i class="fas fa-shopping-bag text-green-600 mr-3"></i>
                Mes Commandes
            </h1>

            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded-lg">
                    <p><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</p>
                </div>
            @endif

            @if($commandes->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Commande</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Produits</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($commandes as $commande)
                                    <tr class="hover:bg-green-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $commande->numero_commande }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $commande->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $commande->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                @foreach($commande->produits->where('producteur_id', $producteur->id) as $commandeProduit)
                                                    <div class="mb-2 p-2 bg-green-50 rounded-lg border border-green-200">
                                                        <div class="font-medium text-green-800">
                                                            {{ $commandeProduit->produit->nom }}
                                                        </div>
                                                        <div class="text-xs text-green-600">
                                                            📦 {{ $commandeProduit->quantite }} {{ $commandeProduit->produit->unite }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ number_format($commandeProduit->prix_unitaire, 2) }} DT/{{ $commandeProduit->produit->unite }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ number_format($commande->produits->where('producteur_id', $producteur->id)->sum('prix_total'), 2) }} DT
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($commande->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                                @elseif($commande->statut === 'confirmee') bg-blue-100 text-blue-800
                                                @elseif($commande->statut === 'expediee') bg-purple-100 text-purple-800
                                                @elseif($commande->statut === 'livree') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                            </span>
                                            
                                            <!-- Actions rapides -->
                                            <div class="mt-2 space-y-1">
                                                @if($commande->statut === 'en_attente')
                                                    <form action="{{ route('producteur.commande.confirmer', $commande->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded transition duration-200" onclick="return confirm('Confirmer cette commande ?')">
                                                            <i class="fas fa-check mr-1"></i> Confirmer
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                @if($commande->statut === 'confirmee')
                                                    <form action="{{ route('producteur.commande.expedier', $commande->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded transition duration-200" onclick="return confirm('Marquer comme expédiée ?')">
                                                            <i class="fas fa-truck mr-1"></i> Expédier
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $commande->date_commande->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('producteur.commandes.show', $commande->id) }}" 
                                               class="text-green-600 hover:text-green-900 mr-3">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    {{ $commandes->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                    <div class="flex justify-center mb-6">
                        <i class="fas fa-shopping-bag text-gray-300 text-6xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune commande reçue</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas encore reçu de commandes.</p>
                    <a href="{{ route('producteur.produits.create') }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-plus mr-2"></i> Ajouter des produits
                    </a>
                </div>
            @endif
        </div>
    </div>

    <footer class="bg-white border-t mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-2 mb-2 md:mb-0">
                <span class="text-2xl">🇹🇳</span>
                <span class="text-gray-700 font-semibold">Boutique tunisienne</span>
            </div>
            <div class="text-gray-600 text-sm text-center md:text-right">
                <div>Adresse : 12 Avenue de la Liberté, Tunis, Tunisie</div>
                <div>Tél : +216 12 345 678</div>
                <div>Email : <a href="mailto:contact@boutiquetunisie.tn" class="text-green-700 hover:underline">contact@boutiquetunisie.tn</a></div>
                <div class="mt-1 text-gray-500">&copy; {{ date('Y') }} Boutique Tunisie - Tous droits réservés.</div>
            </div>
        </div>
    </footer>
</body>
</html> 