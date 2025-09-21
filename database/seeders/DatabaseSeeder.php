<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Producteur;
use App\Models\Produit;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un utilisateur client de test
        $client = User::create([
            'name' => 'Jean Dupont',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'client',
        ]);

        // Créer un utilisateur producteur de test
        $producteurUser = User::create([
            'name' => 'Marie Martin',
            'email' => 'producteur@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'producteur',
        ]);

        // Créer le profil producteur
        $producteur = Producteur::create([
            'user_id' => $producteurUser->id,
            'nom_entreprise' => 'Ferme Bio Martin',
            'description' => 'Producteur de fruits et légumes bio depuis 15 ans',
            'adresse' => '123 Route des Champs, 75000 Paris',
            'telephone' => '01 23 45 67 89',
        ]);

        // Créer des produits de test
        $produits = [
            [
                'nom' => 'Tomates Bio',
                'description' => 'Tomates cultivées en agriculture biologique, récoltées à maturité. Goût exceptionnel et texture ferme.',
                'prix' => 2.50,
                'quantite' => 100,
                'unite' => 'kg',
                'categorie' => 'fruits',
                'disponible' => true,
            ],
            [
                'nom' => 'Huile d\'olive vierge extra',
                'description' => 'Huile d\'olive de première pression à froid, issue d\'olives récoltées à la main. Saveur intense et fruitée.',
                'prix' => 18.90,
                'quantite' => 50,
                'unite' => 'litres',
                'categorie' => 'huile',
                'disponible' => true,
            ],
            [
                'nom' => 'Miel de fleurs sauvages',
                'description' => 'Miel artisanal récolté dans les montagnes, non pasteurisé. Riche en saveurs et en bienfaits.',
                'prix' => 12.50,
                'quantite' => 30,
                'unite' => 'pots',
                'categorie' => 'miel',
                'disponible' => true,
            ],
            [
                'nom' => 'Fromage de chèvre',
                'description' => 'Fromage de chèvre frais, fabriqué artisanalement avec du lait cru. Texture onctueuse et goût délicat.',
                'prix' => 8.75,
                'quantite' => 25,
                'unite' => 'pièces',
                'categorie' => 'laitier',
                'disponible' => true,
            ],
            [
                'nom' => 'Basilic frais',
                'description' => 'Basilic fraîchement cueilli, idéal pour vos plats méditerranéens. Aromatique et parfumé.',
                'prix' => 1.20,
                'quantite' => 200,
                'unite' => 'bouquets',
                'categorie' => 'epices',
                'disponible' => true,
            ],
            [
                'nom' => 'Confiture d\'abricot',
                'description' => 'Confiture maison à base d\'abricots locaux, sans conservateurs. Goût authentique et naturel.',
                'prix' => 5.90,
                'quantite' => 40,
                'unite' => 'pots',
                'categorie' => 'confiture',
                'disponible' => true,
            ],
            [
                'nom' => 'Pommes Golden',
                'description' => 'Pommes Golden Bio, croquantes et sucrées, récoltées à la main. Parfaites pour la consommation ou la cuisine.',
                'prix' => 3.20,
                'quantite' => 150,
                'unite' => 'kg',
                'categorie' => 'fruits',
                'disponible' => true,
            ],
            [
                'nom' => 'Pain traditionnel',
                'description' => 'Pain cuit au feu de bois selon une recette traditionnelle. Croûte dorée et mie aérée.',
                'prix' => 2.10,
                'quantite' => 100,
                'unite' => 'pains',
                'categorie' => 'pain',
                'disponible' => true,
            ],
        ];

        foreach ($produits as $produitData) {
            Produit::create(array_merge($produitData, [
                'producteur_id' => $producteur->id,
            ]));
        }
    }
}
