<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

try {
    // Créer la table commandes
    if (!Schema::hasTable('commandes')) {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('numero_commande')->unique();
            $table->decimal('total', 10, 2);
            $table->string('statut')->default('en_attente');
            $table->string('methode_paiement')->default('stripe');
            $table->string('transaction_id')->nullable();
            $table->text('adresse_livraison');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('pays');
            $table->string('telephone');
            $table->text('notes')->nullable();
            $table->timestamp('date_commande')->useCurrent();
            $table->timestamps();
        });
        echo "Table commandes créée avec succès!\n";
    } else {
        echo "Table commandes existe déjà.\n";
    }

    // Créer la table commande_produits
    if (!Schema::hasTable('commande_produits')) {
        Schema::create('commande_produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->foreignId('producteur_id')->constrained()->onDelete('cascade');
            $table->integer('quantite');
            $table->decimal('prix_unitaire', 10, 2);
            $table->decimal('prix_total', 10, 2);
            $table->timestamps();
        });
        echo "Table commande_produits créée avec succès!\n";
    } else {
        echo "Table commande_produits existe déjà.\n";
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
} 