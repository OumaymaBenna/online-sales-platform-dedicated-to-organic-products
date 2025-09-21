<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    ProfileController,
    ProducteurController,
    ClientController,
    PaiementController,
    AvisController,
    AccueilController,
    PanierController,
    Auth\RegisteredUserController,
    WishlistController,
    ProduitController
};
use App\Http\Middleware\ProducteurMiddleware; // ✅ Import du middleware

// Page d'accueil
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

// Page À propos
Route::get('/about', [AccueilController::class, 'about'])->name('about');

// Page Contact
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Route pour récupérer les statistiques via AJAX
Route::get('/stats', [AccueilController::class, 'getStatsAjax'])->name('stats.ajax');

// Redirection vers dashboard spécifique après login
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->user_type === 'producteur') {
        return redirect()->route('producteur.dashboard');
    } else {
        return redirect()->route('client.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentification Laravel Breeze ou Jetstream
require __DIR__.'/auth.php';

// Surcharge de l'inscription (facultatif)
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

// Accessible à tous (invités et connectés)
Route::prefix('client')->group(function () {
    Route::get('/panier', [App\Http\Controllers\ClientController::class, 'panier'])->name('client.panier');
    Route::post('/panier/ajouter', [App\Http\Controllers\PanierController::class, 'ajouter'])->name('client.panier.ajouter');
    Route::post('/panier/supprimer', [App\Http\Controllers\PanierController::class, 'supprimer'])->name('client.panier.supprimer');
    Route::post('/panier/quantite', [App\Http\Controllers\PanierController::class, 'mettreAJourQuantite'])->name('client.panier.quantite');
    Route::get('/panier/count', [App\Http\Controllers\PanierController::class, 'getCount'])->name('client.panier.count');
});

// Routes pour utilisateurs authentifiés
Route::middleware('auth')->group(function () {

    // Gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes client
    Route::prefix('client')->group(function () {
        Route::get('/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
        Route::get('/commande', [ClientController::class, 'passerCommande'])->name('client.commande');
        Route::post('/commande/finaliser', [ClientController::class, 'finaliserCommande'])->name('client.commande.finaliser');
        Route::get('/produits', [ClientController::class, 'produits'])->name('client.produits');
        Route::get('/produits/{id}', [ClientController::class, 'show'])->name('client.produits.show');
        Route::get('/produits/{id}/edit', [ClientController::class, 'edit'])->name('client.produits.edit');
        Route::put('/produits/{id}', [ClientController::class, 'update'])->name('client.produits.update');
        Route::delete('/produits/{id}', [ClientController::class, 'destroy'])->name('client.produits.destroy');
        Route::post('/panier/vider', [PanierController::class, 'vider'])->name('client.panier.vider');
        Route::get('/paiement', [PaiementController::class, 'showForm'])->name('client.paiement');
        Route::post('/paiement/checkout', [PaiementController::class, 'checkout'])->name('client.paiement.checkout');
        Route::get('/paiement/success', [PaiementController::class, 'success'])->name('client.paiement.success');
        Route::get('/paiement/cancel', [PaiementController::class, 'cancel'])->name('client.paiement.cancel');

        // Routes wishlist sous /client
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');
        Route::delete('/wishlist/remove/{produit}', [WishlistController::class, 'destroy'])->name('wishlist.remove');
        Route::post('/wishlist/move-to-cart/{produit}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

        // Détails produit + avis (AJAX)
        Route::get('/produits/{id}/details', [App\Http\Controllers\ClientController::class, 'detailsProduitAjax']);
        // Ajouter un avis (AJAX)
        Route::post('/produits/{id}/avis', [App\Http\Controllers\AvisController::class, 'storeAjax']);
    });

    // ✅ Routes producteur avec classe middleware directement
    Route::middleware([ProducteurMiddleware::class])->prefix('producteur')->group(function () {
        Route::get('/dashboard', [ProducteurController::class, 'index'])->name('producteur.dashboard');
        Route::get('/produits/create', [ProducteurController::class, 'create'])->name('producteur.produits.create');
        Route::post('/produits', [ProducteurController::class, 'store'])->name('producteur.produits.store');
        Route::get('/produits/{id}', [ProducteurController::class, 'show'])->name('producteur.produits.show');
        Route::get('/produits/{id}/edit', [ProducteurController::class, 'editProduit'])->name('producteur.produits.edit');
        Route::put('/produits/{id}', [ProducteurController::class, 'update'])->name('producteur.produits.update');
        Route::delete('/produits/{id}', [ProducteurController::class, 'destroy'])->name('producteur.produits.destroy');
    });
});

// Paiement
Route::post('/paiement', [PaiementController::class, 'payer'])->name('paiement');

// Avis sur un produit
Route::post('/produits/{produit}/avis', [AvisController::class, 'store'])->name('avis.store');

Route::get('/wishlist/count', [App\Http\Controllers\WishlistController::class, 'count'])->name('wishlist.count');
// Wishlist routes
Route::post('/wishlist/{produit}/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::delete('/wishlist/{produit}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('client.wishlist');

// Route pour éditer le profil producteur
Route::get('/producteur/profil/edit', [App\Http\Controllers\ProducteurController::class, 'edit'])->name('producteur.profil.edit');

// Route pour mettre à jour le profil producteur (PATCH et avec ID)
Route::patch('/producteur/profil/{id}', [App\Http\Controllers\ProducteurController::class, 'update'])->name('producteur.profil.update');

Route::get('/producteur/profil/create', [\App\Http\Controllers\ProducteurController::class, 'createProfile'])->name('producteur.profil.create');
Route::post('/producteur/profil/store', [\App\Http\Controllers\ProducteurController::class, 'storeProfile'])->name('producteur.profil.store');
Route::post('/producteur/notifications/{id}/read', [\App\Http\Controllers\ProducteurController::class, 'markNotificationAsRead'])->name('producteur.notifications.markAsRead');
// Notifications producteur
    Route::post('/producteur/notifications/read-all', [App\Http\Controllers\ProducteurController::class, 'markAllNotificationsAsRead'])->name('producteur.notifications.readAll');
    
    // Routes pour les commandes producteur
    Route::get('/producteur/commandes', [App\Http\Controllers\ProducteurController::class, 'commandes'])->name('producteur.commandes');
    Route::get('/producteur/commandes/{id}', [App\Http\Controllers\ProducteurController::class, 'showCommande'])->name('producteur.commandes.show');
    Route::post('/producteur/commandes/{id}/confirmer', [App\Http\Controllers\ProducteurController::class, 'confirmerCommande'])->name('producteur.commande.confirmer');
    Route::post('/producteur/commandes/{id}/expedier', [App\Http\Controllers\ProducteurController::class, 'expedierCommande'])->name('producteur.commande.expedier');

Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');

// Routes publiques pour les producteurs
Route::get('/producteurs', [App\Http\Controllers\ProducteurController::class, 'liste'])->name('producteurs.liste');
Route::get('/producteurs/{id}', [App\Http\Controllers\ProducteurController::class, 'showPublic'])->name('producteurs.show');

Route::get('/producteur/dashboard/stats', [App\Http\Controllers\ProducteurController::class, 'dashboardStats'])->name('producteur.dashboard.stats');