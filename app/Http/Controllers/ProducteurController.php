<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Producteur;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StockFaible;

class ProducteurController extends Controller
{
    public function create()
    {
        return view('producteur.produits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'unite' => 'required|string|max:50',
            'categorie' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $producteur = Producteur::where('user_id', auth()->id())->first();

        if (!$producteur || !$producteur->isProfileComplete()) {
            return redirect()->route('producteur.profil.create')
                ->withErrors(['error' => "Vous devez compléter votre profil de producteur avant d'ajouter un produit."]);
        }

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('produits', 'public') 
            : null;

        $produit = Produit::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'unite' => $request->unite,
            'categorie' => $request->categorie,
            'image' => $imagePath,
            'producteur_id' => $producteur->id,
            'disponible' => true,
        ]);

        // Vérifier le stock faible après l'ajout
        $this->verifierStockFaible($produit);

        // Déclencher la mise à jour des statistiques
        session()->flash('stats_updated', true);

        return redirect()->route('producteur.dashboard')->with('success', 'Produit ajouté avec succès.');
    }

    public function index()
    {
        $producteur = Producteur::where('user_id', auth()->id())->first();

        if (!$producteur) {
            return redirect()->route('producteur.profil.create')
                ->withErrors(['error' => "Aucun profil producteur trouvé."]);
        }

        $produits = $producteur->produits()->latest()->get();
        $user = Auth::user();
        $notifications = $user->notifications()->take(10)->get();
        $unreadCount = $user->unreadNotifications()->count();

        return view('producteur.dashboard', compact('produits', 'notifications', 'unreadCount'));
    }

    public function edit()
    {
        $producteur = Producteur::where('user_id', auth()->id())->first();

        if (!$producteur) {
            return redirect()->route('dashboard')->withErrors(['error' => "Aucun profil producteur trouvé pour cet utilisateur."]);
        }

        $produits = $producteur->produits()->latest()->get();
        return view('producteur.edit', compact('producteur', 'produits'));
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $producteur = Producteur::where('user_id', auth()->id())->first();

        if (!$producteur || $produit->producteur_id !== $producteur->id) {
            return redirect()->route('producteur.dashboard')->withErrors(['error' => 'Action non autorisée.']);
        }

        $produit->delete();
        return redirect()->route('producteur.dashboard')->with('success', 'Produit supprimé avec succès.');
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        $producteur = Producteur::where('user_id', auth()->id())->first();

        if (!$producteur || $produit->producteur_id !== $producteur->id) {
            abort(403, 'Action non autorisée.');
        }

        return view('producteur.produits.show', compact('produit'));
    }

    public function editProduit($id)
    {
        $producteur = Producteur::where('user_id', auth()->id())->first();

        $produit = Produit::where('id', $id)
            ->where('producteur_id', $producteur->id)
            ->firstOrFail();

        return view('producteur.produits.edit', compact('produit'));
    }

    public function update(Request $request, $id)
    {
        $producteur = Producteur::where('user_id', auth()->id())->first();

        $produit = Produit::where('id', $id)
            ->where('producteur_id', $producteur->id)
            ->firstOrFail();

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'unite' => 'required|string|max:50',
            'categorie' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            $produit->image = $request->file('image')->store('produits', 'public');
        }

        $produit->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'unite' => $request->unite,
            'categorie' => $request->categorie,
        ]);

        // Vérifier le stock faible après la mise à jour
        $this->verifierStockFaible($produit);

        return redirect()->route('producteur.dashboard')->with('success', 'Produit mis à jour avec succès.');
    }

    public function createProfile()
    {
        return view('producteur.profil.create');
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'nom_entreprise' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'description' => 'required|string|max:1000',
        ]);

        Producteur::create([
            'user_id' => auth()->id(),
            'nom_entreprise' => $request->nom_entreprise,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'description' => $request->description,
        ]);

        return redirect()->route('producteur.dashboard')->with('success', 'Profil producteur créé avec succès !');
    }

    /**
     * Marquer une notification comme lue
     */
    public function markNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return back();
    }

    /**
     * Marquer toutes les notifications comme lues
     */
    public function markAllNotificationsAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }

    /**
     * Afficher les commandes du producteur
     */
    public function commandes()
    {
        $user = Auth::user();
        $producteur = Producteur::where('user_id', $user->id)->first();
        
        if (!$producteur) {
            return redirect()->route('producteur.profil.create')->with('error', 'Veuillez d\'abord créer votre profil producteur.');
        }

        $commandes = \App\Models\Commande::pourProducteur($producteur->id)
            ->with(['user', 'produits.produit'])
            ->orderBy('date_commande', 'desc')
            ->paginate(10);

        return view('producteur.commandes', compact('commandes', 'producteur'));
    }

    /**
     * Afficher les détails d'une commande
     */
    public function showCommande($id)
    {
        $user = Auth::user();
        $producteur = Producteur::where('user_id', $user->id)->first();
        
        $commande = \App\Models\Commande::with(['user', 'produits.produit'])
            ->whereHas('produits', function($query) use ($producteur) {
                $query->where('producteur_id', $producteur->id);
            })
            ->findOrFail($id);

        return view('producteur.commande_show', compact('commande', 'producteur'));
    }

    /**
     * Confirmer une commande
     */
    public function confirmerCommande($id)
    {
        $user = Auth::user();
        $producteur = Producteur::where('user_id', $user->id)->first();
        
        $commande = \App\Models\Commande::with(['user', 'produits.produit'])
            ->whereHas('produits', function($query) use ($producteur) {
                $query->where('producteur_id', $producteur->id);
            })
            ->findOrFail($id);

        $commande->update(['statut' => 'confirmee']);

        // Notifier le client que sa commande a été confirmée (sans email pour éviter les erreurs SMTP)
        try {
            $commande->user->notify(new \App\Notifications\CommandeConfirmee($commande));
        } catch (\Exception $e) {
            // En cas d'erreur d'envoi d'email, on continue sans bloquer l'action
            \Log::warning('Erreur lors de l\'envoi de notification email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Commande confirmée avec succès !');
    }

    /**
     * Marquer une commande comme expédiée
     */
    public function expedierCommande($id)
    {
        $user = Auth::user();
        $producteur = Producteur::where('user_id', $user->id)->first();
        
        $commande = \App\Models\Commande::with(['user', 'produits.produit'])
            ->whereHas('produits', function($query) use ($producteur) {
                $query->where('producteur_id', $producteur->id);
            })
            ->findOrFail($id);

        $commande->update(['statut' => 'expediee']);

        return redirect()->back()->with('success', 'Commande marquée comme expédiée !');
    }

    /**
     * Vérifier si le stock d'un produit est faible (≤ 10 kg/litres)
     */
    private function verifierStockFaible($produit)
    {
        $seuilAlerte = 10;
        $user = $produit->producteur->user;

        if ($produit->quantite == $seuilAlerte) {
            // Notification stock faible (10)
            $notificationExistante = $user->notifications()
                ->where('type', 'App\\Notifications\\StockFaible')
                ->whereJsonContains('data->produit_nom', $produit->nom)
                ->whereJsonContains('data->quantite_restante', $produit->quantite)
                ->first();
            if (!$notificationExistante) {
                $user->notify(new StockFaible([
                    'message' => "Attention ! Il ne reste que 10 {$produit->unite} pour le produit '{$produit->nom}'.",
                    'produit_nom' => $produit->nom,
                    'quantite_restante' => $produit->quantite,
                    'unite' => $produit->unite,
                    'seuil_alerte' => $seuilAlerte,
                ]));
            }
        }
        if ($produit->quantite == 0) {
            // Notification rupture de stock
            $notificationExistante = $user->notifications()
                ->where('type', 'App\\Notifications\\StockFaible')
                ->whereJsonContains('data->produit_nom', $produit->nom)
                ->whereJsonContains('data->quantite_restante', 0)
                ->first();
            if (!$notificationExistante) {
                $user->notify(new StockFaible([
                    'message' => "Rupture de stock ! Le produit '{$produit->nom}' est épuisé.",
                    'produit_nom' => $produit->nom,
                    'quantite_restante' => 0,
                    'unite' => $produit->unite,
                    'seuil_alerte' => $seuilAlerte,
                ]));
            }
            // Rendre le produit indisponible
            $produit->disponible = false;
            $produit->save();
        }
    }

    /**
     * Méthode statique pour vérifier le stock faible (appelée depuis le modèle Produit)
     */
    public static function verifierStockFaibleStatic($produit)
    {
        $seuilAlerte = 10;
        $user = $produit->producteur->user;

        if ($produit->quantite <= $seuilAlerte) {
            // Notification stock faible
            $notificationExistante = $user->notifications()
                ->where('type', 'App\\Notifications\\StockFaible')
                ->whereJsonContains('data->produit_nom', $produit->nom)
                ->whereJsonContains('data->quantite_restante', $produit->quantite)
                ->first();
            if (!$notificationExistante) {
                $user->notify(new \App\Notifications\StockFaible([
                    'message' => "Attention ! Il ne reste que {$produit->quantite} {$produit->unite} pour le produit '{$produit->nom}'.",
                    'produit_nom' => $produit->nom,
                    'quantite_restante' => $produit->quantite,
                    'unite' => $produit->unite,
                    'seuil_alerte' => $seuilAlerte,
                ]));
            }
        }
    }

    /**
     * Afficher la liste de tous les producteurs (public)
     */
    public function liste(Request $request)
    {
        $query = Producteur::with(['user', 'produits'])
            ->whereHas('user', function($query) {
                $query->where('user_type', 'producteur');
            });

        // Recherche par nom d'entreprise
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom_entreprise', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('adresse', 'like', '%' . $search . '%');
            });
        }

        $producteurs = $query->orderBy('nom_entreprise')->paginate(12);

        return view('producteurs.liste', compact('producteurs'));
    }

    /**
     * Afficher le profil public d'un producteur
     */
    public function showPublic($id)
    {
        $producteur = Producteur::with(['user', 'produits' => function($query) {
            $query->where('disponible', true)->where('quantite', '>', 0);
        }])->findOrFail($id);

        return view('producteurs.show', compact('producteur'));
    }

    /**
     * Afficher le dashboard statistique du producteur
     */
    public function dashboardStats()
    {
        $user = Auth::user();
        $producteur = Producteur::where('user_id', $user->id)->first();
        if (!$producteur) {
            return redirect()->route('producteur.profil.create')->with('error', 'Veuillez d\'abord créer votre profil producteur.');
        }
        // Statistiques produits
        $nbProduits = $producteur->produits()->count();
        // Statistiques commandes
        $nbCommandes = \App\Models\Commande::pourProducteur($producteur->id)->count();
        // Statistiques bénéfices
        $beneficesJour = \App\Models\CommandeProduit::where('producteur_id', $producteur->id)
            ->whereDate('created_at', now()->toDateString())
            ->sum('prix_total');
        $beneficesSemaine = \App\Models\CommandeProduit::where('producteur_id', $producteur->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('prix_total');
        $beneficesAnnee = \App\Models\CommandeProduit::where('producteur_id', $producteur->id)
            ->whereYear('created_at', now()->year)
            ->sum('prix_total');
        // Produits à réapprovisionner (≤ 10)
        $produitsAlerte = $producteur->produits()->where('quantite', '<=', 10)->get();
        return view('producteur.dashboard_stats', compact('nbProduits', 'nbCommandes', 'beneficesJour', 'beneficesSemaine', 'beneficesAnnee', 'produitsAlerte'));
    }
}
