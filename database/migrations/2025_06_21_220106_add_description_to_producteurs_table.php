<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Ajouter la colonne "description" à la table "producteurs".
     */
    public function up(): void
    {
        Schema::table('producteurs', function (Blueprint $table) {
            $table->text('description')->nullable()->after('nom_entreprise');
        });
    }

    /**
     * Supprimer la colonne "description" si l'on fait un rollback.
     */
    public function down(): void
    {
        Schema::table('producteurs', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
