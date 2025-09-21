# Système de Panier - Ferme Locale

## Fonctionnalités implémentées

### 1. Ajout au panier
- **Bouton "Ajouter au panier"** sur chaque produit
- **Stockage complet des informations** :
  - ID du produit
  - Nom du produit
  - Prix unitaire
  - Quantité
  - Image du produit
  - Description
  - Catégorie
  - Unité de mesure
  - Statut de disponibilité
  - **Informations complètes du producteur** :
    - ID du producteur
    - Nom de l'entreprise
    - Adresse
    - Téléphone
    - Email
    - Description
  - Date d'ajout au panier

### 2. Interface du panier (`panier.blade.php`)
- **Affichage détaillé des produits** avec toutes les informations
- **Informations du producteur** pour chaque produit
- **Section dédiée aux coordonnées des producteurs** avec :
  - Nom de l'entreprise
  - Adresse
  - Téléphone (cliquable)
  - Email (cliquable)
  - Description
- **Gestion des quantités** avec boutons + et -
- **Calcul automatique des totaux**
- **Suppression individuelle** des produits
- **Vidage complet** du panier

### 3. Expérience utilisateur améliorée
- **Animations JavaScript** lors de l'ajout au panier
- **Notifications toast** pour confirmer les actions
- **Mise à jour en temps réel** du compteur du panier
- **États de chargement** sur les boutons
- **Gestion des erreurs** avec feedback visuel

### 4. Routes disponibles
- `POST /client/panier/ajouter` - Ajouter un produit
- `POST /client/panier/supprimer` - Supprimer un produit
- `POST /client/panier/quantite` - Modifier la quantité
- `POST /client/panier/vider` - Vider le panier
- `GET /client/panier/count` - Obtenir le nombre d'articles (AJAX)

### 5. Stockage des données
- **Session Laravel** pour persistance temporaire
- **Structure de données complète** pour chaque produit
- **Gestion des relations** avec les producteurs

## Utilisation

### Pour ajouter un produit au panier :
1. Cliquer sur "Ajouter au panier" sur la page des produits
2. Le produit est automatiquement ajouté avec toutes ses informations
3. Une notification confirme l'ajout
4. Le compteur du panier se met à jour

### Pour consulter le panier :
1. Aller sur la page `/client/panier`
2. Voir tous les produits ajoutés avec leurs détails
3. Consulter les coordonnées des producteurs
4. Modifier les quantités ou supprimer des produits

### Pour passer une commande :
1. Vérifier le contenu du panier
2. Cliquer sur "Passer la commande"
3. Le panier est vidé après la commande

## Structure des données du panier

```php
$cart = [
    'produit_id' => [
        'id' => 1,
        'nom' => 'Tomates bio',
        'prix' => 2.50,
        'quantite' => 2,
        'image' => 'produits/tomates.jpg',
        'description' => 'Tomates biologiques fraîches',
        'categorie' => 'legumes',
        'unite' => 'kg',
        'disponible' => true,
        'producteur' => [
            'id' => 1,
            'nom_entreprise' => 'Ferme du Soleil',
            'adresse' => '123 Route des Champs',
            'telephone' => '+216 12 345 678',
            'email' => 'contact@fermedusoleil.tn',
            'description' => 'Producteur bio depuis 2010'
        ],
        'date_ajout' => '2024-01-15 14:30:00'
    ]
];
```

## Sécurité
- **Protection CSRF** sur tous les formulaires
- **Validation des données** côté serveur
- **Vérification des permissions** utilisateur
- **Gestion des erreurs** appropriée 