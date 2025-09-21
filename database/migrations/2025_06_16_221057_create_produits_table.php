<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producteur_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('categorie')->nullable();
            $table->text('description')->nullable();
            $table->decimal('prix', 8, 2);
            $table->integer('quantite');
            $table->string('unite')->nullable();
            $table->string('image')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
