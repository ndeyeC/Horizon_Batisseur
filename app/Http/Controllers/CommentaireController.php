<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Immobilier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentaireController extends Controller
{
    use AuthorizesRequests;

    // public function __construct()
    // {
    //     // Appliquer le middleware d'authentification
    //  $this->middleware('auth');

    //     // Appliquer le middleware 'admin' uniquement pour certaines méthodes
    //      $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);

    //     // Autoriser les actions sur la ressource Commentaire
    //     $this->authorizeResource(Commentaire::class, 'commentaire');
    // }

    public function store(Request $request, Immobilier $immobilier)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Commentaire::create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'immobilier_id' => $immobilier->id,
        ]);

        return back()->with('success', 'Commentaire ajouté avec succès!');
    }

    public function destroy(Commentaire $commentaire)
    {
        // La vérification de l'autorisation est effectuée automatiquement
        $this->authorize('delete', $commentaire);
        $immobilierId = $commentaire->immobilier_id; //recuperonsidmmobilier
        $commentaire->delete();

        return redirect()->route('immobiliers.show',$immobilierId)->with('success', 'Commentaire supprimé avec succès');
    }
}
