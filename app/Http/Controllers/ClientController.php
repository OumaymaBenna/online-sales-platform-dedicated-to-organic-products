<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Wishlist;

class ClientController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupération des catégories
        $categories = Produit::select('categorie')
            ->whereNotNull('categorie')
            ->where('categorie', '!=', '')
            ->distinct()
            ->pluck('categorie')
            ->take(5);

        // Produits populaires
        $produitsPopulaires = Produit::with('producteur')
            ->where('disponible', true)
            ->latest()
            ->take(4)
            ->get();

        // Panier
        $cart = session()->get('cart', []);
        $cartCount = count($cart);

        // Statistiques
        $totalProduits = Produit::where('disponible', true)->count();

        // Actions rapides
        $actionsRapides = [
            ['titre' => 'Boutique', 'icone' => 'fas fa-store', 'couleur' => 'primary', 'lien' => route('client.produits')],
            ['titre' => 'Panier', 'icone' => 'fas fa-shopping-cart', 'couleur' => 'green', 'lien' => route('client.panier')],
            ['titre' => 'Commandes', 'icone' => 'fas fa-clipboard-list', 'couleur' => 'blue', 'lien' => '#'],
            ['titre' => 'Favoris', 'icone' => 'fas fa-heart', 'couleur' => 'purple', 'lien' => '#'],
        ];

        // Notifications statiques
        $notifications = [
            ['titre' => 'Commande expédiée', 'message' => 'Votre commande #CMD-2854 a été expédiée', 'icone' => 'fas fa-truck', 'couleur' => 'green', 'temps' => 'Il y a 2 heures'],
            ['titre' => 'Promotion spéciale', 'message' => 'Nouveaux casques audio à -20% cette semaine', 'icone' => 'fas fa-percent', 'couleur' => 'blue', 'temps' => 'Hier, 15:32'],
            ['titre' => 'Avis en attente', 'message' => 'Donnez votre avis sur le produit "Smartwatch Pro"', 'icone' => 'fas fa-star', 'couleur' => 'yellow', 'temps' => '15 juin 2023'],
        ];

        return view('client.dashboard', compact(
            'user',
            'categories',
            'produitsPopulaires',
            'cartCount',
            'totalProduits',
            'actionsRapides',
            'notifications'
        ));
    }

    /**
     * Afficher les produits avec filtres et pagination
     */
    public function produits(Request $request)
    {
        $query = Produit::query();

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // On charge le producteur et les avis pour chaque produit
        $produits = $query->where('disponible', true)
            ->where('quantite', '>', 0)
            ->with(['producteur', 'avis'])
            ->withCount('wishlists')
            ->paginate(6);

        $userWishlist = [];
        if (Auth::check()) {
            $userWishlist = Wishlist::where('user_id', Auth::id())->pluck('produit_id')->toArray();
        }

        // Quantité de chaque produit dans le panier de l'utilisateur
        $cart = session('cart', []);
        $cartQuantities = [];
        foreach ($cart as $produit_id => $item) {
            $cartQuantities[$produit_id] = $item['quantite'];
        }

        return view('client.produits', compact('produits', 'userWishlist', 'cartQuantities'));
    }

    public function panier()
    {
        $cart = session()->get('cart', []);
        return view('client.panier', compact('cart'));
    }

    public function ajouterPanier(Request $request)
    {
        $produit_id = $request->input('produit_id');
        $produit = Produit::findOrFail($produit_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$produit_id])) {
            $cart[$produit_id]['quantite']++;
        } else {
            $cart[$produit_id] = [
                'nom' => $produit->nom,
                'prix' => $produit->prix,
                'quantite' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function passerCommande(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('client.panier')->with('error', 'Votre panier est vide.');
        }

        $user = Auth::user();
        $client = \App\Models\Client::where('user_id', $user->id)->first();

        return view('client.commande', compact('cart', 'user', 'client'));
    }

    public function finaliserCommande(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:500',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'pays' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('client.panier')->with('error', 'Votre panier est vide.');
        }

        try {
            $user = Auth::user();
            
            // Mettre à jour ou créer le profil client
            $client = \App\Models\Client::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'telephone' => $request->telephone,
                    'adresse' => $request->adresse,
                    'ville' => $request->ville,
                    'code_postal' => $request->code_postal,
                    'pays' => $request->pays,
                ]
            );

            // Mettre à jour les informations utilisateur
            \App\Models\User::where('id', $user->id)->update([
                'name' => $request->nom,
                'email' => $request->email,
            ]);

            // Calculer le total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['prix'] * $item['quantite'];
            }

            // Créer la commande
            $commande = \App\Models\Commande::create([
                'user_id' => $user->id,
                'numero_commande' => \App\Models\Commande::genererNumeroCommande(),
                'total' => $total,
                'statut' => 'en_attente',
                'methode_paiement' => 'direct',
                'adresse_livraison' => $request->adresse,
                'ville' => $request->ville,
                'code_postal' => $request->code_postal,
                'pays' => $request->pays,
                'telephone' => $request->telephone,
                'notes' => $request->notes,
                'date_commande' => now(),
            ]);

            // Enregistrer les produits de la commande et diminuer les quantités
            $producteursNotifies = [];
            foreach ($cart as $produitId => $item) {
                $produit = \App\Models\Produit::find($produitId);
                if ($produit) {
                    // Vérifier si le stock est suffisant
                    if (!$produit->stockSuffisant($item['quantite'])) {
                        // Annuler la commande si le stock est insuffisant
                        $commande->delete();
                        return redirect()->route('client.panier')->with('error', 'Stock insuffisant pour le produit "' . $produit->nom . '". Stock disponible : ' . $produit->getStockDisponible() . ' ' . $produit->unite);
                    }

                    $prixTotal = $item['prix'] * $item['quantite'];
                    
                    \App\Models\CommandeProduit::create([
                        'commande_id' => $commande->id,
                        'produit_id' => $produitId,
                        'producteur_id' => $produit->producteur_id,
                        'quantite' => $item['quantite'],
                        'prix_unitaire' => $item['prix'],
                        'prix_total' => $prixTotal,
                    ]);

                    // Diminuer la quantité du produit chez le producteur
                    $produit->diminuerStock($item['quantite']);

                    // Notifier le producteur (une seule fois par producteur)
                    if (!in_array($produit->producteur_id, $producteursNotifies)) {
                        $producteur = \App\Models\Producteur::find($produit->producteur_id);
                        if ($producteur) {
                            $userProducteur = \App\Models\User::find($producteur->user_id);
                            if ($userProducteur) {
                                $userProducteur->notify(new \App\Notifications\NouvelleCommande($commande, $produit->producteur_id));
                            }
                        }
                        $producteursNotifies[] = $produit->producteur_id;
                    }
                }
            }
            
            // Vider le panier
            session()->forget('cart');

            return redirect()->route('client.dashboard')->with('success', 'Votre commande a été passée avec succès ! Nous vous contacterons bientôt pour confirmer les détails de livraison.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la finalisation de commande: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Une erreur est survenue lors de la finalisation de votre commande: ' . $e->getMessage());
        }
    }

    public function viderPanier()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Le panier a été vidé.');
    }

    /**
     * Retourne les détails d'un produit au format JSON pour la modale AJAX
     */
    public function detailsProduitAjax($id)
    {
        $produit = \App\Models\Produit::with(['producteur', 'avis.user'])->findOrFail($id);
        $user = Auth::user();

        $producteurNom = $produit->producteur ? $produit->producteur->nom_entreprise : 'Producteur inconnu';
        $inWishlist = false;
        if ($user && method_exists($user, 'wishlist')) {
            $inWishlist = $user->wishlist->contains($produit->id);
        }
        $moyenne = $produit->avis->count() ? round($produit->avis->avg('note'), 1) : null;
        $avis = $produit->avis->map(function($a) {
            $userName = ($a->relationLoaded('user') && $a->user) ? $a->user->name : 'Client';
            return [
                'note' => $a->note,
                'commentaire' => $a->commentaire,
                'user' => $userName,
                'date' => $a->created_at ? $a->created_at->format('d/m/Y') : null
            ];
        });

        return response()->json([
            'id' => $produit->id,
            'nom' => $produit->nom,
            'prix' => $produit->prix,
            'categorie' => $produit->categorie,
            'description' => $produit->description,
            'producteur' => $producteurNom,
            'image' => $produit->image ? asset('storage/' . $produit->image) : null,
            'inWishlist' => $inWishlist,
            'isAuth' => (bool) $user,
            'moyenne' => $moyenne,
            'avis' => $avis,
        ]);
    }

    /**
     * Supprimer un produit (action côté client)
     */
    public function destroy($id)
    {
        $produit = \App\Models\Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('client.produits')->with('success', 'Produit supprimé avec succès.');
    }

    public function paiement()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        return view('client.paiement', compact('total'));
    }

    public function effectuerPaiement(Request $request)
    {
        // Ici, on simule un paiement réussi
        // On peut enregistrer la commande ici si besoin
        session()->forget('cart');
        return redirect()->route('client.dashboard')->with('success', 'Paiement effectué et commande enregistrée !');
    }
}
