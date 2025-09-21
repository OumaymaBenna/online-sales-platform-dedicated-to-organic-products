<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero_commande',
        'total',
        'statut',
        'methode_paiement',
        'transaction_id',
        'adresse_livraison',
        'ville',
        'code_postal',
        'pays',
        'telephone',
        'notes',
        'date_commande',
    ];

    protected $casts = [
        'date_commande' => 'datetime',
    ];

    // Relation avec l'utilisateur (client)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les produits de la commande
    public function produits()
    {
        return $this->hasMany(CommandeProduit::class);
    }

    // Générer un numéro de commande unique
    public static function genererNumeroCommande()
    {
        do {
            $numero = 'CMD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('numero_commande', $numero)->exists());

        return $numero;
    }

    // Scope pour les commandes d'un producteur
    public function scopePourProducteur($query, $producteurId)
    {
        return $query->whereHas('produits', function ($q) use ($producteurId) {
            $q->where('producteur_id', $producteurId);
        });
    }
}
