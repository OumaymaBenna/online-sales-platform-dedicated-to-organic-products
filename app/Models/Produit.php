<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'producteur_id',
        'nom',
        'description',
        'prix',
        'quantite',
        'unite',
        'categorie',
        'image',
        'disponible',
        'image_url',
    ];

    /**
     * Les attributs devant être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'prix' => 'decimal:2',
        'disponible' => 'boolean',
    ];

    /**
     * Un produit appartient à un producteur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producteur()
    {
        return $this->belongsTo(Producteur::class);
    }

    /**
     * Un produit a plusieurs avis.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function wishlists()
    {
        return $this->hasMany(\App\Models\Wishlist::class);
    }

    /**
     * Diminuer le stock d'un produit
     *
     * @param int $quantite
     * @return bool
     */
    public function diminuerStock($quantite)
    {
        if ($this->quantite < $quantite) {
            return false; // Stock insuffisant
        }

        $this->quantite -= $quantite;
        $this->disponible = $this->quantite > 0;
        $this->save();

        // Notifier le producteur si seuil atteint ou rupture
        \App\Http\Controllers\ProducteurController::verifierStockFaibleStatic($this);

        return true;
    }

    /**
     * Augmenter le stock d'un produit
     *
     * @param int $quantite
     * @return void
     */
    public function augmenterStock($quantite)
    {
        $this->quantite += $quantite;
        $this->disponible = true;
        $this->save();
    }

    /**
     * Vérifier si le stock est suffisant
     *
     * @param int $quantite
     * @return bool
     */
    public function stockSuffisant($quantite)
    {
        return $this->quantite >= $quantite && $this->disponible;
    }

    /**
     * Obtenir le stock disponible
     *
     * @return int
     */
    public function getStockDisponible()
    {
        return $this->disponible ? $this->quantite : 0;
    }
    
}
