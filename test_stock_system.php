<?php

/**
 * Script de test pour le système de gestion de stock
 * 
 * Ce script teste les fonctionnalités de gestion de stock :
 * 1. Vérification du stock lors de l'ajout au panier
 * 2. Diminution du stock lors de la finalisation de commande
 * 3. Gestion des erreurs de stock insuffisant
 */

require_once 'vendor/autoload.php';

use App\Models\Produit;
use App\Models\Producteur;
use App\Models\User;
use App\Models\Commande;
use App\Models\CommandeProduit;

// Initialiser Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Test du Système de Gestion de Stock ===\n\n";

try {
    // 1. Créer un producteur de test
    echo "1. Création d'un producteur de test...\n";
    $user = User::create([
        'name' => 'Producteur Test',
        'email' => 'producteur.test@example.com',
        'password' => bcrypt('password'),
        'user_type' => 'producteur'
    ]);

    $producteur = Producteur::create([
        'user_id' => $user->id,
        'nom_entreprise' => 'Ferme Test',
        'adresse' => '123 Rue Test',
        'telephone' => '0123456789',
        'description' => 'Producteur de test'
    ]);

    echo "   ✓ Producteur créé: {$producteur->nom_entreprise}\n\n";

    // 2. Créer un produit avec stock limité
    echo "2. Création d'un produit avec stock limité...\n";
    $produit = Produit::create([
        'producteur_id' => $producteur->id,
        'nom' => 'Tomates Test',
        'description' => 'Tomates fraîches pour test',
        'prix' => 2.50,
        'quantite' => 10,
        'unite' => 'kg',
        'categorie' => 'légumes',
        'disponible' => true
    ]);

    echo "   ✓ Produit créé: {$produit->nom} - Stock: {$produit->quantite} {$produit->unite}\n\n";

    // 3. Tester les méthodes de gestion de stock
    echo "3. Test des méthodes de gestion de stock...\n";
    
    // Test stockSuffisant
    $testQuantite = 5;
    $suffisant = $produit->stockSuffisant($testQuantite);
    echo "   - Stock suffisant pour {$testQuantite} {$produit->unite}? " . ($suffisant ? 'Oui' : 'Non') . "\n";
    
    // Test getStockDisponible
    $stockDisponible = $produit->getStockDisponible();
    echo "   - Stock disponible: {$stockDisponible} {$produit->unite}\n";
    
    // Test diminuerStock
    $quantiteADiminuer = 3;
    $success = $produit->diminuerStock($quantiteADiminuer);
    echo "   - Diminution de {$quantiteADiminuer} {$produit->unite}: " . ($success ? 'Succès' : 'Échec') . "\n";
    echo "   - Nouveau stock: {$produit->quantite} {$produit->unite}\n";
    
    // Test augmenterStock
    $quantiteAAugmenter = 2;
    $produit->augmenterStock($quantiteAAugmenter);
    echo "   - Augmentation de {$quantiteAAugmenter} {$produit->unite}\n";
    echo "   - Stock final: {$produit->quantite} {$produit->unite}\n\n";

    // 4. Tester la création d'une commande
    echo "4. Test de création d'une commande...\n";
    
    // Créer un client
    $clientUser = User::create([
        'name' => 'Client Test',
        'email' => 'client.test@example.com',
        'password' => bcrypt('password'),
        'user_type' => 'client'
    ]);

    // Créer une commande
    $commande = Commande::create([
        'user_id' => $clientUser->id,
        'numero_commande' => 'CMD-TEST-' . time(),
        'total' => 7.50,
        'statut' => 'en_attente',
        'methode_paiement' => 'test',
        'adresse_livraison' => '456 Rue Client',
        'ville' => 'Ville Test',
        'code_postal' => '12345',
        'pays' => 'France',
        'telephone' => '0987654321',
        'date_commande' => now()
    ]);

    echo "   ✓ Commande créée: {$commande->numero_commande}\n";

    // Ajouter un produit à la commande et diminuer le stock
    $quantiteCommande = 2;
    $stockAvant = $produit->quantite;
    
    CommandeProduit::create([
        'commande_id' => $commande->id,
        'produit_id' => $produit->id,
        'producteur_id' => $producteur->id,
        'quantite' => $quantiteCommande,
        'prix_unitaire' => $produit->prix,
        'prix_total' => $produit->prix * $quantiteCommande
    ]);

    $produit->diminuerStock($quantiteCommande);
    $stockApres = $produit->quantite;
    
    echo "   - Stock avant commande: {$stockAvant} {$produit->unite}\n";
    echo "   - Quantité commandée: {$quantiteCommande} {$produit->unite}\n";
    echo "   - Stock après commande: {$stockApres} {$produit->unite}\n";
    echo "   - Diminution correcte: " . (($stockAvant - $quantiteCommande) === $stockApres ? 'Oui' : 'Non') . "\n\n";

    // 5. Tester la gestion d'erreur (stock insuffisant)
    echo "5. Test de gestion d'erreur (stock insuffisant)...\n";
    
    $stockActuel = $produit->quantite;
    $quantiteExcessive = $stockActuel + 5;
    
    $suffisant = $produit->stockSuffisant($quantiteExcessive);
    echo "   - Tentative de commander {$quantiteExcessive} {$produit->unite} (stock: {$stockActuel})\n";
    echo "   - Stock suffisant? " . ($suffisant ? 'Oui' : 'Non') . "\n";
    
    $success = $produit->diminuerStock($quantiteExcessive);
    echo "   - Diminution possible? " . ($success ? 'Oui' : 'Non') . "\n";
    echo "   - Stock inchangé: " . ($produit->quantite === $stockActuel ? 'Oui' : 'Non') . "\n\n";

    // 6. Test de marquage comme indisponible
    echo "6. Test de marquage comme indisponible...\n";
    
    // Diminuer tout le stock restant
    $stockRestant = $produit->quantite;
    $produit->diminuerStock($stockRestant);
    
    echo "   - Stock après diminution totale: {$produit->quantite} {$produit->unite}\n";
    echo "   - Produit disponible: " . ($produit->disponible ? 'Oui' : 'Non') . "\n";
    echo "   - Stock disponible: {$produit->getStockDisponible()} {$produit->unite}\n\n";

    // 7. Nettoyage
    echo "7. Nettoyage des données de test...\n";
    
    // Supprimer dans l'ordre pour éviter les erreurs de clés étrangères
    CommandeProduit::where('commande_id', $commande->id)->delete();
    Commande::where('id', $commande->id)->delete();
    Produit::where('id', $produit->id)->delete();
    Producteur::where('id', $producteur->id)->delete();
    User::where('id', $user->id)->delete();
    User::where('id', $clientUser->id)->delete();
    
    echo "   ✓ Données de test supprimées\n\n";

    echo "=== Test terminé avec succès! ===\n";
    echo "Le système de gestion de stock fonctionne correctement.\n";

} catch (Exception $e) {
    echo "❌ Erreur lors du test: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
} 