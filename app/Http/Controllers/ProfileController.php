<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Page « Mon compte ».
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Met à jour les informations de l'utilisateur (e-mail).
     * La modification exige la saisie du mot de passe actuel
     * (ré-authentification avant modification).
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($request->user()->id),
            ],
            'current_password' => ['required', 'current_password'],
        ]);

        $user      = $request->user();
        $newEmail  = $validated['email'];
        $oldEmail  = $user->email;

        $user->forceFill(['email' => $newEmail])->save();

        if ($newEmail !== $oldEmail) {
            ActivityLogger::user('UPDATE', "E-mail de compte modifié : \"{$user->username}\" (" . ($oldEmail ?? '—') . " → " . ($newEmail ?? '—') . ")");
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
