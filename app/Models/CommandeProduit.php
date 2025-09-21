<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommandeProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'produit_id',
        'producteur_id',
        'quantite',
        'prix_unitaire',
        'prix_total',
    ];

    // Relation avec la commande
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    // Relation avec le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    // Relation avec le producteur
    public function producteur()
    {
        return $this->belongsTo(Producteur::class);
    }
}
