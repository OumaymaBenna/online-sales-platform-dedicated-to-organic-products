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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('numero_commande')->unique();
            $table->decimal('total', 10, 2);
            $table->string('statut')->default('en_attente'); // en_attente, confirmee, expediee, livree, annulee
            $table->string('methode_paiement')->default('stripe');
            $table->string('transaction_id')->nullable(); // ID de transaction Stripe
            $table->text('adresse_livraison');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('pays');
            $table->string('telephone');
            $table->text('notes')->nullable();
            $table->timestamp('date_commande')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
