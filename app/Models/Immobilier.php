<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Immobilier extends Model
{
    protected $fillable = [
        'name', 'category', 'image_path', 
        'description', 'address', 
        'status', 'registration_date'
    ];
    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
