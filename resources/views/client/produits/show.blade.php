@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="md:w-1/2">
                        @if($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-72 object-cover rounded-lg mb-4">
                        @else
                            <div class="w-full h-72 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                                <span class="text-gray-500">Aucune image</span>
                            </div>
                        @endif
                        <form action="{{ route('client.wishlist.toggle', $produit->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-3xl {{ $user->wishlist->contains('produit_id', $produit->id) ? 'text-red-500' : 'text-gray-400' }}">
                                <i class="fas fa-heart{{ $user->wishlist->contains('produit_id', $produit->id) ? '' : '-o' }}"></i>
                            </button>
                        </form>
                    </div>
                    <div class="md:w-1/2 flex flex-col gap-4">
                        <h2 class="text-2xl font-bold mb-2">{{ $produit->nom }}</h2>
                        <div class="text-lg text-green-600 font-semibold mb-2">{{ number_format($produit->prix, 2) }} €</div>
                        <div class="mb-2">
                            <span class="font-medium">Catégorie :</span> {{ $produit->categorie }}
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Stock :</span> {{ $produit->quantite }} {{ $produit->unite }}
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Description :</span>
                            <p class="text-gray-700 dark:text-gray-300">{{ $produit->description }}</p>
                        </div>
                        <form action="{{ route('client.panier.ajouter') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                            <button type="submit" class="primary-button bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-lg flex items-center">
                                <i class="fas fa-cart-plus mr-2"></i> Ajouter au panier
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-8">

                <!-- Moyenne des avis -->
                @php
                    $moyenne = $produit->avis()->avg('note');
                @endphp
                <div class="flex items-center mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star{{ $i <= round($moyenne) ? '' : '-o' }} text-yellow-400"></i>
                    @endfor
                    <span class="ml-2 text-sm text-gray-600">({{ number_format($moyenne, 1) }}/5)</span>
                </div>

                <!-- Formulaire d'avis -->
                @if(auth()->check())
                    @php
                        $userAvis = $produit->avis()->where('user_id', auth()->id())->first();
                    @endphp
                    @if(!$userAvis)
                        <form action="{{ route('client.avis.ajouter', $produit->id) }}" method="POST" class="mb-6">
                            @csrf
                            <div class="mb-3">
                                <label class="block font-semibold mb-1">Votre note :</label>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label>
                                            <input type="radio" name="note" value="{{ $i }}" class="hidden" required>
                                            <i class="fas fa-star text-2xl text-yellow-400 cursor-pointer"></i>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="block font-semibold mb-1">Commentaire (facultatif) :</label>
                                <textarea name="commentaire" rows="2" class="w-full rounded-lg border-gray-300"></textarea>
                            </div>
                            <button type="submit" class="primary-button bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-lg">Envoyer mon avis</button>
                        </form>
                    @else
                        <div class="mb-6 text-green-700 font-semibold">
                            Vous avez déjà laissé un avis pour ce produit.
                        </div>
                    @endif
                @endif

                <!-- Liste des avis -->
                <div class="space-y-3">
                    @foreach($produit->avis()->latest()->get() as $avis)
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="flex items-center mb-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $avis->note ? '' : '-o' }} text-yellow-400 text-sm"></i>
                                @endfor
                                <span class="ml-2 text-xs text-gray-500">{{ $avis->user->name ?? 'Utilisateur' }}</span>
                            </div>
                            <div class="text-gray-700 text-sm">{{ $avis->commentaire }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 