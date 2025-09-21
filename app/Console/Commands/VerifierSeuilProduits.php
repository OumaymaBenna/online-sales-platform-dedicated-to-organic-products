<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produit;
use App\Models\Producteur;
use App\Models\User;
use App\Notifications\SeuilProduitsAtteint;

class VerifierSeuilProduits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'produits:verifier-seuil {--seuil=10 : Seuil d\'alerte pour le stock}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifier les produits dont le stock est faible et notifier les producteurs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $seuil = $this->option('seuil');
        $this->info("Vérification des produits avec un stock inférieur ou égal à {$seuil}...");

        $produitsFaibleStock = Produit::where('quantite', '<=', $seuil)
            ->where('disponible', true)
            ->with('producteur.user')
            ->get();

        if ($produitsFaibleStock->isEmpty()) {
            $this->info('Aucun produit avec un stock faible trouvé.');
            return 0;
        }

        $this->info("Trouvé {$produitsFaibleStock->count()} produit(s) avec un stock faible.");

        foreach ($produitsFaibleStock as $produit) {
            $this->line("- {$produit->nom} : {$produit->quantite} {$produit->unite} (Producteur: {$produit->producteur->nom_entreprise})");

            // Notifier le producteur
            if ($produit->producteur && $produit->producteur->user) {
                try {
                    $produit->producteur->user->notify(new SeuilProduitsAtteint([
                        'produit_nom' => $produit->nom,
                        'quantite_restante' => $produit->quantite,
                        'unite' => $produit->unite,
                        'seuil_alerte' => $seuil,
                    ]));
                    $this->info("  ✓ Notification envoyée au producteur");
                } catch (\Exception $e) {
                    $this->error("  ✗ Erreur lors de l'envoi de la notification: " . $e->getMessage());
                }
            }
        }

        $this->info('Vérification terminée.');
        return 0;
    }
} 