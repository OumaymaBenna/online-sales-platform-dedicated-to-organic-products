<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails du produit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">{{ $produit->nom }}</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('producteur.produits.edit', $produit->id) }}" 
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Modifier
                            </a>
                            <a href="{{ route('producteur.dashboard') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Retour
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if($produit->image)
                                <img src="{{ Storage::url($produit->image) }}" 
                                     alt="{{ $produit->nom }}" 
                                     class="w-full h-64 object-cover rounded-lg">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500">Aucune image</span>
                                </div>
                            @endif
                        </div>

                        <div>
                            <div class="mb-4">
                                <h4 class="font-semibold text-lg mb-2">Description</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $produit->description }}</p>
                            </div>

                            <div class="mb-4">
                                <h4 class="font-semibold text-lg mb-2">Informations</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="font-medium">Prix:</span>
                                        <span class="font-bold text-green-600">{{ number_format($produit->prix, 2) }} DT</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium">Stock:</span>
                                        <span>{{ $produit->quantite }} {{ $produit->unite }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium">Catégorie:</span>
                                        <span>{{ $produit->categorie }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium">Statut:</span>
                                        <span class="{{ $produit->disponible ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $produit->disponible ? 'Disponible' : 'Indisponible' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="font-semibold text-lg mb-2">Actions</h4>
                                <form action="{{ route('producteur.produits.destroy', $produit->id) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                        Supprimer le produit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 