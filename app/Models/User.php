<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',     // Ajouté
        'last_name',      // Ajouté
        'name',
        'email',
        'password',
        'role',           // Ajouté
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function commentairess()
    {
        return $this->hasMany(Commentaire::class);
    }
    public function immobiliers()
    {
        return $this->hasMany(immobilier::class);
    }

    // Méthode pour vérifier si l'utilisateur est admin
    // public function isAdmin()
    // {
    //     return $this->role === 'admin';
    // }
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Accesseur pour le nom complet
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
