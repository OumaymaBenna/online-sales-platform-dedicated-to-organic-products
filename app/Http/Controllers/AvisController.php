<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Avis;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NouveauCommentaireProduit;
use Illuminate\Support\Facades\Log;

class AvisController extends Controller
{
    public function store(Request $request, Produit $produit)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $avis = $produit->avis()->create([
            'user_id' => Auth::id(),
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        // Notifier le producteur
        if ($produit->producteur && $produit->producteur->user) {
            Log::info('Notification envoyée à : ' . $produit->producteur->user->email);
            $produit->producteur->user->notify(new NouveauCommentaireProduit([
                'client_nom' => Auth::user()->name ?? Auth::user()->nom ?? 'Client',
                'produit_nom' => $produit->nom,
                'commentaire' => $avis->commentaire,
                'note' => $avis->note,
            ]));
        }

        return redirect()->back()->with('success', 'Merci pour votre avis !');
    }

    public function storeAjax(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();
        $existing = Avis::where('user_id', $userId)
                        ->where('produit_id', $id)
                        ->first();

        if ($existing) {
            return response()->json(['error' => 'Vous avez déjà noté ce produit.'], 403);
        }

        $avis = Avis::create([
            'produit_id' => $id,
            'user_id' => $userId,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        // Notifier le producteur
        $produit = Produit::find($id);
        if ($produit && $produit->producteur && $produit->producteur->user) {
            $produit->producteur->user->notify(new NouveauCommentaireProduit([
                'client_nom' => Auth::user()->name ?? Auth::user()->nom ?? 'Client',
                'produit_nom' => $produit->nom,
                'commentaire' => $avis->commentaire,
                'note' => $avis->note,
            ]));
        }

        return response()->json(['success' => true]);
    }
}
