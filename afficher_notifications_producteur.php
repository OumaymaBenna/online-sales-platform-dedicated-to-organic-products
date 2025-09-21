<?php

require_once 'vendor/autoload.php';

use App\Models\User;

// ID de l'utilisateur producteur à tester (modifie ce chiffre si besoin)
$userId = 2; // <-- Mets ici l'ID du user du producteur à tester

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = User::find($userId);

if (!$user) {
    echo "Aucun utilisateur trouvé avec l'ID $userId\n";
    exit;
}

echo "Notifications pour le producteur : {$user->name} (user_id: $userId)\n";
echo "-------------------------------------------------------------\n";

foreach ($user->notifications as $notif) {
    $data = $notif->data;
    $type = $notif->type;
    $created = $notif->created_at;
    $read = $notif->read_at ? 'LUE' : 'NON LUE';

    echo "[$read] $created\n";
    echo "Type : $type\n";
    if (isset($data['commentaire'])) {
        echo "  - Commentaire de : {$data['client_nom']} sur {$data['produit_nom']}\n";
        echo "  - Note : {$data['note']}/5\n";
        echo "  - Commentaire : {$data['commentaire']}\n";
    } elseif (isset($data['message'])) {
        echo "  - Message : {$data['message']}\n";
    }
    echo "-------------------------------------------------------------\n";
} 