<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immobilier;

class ImmobilierController extends Controller
{
    public function index()
    {
        $immobiliers = Immobilier::all();
        return view('immobiliers.index', compact('immobiliers'));
    }

    public function create()
    {
        return view('immobiliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|image',
            'description' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|string',
        ]);

        $path = $request->file('image')->store('images','public');

        Immobilier::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
             'image_path' => $path,
            'description' => $validated['description'],
            'address' => $validated['address'],
            'status' => $validated['status'],
            'registration_date' => now(),
        ]);

        return redirect('/immobiliers')->with('success', 'Bien immobilier créé avec succès!');
    }

    public function edit(Immobilier $immobilier)
    {
        return view('immobiliers.edit', compact('immobilier'));
    }

    public function show(Immobilier $immobilier)
{
    // If you want to eager load commentaires and their related users
    $immobilier->load('commentaires.user');

    return view('immobiliers.show', compact('immobilier'));
}

    public function update(Request $request, Immobilier $immobilier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'category' => 'required|string',
            'status' => 'required|string',
            'image' => 'nullable|image',//optiennell

        ]);

        // Vérification si une nouvelle image a été téléchargée
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($immobilier->image_path) {
                Storage::delete($immobilier->image_path);
            }

            // Enregistrer la nouvelle image
            $path = $request->file('image')->store('images');
            $immobilier->image_path = $path;
        }

        $immobilier->update($validated);

        return redirect()->route('immobiliers.index');
    }

    public function destroy(Immobilier $immobilier)
    {
        $immobilier->delete();

        return redirect()->route('immobiliers.index');
    }
}
