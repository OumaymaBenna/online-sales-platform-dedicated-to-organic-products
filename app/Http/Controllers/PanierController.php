<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Session;

class PanierController extends Controller
{
    public function ajouter(Request $request)
    {
        $produit_id = $request->input('produit_id');
        $produit = Produit::with('producteur')->findOrFail($produit_id);

        // Vérifier si le produit est disponible
        if (!$produit->disponible || $produit->getStockDisponible() <= 0) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ce produit n\'est plus disponible en stock.'
                ], 400);
            }
            return redirect()->back()->with('error', 'Ce produit n\'est plus disponible en stock.');
        }

        $cart = session()->get('cart', []);

        // Vérifier si on peut ajouter plus de ce produit
        $quantiteActuelle = isset($cart[$produit_id]) ? $cart[$produit_id]['quantite'] : 0;
        if ($quantiteActuelle >= $produit->getStockDisponible()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous ne pouvez pas ajouter plus de ' . $produit->getStockDisponible() . ' ' . $produit->unite . ' de ce produit.'
                ], 400);
            }
            return redirect()->back()->with('error', 'Vous ne pouvez pas ajouter plus de ' . $produit->getStockDisponible() . ' ' . $produit->unite . ' de ce produit.');
        }

        if (isset($cart[$produit_id])) {
            $cart[$produit_id]['quantite']++;
        } else {
            $cart[$produit_id] = [
                'id' => $produit->id,
                'nom' => $produit->nom,
                'prix' => $produit->prix,
                'quantite' => 1,
                'image' => $produit->image,
                'description' => $produit->description,
                'categorie' => $produit->categorie,
                'unite' => $produit->unite ?? 'unité',
                'disponible' => $produit->disponible,
                'producteur' => [
                    'id' => $produit->producteur ? $produit->producteur->id : null,
                    'nom_entreprise' => $produit->producteur ? $produit->producteur->nom_entreprise : 'Producteur inconnu',
                    'adresse' => $produit->producteur ? $produit->producteur->adresse : null,
                    'telephone' => $produit->producteur ? $produit->producteur->telephone : null,
                    'email' => $produit->producteur ? $produit->producteur->email : null,
                    'description' => $produit->producteur ? $produit->producteur->description : null,
                ],
                'date_ajout' => now()->toDateTimeString(),
            ];
        }

        session()->put('cart', $cart);

        // Si c'est une requête AJAX, retourner une réponse JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Produit ajouté au panier !',
                'cart_count' => array_sum(array_column($cart, 'quantite'))
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function supprimer(Request $request)
    {
        $produit_id = $request->input('produit_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$produit_id])) {
            unset($cart[$produit_id]);
            session()->put('cart', $cart);
        }

        // Si c'est une requête AJAX, retourner une réponse JSON avec le nouveau total
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => array_sum(array_column($cart, 'quantite'))
            ]);
        }

        return redirect()->back()->with('success', 'Produit supprimé du panier !');
    }

    public function mettreAJourQuantite(Request $request)
    {
        $produit_id = $request->input('produit_id');
        $quantite = $request->input('quantite');
        $cart = session()->get('cart', []);

        if (isset($cart[$produit_id])) {
            // Vérifier le stock disponible
            $produit = Produit::find($produit_id);
            if ($produit && !$produit->stockSuffisant($quantite)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuffisant. Disponible : ' . $produit->getStockDisponible() . ' ' . $produit->unite
                ], 400);
            }

            if ($quantite <= 0) {
                unset($cart[$produit_id]);
            } else {
                $cart[$produit_id]['quantite'] = $quantite;
            }
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function vider()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Le panier a été vidé.');
    }

    public function getCount()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantite'));
        
        return response()->json(['count' => $count]);
    }
}
