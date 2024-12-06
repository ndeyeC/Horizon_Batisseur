<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = [
        'content',        // Contenu du commentaire
        'user_id',        // Utilisateur qui a posté
        'immobilier_id'     // Immobilier associée
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function immobilier()
    {
        return $this->belongsTo(Immobilier::class);
    }
}
