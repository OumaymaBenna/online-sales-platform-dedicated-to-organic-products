<?php

namespace App\Http\Controllers;

use App\Models\Produit; // Assure-toi que ce modèle existe
use App\Models\Producteur;
use App\Models\Client;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AccueilController extends Controller
{
    /**
     * Récupérer les statistiques de la plateforme
     */
    private function getStats()
    {
        return [
            'producteurs' => Producteur::count(),
            'produits' => Produit::where('disponible', true)->where('quantite', '>', 0)->count(),
            'clients' => Client::count(),
            'commandes' => Commande::count(),
            'annee_creation' => 2025
        ];
    }

    public function index()
    {
        $categories = collect([
            (object)['id' => 1, 'nom' => 'Tous les produits', 'icon' => 'fa-seedling', 'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80'],
            (object)['id' => 2, 'nom' => 'Fruits & Légumes', 'icon' => 'fa-apple-alt', 'image' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=400&q=80'],
            (object)['id' => 3, 'nom' => "Huile d'olive", 'icon' => 'fa-wine-bottle', 'image' => 'https://images.unsplash.com/photo-1603665270146-8c22e11d0f01?auto=format&fit=crop&w=400&q=80'],
            (object)['id' => 4, 'nom' => 'Miel & Produits de la ruche', 'icon' => 'fa-honey-pot', 'image' => 'https://images.unsplash.com/photo-1558645836-e44122a743ee?auto=format&fit=crop&w=400&q=80'],
            (object)['id' => 5, 'nom' => 'Produits laitiers', 'icon' => 'fa-cheese', 'image' => 'https://images.unsplash.com/photo-1617196034796-73dfa7b1fd56?auto=format&fit=crop&w=400&q=80'],
            (object)['id' => 6, 'nom' => 'Herbes & Épices', 'icon' => 'fa-leaf', 'image' => 'https://images.unsplash.com/photo-1598791318875-444da6b7d4b6?auto=format&fit=crop&w=400&q=80'],
            (object)['id' => 7, 'nom' => 'Produits biologiques', 'icon' => 'fa-recycle', 'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=400&q=80'],
            (object)['id' => 8, 'nom' => 'Produits artisanaux', 'icon' => 'fa-hands', 'image' => 'https://images.unsplash.com/photo-1603569283847-aa295f0d016a?auto=format&fit=crop&w=400&q=80'],
        ]);
        $nouveauxProduits = Produit::with('producteur')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        $producteurs = Producteur::all();
        $avis = \App\Models\Avis::all();

        // Utiliser la méthode helper pour les statistiques
        $stats = $this->getStats();

        return view('welcome', compact(
            'categories',
            'nouveauxProduits',
            'producteurs',
            'avis',
            'stats'
        ));
    }

    /**
     * Afficher la page À propos
     */
    public function about()
    {
        // Utiliser la méthode helper pour les statistiques
        $stats = $this->getStats();

        return view('about', compact('stats'));
    }

    /**
     * Récupérer les statistiques via AJAX
     */
    public function getStatsAjax()
    {
        $stats = $this->getStats();
        
        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }
}
