<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'telephone',
        'adresse',
        'ville',
        'code_postal',
        'pays',
    ];

    // Relation inverse vers User (un client appartient à un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
