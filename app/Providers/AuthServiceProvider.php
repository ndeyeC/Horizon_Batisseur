<?php

namespace App\Providers;

use App\Models\Commentaire;
use App\Policies\CommentairePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les politiques d'autorisation des modèles.
     *
     * @var array
     */
    protected $policies = [
        Commentaire::class => CommentairePolicy::class,
        // Immobilier::class => ImmobilierPolicy::class,
        
    ];

    /**
     * Enregistrer les services d'autorisation.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
