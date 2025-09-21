<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs pouvant être remplis.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * Les attributs à masquer pour les tableaux.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs devant être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relation : un utilisateur peut avoir un profil producteur.
     */
    public function producteur()
    {
        return $this->hasOne(Producteur::class);
    }

    /**
     * Relation : un utilisateur peut avoir un profil client.
     */
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    /**
     * Vérifie si l'utilisateur est un producteur.
     */
    public function isProducteur(): bool
    {
        return $this->user_type === 'producteur';
    }

    /**
     * Vérifie si l'utilisateur est un client.
     */
    public function isClient(): bool
    {
        return $this->user_type === 'client';
    }

    /**
     * Wishlist de l'utilisateur.
     */
    public function wishlist()
    {
        return $this->belongsToMany(\App\Models\Produit::class, 'wishlists', 'user_id', 'produit_id');
    }
}
