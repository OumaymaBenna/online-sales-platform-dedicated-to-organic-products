<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

try {
    Schema::table('clients', function (Blueprint $table) {
        if (!Schema::hasColumn('clients', 'adresse')) {
            $table->string('adresse')->nullable()->after('telephone');
        }
        if (!Schema::hasColumn('clients', 'ville')) {
            $table->string('ville')->nullable()->after('adresse');
        }
        if (!Schema::hasColumn('clients', 'code_postal')) {
            $table->string('code_postal')->nullable()->after('ville');
        }
        if (!Schema::hasColumn('clients', 'pays')) {
            $table->string('pays')->nullable()->after('code_postal');
        }
    });
    
    echo "Colonnes ajoutées avec succès!\n";
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
} 