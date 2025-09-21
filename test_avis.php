<?php

require_once 'vendor/autoload.php';

use App\Models\Produit;
use App\Models\User;
use App\Models\Avis;
use App\Notifications\NouveauCommentaireProduit;

// Simuler un environnement Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Test du système de notifications d'avis ===\n\n";

// Trouver un produit et un producteur
$produit = Produit::with('producteur.user')->first();

if (!$produit) {
    echo "❌ Aucun produit trouvé dans la base de données\n";
    exit;
}

if (!$produit->producteur || !$produit->producteur->user) {
    echo "❌ Aucun producteur associé au produit\n";
    exit;
}

echo "✅ Produit trouvé : {$produit->nom}\n";
echo "✅ Producteur : {$produit->producteur->user->name}\n\n";

// Créer un avis de test
$avis = Avis::create([
    'produit_id' => $produit->id,
    'user_id' => 1, // ID d'un client de test
    'note' => 5,
    'commentaire' => 'Excellent produit ! Très frais et de bonne qualité. Je recommande vivement !'
]);

echo "✅ Avis créé avec succès\n";
echo "   - Note : {$avis->note}/5\n";
echo "   - Commentaire : {$avis->commentaire}\n\n";

// Envoyer la notification
try {
    echo "🔄 Envoi de la notification...\n";
    
    $notification = new NouveauCommentaireProduit([
        'client_nom' => 'Client Test',
        'produit_nom' => $produit->nom,
        'commentaire' => $avis->commentaire,
        'note' => $avis->note,
    ]);
    
    $produit->producteur->user->notify($notification);
    
    echo "✅ Notification envoyée avec succès !\n\n";
    
    // Vérifier les notifications
    $notifications = $produit->producteur->user->notifications;
    $unreadCount = $produit->producteur->user->unreadNotifications->count();
    
    echo "📊 Statistiques des notifications :\n";
    echo "   - Total des notifications : {$notifications->count()}\n";
    echo "   - Notifications non lues : {$unreadCount}\n";
    
    $commentNotifications = $notifications->filter(function($notification) {
        return isset($notification->data['commentaire']);
    });
    
    echo "   - Notifications de commentaires : {$commentNotifications->count()}\n\n";
    
    if ($commentNotifications->count() > 0) {
        echo "📝 Dernière notification de commentaire :\n";
        $lastComment = $commentNotifications->first();
        echo "   - Client : {$lastComment->data['client_nom']}\n";
        echo "   - Produit : {$lastComment->data['produit_nom']}\n";
        echo "   - Commentaire : {$lastComment->data['commentaire']}\n";
        echo "   - Note : {$lastComment->data['note']}/5\n";
        echo "   - Date : {$lastComment->created_at}\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur lors de l'envoi de la notification : " . $e->getMessage() . "\n";
}

echo "\n=== Test terminé ===\n"; 