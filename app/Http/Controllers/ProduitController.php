<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'unite' => 'required|string|max:50',
            'categorie' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        }

        // Associer le producteur connecté si besoin (exemple)
        // $validated['producteur_id'] = auth()->user()->id;

        Produit::create($validated);

        return redirect()->back()->with('success', 'Produit ajouté avec succès !');
    }
}
