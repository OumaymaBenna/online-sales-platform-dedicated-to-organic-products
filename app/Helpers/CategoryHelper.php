<?php

namespace App\Helpers;

class CategoryHelper
{
    /**
     * Obtenir l'icône et la couleur pour une catégorie
     */
    public static function getCategoryData($categorie)
    {
        $categories = [
            'fruits' => [
                'icone' => 'fas fa-apple-alt',
                'couleur' => 'from-red-400 to-red-600',
                'description' => 'Fruits frais et de saison'
            ],
            'legumes' => [
                'icone' => 'fas fa-carrot',
                'couleur' => 'from-green-400 to-green-600',
                'description' => 'Légumes bio et locaux'
            ],
            'viande' => [
                'icone' => 'fas fa-drumstick-bite',
                'couleur' => 'from-orange-400 to-orange-600',
                'description' => 'Viandes fraîches et de qualité'
            ],
            'poisson' => [
                'icone' => 'fas fa-fish',
                'couleur' => 'from-blue-400 to-blue-600',
                'description' => 'Poissons et fruits de mer'
            ],
            'laitier' => [
                'icone' => 'fas fa-cheese',
                'couleur' => 'from-yellow-400 to-yellow-600',
                'description' => 'Produits laitiers artisanaux'
            ],
            'pain' => [
                'icone' => 'fas fa-bread-slice',
                'couleur' => 'from-amber-400 to-amber-600',
                'description' => 'Pains et viennoiseries'
            ],
            'miel' => [
                'icone' => 'fas fa-honey-pot',
                'couleur' => 'from-yellow-400 to-yellow-600',
                'description' => 'Miel et produits de la ruche'
            ],
            'huile' => [
                'icone' => 'fas fa-wine-bottle',
                'couleur' => 'from-green-400 to-green-600',
                'description' => 'Huiles et condiments'
            ],
            'epices' => [
                'icone' => 'fas fa-pepper-hot',
                'couleur' => 'from-red-400 to-red-600',
                'description' => 'Épices et herbes aromatiques'
            ],
            'confiture' => [
                'icone' => 'fas fa-jar',
                'couleur' => 'from-pink-400 to-pink-600',
                'description' => 'Confitures et conserves'
            ]
        ];

        // Normaliser le nom de la catégorie
        $categorieNormalisee = strtolower(trim($categorie));
        
        // Chercher une correspondance exacte
        if (isset($categories[$categorieNormalisee])) {
            return $categories[$categorieNormalisee];
        }
        
        // Chercher une correspondance partielle
        foreach ($categories as $key => $data) {
            if (str_contains($categorieNormalisee, $key) || str_contains($key, $categorieNormalisee)) {
                return $data;
            }
        }
        
        // Valeur par défaut
        return [
            'icone' => 'fas fa-seedling',
            'couleur' => 'from-gray-400 to-gray-600',
            'description' => 'Produits frais et locaux'
        ];
    }
} 