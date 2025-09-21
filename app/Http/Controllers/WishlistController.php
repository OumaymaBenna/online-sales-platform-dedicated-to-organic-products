<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Ajouter/retirer un produit de la wishlist
    public function toggle(Produit $produit)
    {
        $user = Auth::user();
        
        if ($user->wishlist()->where('produit_id', $produit->id)->exists()) {
            $user->wishlist()->detach($produit->id);
            $action = 'removed';
        } else {
            $user->wishlist()->attach($produit->id);
            $action = 'added';
        }
        
        return response()->json([
            'success' => true,
            'action' => $action,
            'wishlistCount' => $user->wishlist()->count()
        ]);
    }
    
    // Retirer un produit de la wishlist
    public function remove(Produit $produit)
    {
        Auth::user()->wishlist()->detach($produit->id);
        
        return response()->json([
            'success' => true,
            'message' => 'Produit retiré de vos favoris'
        ]);
    }
    
    // Afficher la page wishlist
    public function index()
    {
        $user = Auth::user();
        $wishlistItems = $user->wishlist()->with('producteur')->get();
        
        return view('client.wishlist', [
            'wishlistItems' => $wishlistItems
        ]);
    }
    
    // Déplacer un produit de la wishlist au panier
    public function moveToCart(Produit $produit, Request $request)
    {
        $user = Auth::user();
        // Ajouter au panier (session)
        $cart = session()->get('cart', []);
        $produit_id = $produit->id;
        if (isset($cart[$produit_id])) {
            $cart[$produit_id]['quantite']++;
        } else {
            $cart[$produit_id] = [
                'nom' => $produit->nom,
                'prix' => $produit->prix,
                'quantite' => 1,
                'image' => $produit->image,
            ];
        }
        session()->put('cart', $cart);
        // Retirer de la wishlist
        $user->wishlist()->detach($produit_id);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Produit déplacé au panier',
                'cartCount' => count($cart)
            ]);
        }
        return redirect()->back()->with('success', 'Produit déplacé au panier !');
    }
}