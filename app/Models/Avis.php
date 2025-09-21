<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $fillable = ['produit_id', 'user_id', 'note', 'commentaire'];

    public function produit() {
        return $this->belongsTo(Produit::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

