@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="row g-0">
                    <div class="col-md-5 d-flex align-items-center justify-content-center bg-light p-4 rounded-start-4">
                        @if(isset($produit->image_url))
                            <img src="{{ $produit->image_url }}" alt="{{ $produit->nom }}" class="img-fluid rounded-3" style="max-height:320px;">
                        @else
                            <div class="text-muted text-center w-100">Aucune image</div>
                        @endif
                    </div>
                    <div class="col-md-7 p-4">
                        <h2 class="fw-bold mb-3">{{ $produit->nom ?? 'Produit' }}</h2>
                        <div class="mb-3">
                            <span class="badge bg-success fs-6">{{ number_format($produit->prix ?? 0, 2) }} TND</span>
                            @if(isset($produit->is_bio) && $produit->is_bio)
                                <span class="badge bg-primary ms-2">BIO</span>
                            @endif
                        </div>
                        <p class="mb-4">{{ $produit->description ?? 'Aucune description.' }}</p>
                        @if(isset($produit->producteur))
                            <div class="mb-3">
                                <i class="fas fa-user text-secondary me-1"></i>
                                <strong>Producteur :</strong> {{ $produit->producteur->nom ?? '-' }}
                            </div>
                        @endif
                        <div class="d-flex gap-2 mt-4">
                            <a href="/" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Retour à l'accueil
                            </a>
                            <button class="btn btn-success">
                                <i class="fas fa-cart-plus me-1"></i> Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 