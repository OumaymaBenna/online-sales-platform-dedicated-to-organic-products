<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
            $table->timestamps();
            // $table->unique(['user_id', 'produit_id']); // Retiré pour compatibilité, à remettre si besoin
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}; 