<?php

require_once 'vendor/autoload.php';

use App\Models\Produit;
use App\Models\Producteur;
use App\Models\User;
use App\Models\Avis;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DIAGNOSTIC DES NOTIFICATIONS ===\n\n";

// 1. Vérifier les produits et leurs producteurs
echo "1. VÉRIFICATION DES PRODUITS ET PRODUCTEURS\n";
echo "--------------------------------------------\n";

$produits = Produit::with('producteur.user')->get();

if ($produits->count() === 0) {
    echo "❌ Aucun produit trouvé\n";
    exit;
}

foreach ($produits as $produit) {
    echo "📦 Produit: {$produit->nom} (ID: {$produit->id})\n";
    echo "   - Producteur ID: {$produit->producteur_id}\n";
    
    if ($produit->producteur) {
        echo "   - Nom entreprise: {$produit->producteur->nom_entreprise}\n";
        echo "   - User ID: {$produit->producteur->user_id}\n";
        
        if ($produit->producteur->user) {
            echo "   - Nom utilisateur: {$produit->producteur->user->name}\n";
            echo "   - Email: {$produit->producteur->user->email}\n";
        } else {
            echo "   - ❌ Aucun utilisateur associé au producteur !\n";
        }
    } else {
        echo "   - ❌ Aucun producteur associé au produit !\n";
    }
    echo "\n";
}

// 2. Vérifier les avis
echo "2. VÉRIFICATION DES AVIS\n";
echo "------------------------\n";

$avis = Avis::with('produit.producteur.user')->get();

if ($avis->count() === 0) {
    echo "❌ Aucun avis trouvé\n";
} else {
    foreach ($avis as $avisItem) {
        echo "💬 Avis ID: {$avisItem->id}\n";
        echo "   - Produit: {$avisItem->produit->nom}\n";
        echo "   - Note: {$avisItem->note}/5\n";
        echo "   - Commentaire: {$avisItem->commentaire}\n";
        echo "   - Date: {$avisItem->created_at}\n";
        
        if ($avisItem->produit->producteur && $avisItem->produit->producteur->user) {
            echo "   - Producteur: {$avisItem->produit->producteur->user->name}\n";
        } else {
            echo "   - ❌ Producteur ou utilisateur manquant !\n";
        }
        echo "\n";
    }
}

// 3. Vérifier les notifications
echo "3. VÉRIFICATION DES NOTIFICATIONS\n";
echo "----------------------------------\n";

$users = User::where('user_type', 'producteur')->get();

if ($users->count() === 0) {
    echo "❌ Aucun utilisateur producteur trouvé\n";
} else {
    foreach ($users as $user) {
        echo "👤 Producteur: {$user->name} (ID: {$user->id})\n";
        
        $notifications = $user->notifications;
        $unreadNotifications = $user->unreadNotifications;
        
        echo "   - Notifications totales: {$notifications->count()}\n";
        echo "   - Notifications non lues: {$unreadNotifications->count()}\n";
        
        if ($notifications->count() > 0) {
            echo "   - Dernières notifications:\n";
            foreach ($notifications->take(3) as $notif) {
                $data = $notif->data;
                $read = $notif->read_at ? 'LUE' : 'NON LUE';
                echo "     • [{$read}] {$notif->created_at} - Type: {$notif->type}\n";
                
                if (isset($data['commentaire'])) {
                    echo "       Commentaire de {$data['client_nom']} sur {$data['produit_nom']}\n";
                }
            }
        }
        echo "\n";
    }
}

echo "=== FIN DU DIAGNOSTIC ===\n"; 