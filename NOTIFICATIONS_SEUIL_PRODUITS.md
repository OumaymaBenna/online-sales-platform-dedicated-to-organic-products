# Système de Gestion de Stock - MaBoutique

## Vue d'ensemble

Le système de gestion de stock de MaBoutique permet de gérer automatiquement les quantités de produits disponibles chez les producteurs. Lorsqu'un client passe une commande, le stock est automatiquement diminué chez le producteur correspondant.

## Fonctionnalités principales

### 1. Diminution automatique du stock

- **Lors de l'ajout au panier** : Vérification que le stock est suffisant
- **Lors de la finalisation de commande** : Diminution automatique du stock
- **Gestion des erreurs** : Annulation de la commande si stock insuffisant

### 2. Vérifications de stock

- **Ajout au panier** : Empêche d'ajouter plus que le stock disponible
- **Mise à jour de quantité** : Vérifie le stock lors de la modification
- **Finalisation** : Vérification finale avant de créer la commande

### 3. Notifications automatiques

- **Stock faible** : Notification aux producteurs quand le stock est ≤ 10 unités
- **Nouvelle commande** : Notification immédiate lors d'une commande
- **Stock épuisé** : Produit marqué comme indisponible automatiquement

## Modèles et méthodes

### Modèle Produit

```php
// Nouvelles méthodes ajoutées
$produit->diminuerStock($quantite);     // Diminue le stock
$produit->augmenterStock($quantite);    // Augmente le stock
$produit->stockSuffisant($quantite);    // Vérifie si suffisant
$produit->getStockDisponible();         // Retourne le stock disponible
```

### Contrôleurs modifiés

1. **PaiementController** : Gestion du stock lors du paiement Stripe
2. **ClientController** : Gestion du stock lors de la finalisation directe
3. **PanierController** : Vérifications lors de l'ajout/modification

## Commandes Artisan

### Vérification du seuil de stock

```bash
# Vérifier les produits avec un stock ≤ 10
php artisan produits:verifier-seuil

# Vérifier avec un seuil personnalisé
php artisan produits:verifier-seuil --seuil=5
```

### Planification automatique

Pour automatiser la vérification, ajoutez dans `app/Console/Kernel.php` :

```php
protected function schedule(Schedule $schedule)
{
    // Vérifier le stock tous les jours à 9h
    $schedule->command('produits:verifier-seuil')->dailyAt('09:00');
}
```

## Flux de commande

1. **Client ajoute au panier** → Vérification du stock disponible
2. **Client modifie quantité** → Vérification du stock disponible
3. **Client finalise commande** → 
   - Vérification finale du stock
   - Création de la commande
   - Diminution du stock chez le producteur
   - Notification au producteur
   - Marquer comme indisponible si stock = 0

## Gestion des erreurs

### Stock insuffisant

Si le stock devient insuffisant entre l'ajout au panier et la finalisation :

1. La commande est annulée
2. Un message d'erreur est affiché au client
3. Le stock actuel est indiqué

### Exemple de message d'erreur

```
Stock insuffisant pour le produit "Tomates fraîches". 
Stock disponible : 5 kg
```

## Notifications

### Types de notifications

1. **SeuilProduitsAtteint** : Stock faible (≤ 10 unités)
2. **NouvelleCommande** : Nouvelle commande reçue
3. **StockFaible** : Stock très faible (≤ 5 unités)

### Configuration

Les notifications sont envoyées automatiquement aux producteurs concernés. Pour désactiver les emails, modifiez la configuration dans `config/notifications.php`.

## Tests

Pour tester le système :

1. Créez un produit avec une quantité limitée
2. Ajoutez-le au panier plusieurs fois
3. Vérifiez que vous ne pouvez pas dépasser le stock
4. Finalisez une commande
5. Vérifiez que le stock a diminué chez le producteur

## Maintenance

### Nettoyage des commandes annulées

```bash
# Supprimer les commandes annulées de plus de 30 jours
php artisan commandes:nettoyer-annulees
```

### Réinitialisation du stock

En cas de problème, vous pouvez réinitialiser le stock d'un produit :

```php
$produit = Produit::find($id);
$produit->augmenterStock(100); // Ajoute 100 unités
```

## Sécurité

- Toutes les opérations de stock sont effectuées dans des transactions
- Vérifications multiples pour éviter les conditions de course
- Logs détaillés pour le suivi des modifications
- Notifications en cas d'erreur

## Support

Pour toute question ou problème avec le système de gestion de stock, consultez les logs dans `storage/logs/laravel.log` ou contactez l'équipe de développement. 