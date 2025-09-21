<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Producteur;
use App\Models\User;

class ProduitsTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Trouver un producteur existant ou en créer un
        $user = User::where('user_type', 'producteur')->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Test Producteur',
                'email' => 'producteur@test.com',
                'password' => bcrypt('password'),
                'user_type' => 'producteur',
            ]);
            
            Producteur::create([
                'user_id' => $user->id,
                'nom_entreprise' => 'Ferme Test',
                'adresse' => '123 Rue Test',
                'telephone' => '0123456789',
                'description' => 'Ferme de test pour les notifications',
            ]);
        }
        
        $producteur = $user->producteur;
        
        // Vérifier que le producteur existe
        if (!$producteur) {
            $this->command->error('Aucun producteur trouvé. Création d\'un nouveau producteur...');
            $producteur = Producteur::create([
                'user_id' => $user->id,
                'nom_entreprise' => 'Ferme Test',
                'adresse' => '123 Rue Test',
                'telephone' => '0123456789',
                'description' => 'Ferme de test pour les notifications',
            ]);
        }
        
        // Noms de produits de test
        $produits = [
            'Tomates Bio',
            'Pommes de terre',
            'Carottes',
            'Oignons',
            'Ail',
            'Poivrons',
            'Concombres',
            'Salade',
            'Épinards',
            'Brocoli',
            'Chou-fleur',
            'Courgettes',
            'Aubergines',
            'Haricots verts',
            'Petits pois'
        ];
        
        // Ajouter 15 produits pour dépasser le seuil de 10
        for ($i = 0; $i < 15; $i++) {
            Produit::create([
                'producteur_id' => $producteur->id,
                'nom' => $produits[$i] ?? "Produit Test " . ($i + 1),
                'description' => 'Description du produit ' . ($i + 1),
                'prix' => rand(100, 1000) / 100, // Prix entre 1.00 et 10.00
                'quantite' => rand(10, 100),
                'unite' => 'kg',
                'categorie' => 'Légumes',
                'disponible' => true,
            ]);
        }
        
        $this->command->info('15 produits de test créés pour le producteur ' . $user->email);
    }
} 