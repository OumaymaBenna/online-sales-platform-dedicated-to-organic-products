<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producteur extends Model
{
    use HasFactory;

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nom_entreprise',
        'description',
        'adresse',
        'telephone',
        // Tu peux ajouter d'autres champs ici si besoin
    ];

    /**
     * Un producteur appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un producteur a plusieurs produits.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    /**
     * Vérifie si le profil du producteur est complet.
     *
     * @return bool
     */
    public function isProfileComplete()
    {
        return !empty($this->nom_entreprise) &&
               !empty($this->adresse) &&
               !empty($this->telephone) &&
               !empty($this->description);
    }
}
