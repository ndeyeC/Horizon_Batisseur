<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;


class RegisteredUserController extends Controller
{

    
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,  
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);
        // $role = Role::where('name', 'artist')->first();
        //  $user->assignRole($role);

        event(new Registered($user));

        Auth::logout(); 
        
        return redirect()->route('login')->with('success', 'Inscription réussie, veuillez vous connecter.');
        
    }

    public function create() { 
        return view('auth.register'); // Affiche la vue d'inscription }
}
}
