<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Afficher le formulaire de profil
    public function show()
    {
        return view('profile.show');
    }

    // Mettre à jour les informations
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Changement de mot de passe (optionnel)
        if ($request->filled('new_password')) {
            // Vérifier le mot de passe actuel
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Le mot de passe actuel est incorrect.',
                ])->withInput();
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès !');
    }
}
