<?php

require_once 'vendor/autoload.php';

use App\Models\Producteur;
use App\Models\User;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== LISTE DES PRODUCTEURS ===\n\n";

$producteurs = Producteur::with('user')->get();

if ($producteurs->count() === 0) {
    echo "❌ Aucun producteur trouvé dans la base de données\n";
    exit;
}

foreach ($producteurs as $producteur) {
    echo "📋 Producteur ID: {$producteur->id}\n";
    echo "   - Nom entreprise: {$producteur->nom_entreprise}\n";
    echo "   - User ID: {$producteur->user_id}\n";
    
    if ($producteur->user) {
        echo "   - Nom utilisateur: {$producteur->user->name}\n";
        echo "   - Email: {$producteur->user->email}\n";
    } else {
        echo "   - ❌ Aucun utilisateur associé !\n";
    }
    
    // Compter les produits
    $produitsCount = $producteur->produits()->count();
    echo "   - Nombre de produits: {$produitsCount}\n";
    
    // Compter les notifications
    if ($producteur->user) {
        $notificationsCount = $producteur->user->notifications()->count();
        $unreadCount = $producteur->user->unreadNotifications()->count();
        echo "   - Notifications totales: {$notificationsCount}\n";
        echo "   - Notifications non lues: {$unreadCount}\n";
    }
    
    echo "-------------------------------------------------------------\n";
}

echo "\n=== INSTRUCTIONS ===\n";
echo "1. Copie l'ID d'un producteur ci-dessus\n";
echo "2. Modifie le fichier 'afficher_notifications_producteur.php'\n";
echo "3. Remplace \$userId = 2; par \$userId = [ID_COPIÉ];\n";
echo "4. Lance: php afficher_notifications_producteur.php\n"; 