<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Commande;
use App\Models\CommandeProduit;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Producteur;
use App\Models\User;
use App\Notifications\NouvelleCommande;

class PaiementController extends Controller
{
    public function showForm()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        return view('client.paiement', compact('total'));
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('client.panier')->with('error', 'Votre panier est vide.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];
        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur', // ou 'usd', 'tnd' si supporté
                    'product_data' => [
                        'name' => $item['nom'],
                    ],
                    'unit_amount' => intval($item['prix'] * 100), // en centimes
                ],
                'quantity' => $item['quantite'],
            ];
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('client.paiement.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('client.paiement.cancel', [], true),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        try {
            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return redirect()->route('client.panier')->with('error', 'Panier vide.');
            }

            $user = Auth::user();
            $client = \App\Models\Client::where('user_id', $user->id)->first();

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
                'methode_paiement' => 'stripe',
                'transaction_id' => $request->get('session_id'),
                'adresse_livraison' => $client->adresse ?? '',
                'ville' => $client->ville ?? '',
                'code_postal' => $client->code_postal ?? '',
                'pays' => $client->pays ?? '',
                'telephone' => $client->telephone ?? '',
                'date_commande' => now(),
            ]);

            // Enregistrer les produits de la commande, diminuer les quantités et notifier les producteurs
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
                            $userProducteur = User::find($producteur->user_id);
                            if ($userProducteur) {
                                $userProducteur->notify(new NouvelleCommande($commande, $produit->producteur_id));
                            }
                        }
                        $producteursNotifies[] = $produit->producteur_id;
                    }
                }
            }

            // Vider le panier
            session()->forget('cart');

            // Déclencher la mise à jour des statistiques
            session()->flash('stats_updated', true);

            return view('client.paiement_success', compact('commande'));

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement de la commande: ' . $e->getMessage());
            return redirect()->route('client.panier')->with('error', 'Erreur lors de l\'enregistrement de la commande.');
        }
    }

    public function cancel()
    {
        return view('client.paiement_cancel');
    }
}
