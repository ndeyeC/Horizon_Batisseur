<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;


class AuthenticatedSessionController extends Controller
{
    /**
     * Afficher le formulaire de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gérer une demande d'authentification.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Rediriger en fonction du rôle de l'utilisateur
        if (Auth::user()->role === 'admin') {
            return redirect()->intended(route('immobiliers.index'));  // Rediriger vers la page des immobiliers pour l'admin
        }

        return redirect()->intended(route('immobiliers.index'));  // Rediriger vers la page des immobiliers pour tous
    }

    /**
     * Détruire une session authentifiée.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
