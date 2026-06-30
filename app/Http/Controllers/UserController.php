<?php

namespace App\Http\Controllers;

use App\Mail\CourrierIdentifiants;
use App\Mail\UserRemovedFromChantier;
use App\Models\Chantier;
use App\Models\User;
use App\Services\ActivityLogger;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prenom'   => 'required|string|max:255',
            'nom'      => 'required|string|max:255',
            'email'    => 'nullable|email|unique:users',
            'role'     => 'required',
        ]);

        // Mot de passe PROVISOIRE généré par le système : l'admin ne le choisit
        // ni ne le connaît. Transmis via le courrier PDF (one-time), puis changé
        // obligatoirement à la première connexion.
        $plainPassword = User::generateTempPassword();

        // Identifiant auto au format Prénom.Nom (+1 si doublon)
        $username = User::generateUsername($request->prenom, $request->nom);

        $user = User::create([
            'username'                 => $username,
            'email'                    => $request->email ?: null,
            'password'                 => Hash::make($plainPassword),
            'temp_password'            => $plainPassword,
            'temp_password_expires_at' => now()->addHours(48),
            'must_change_password'     => true,
            'role'                     => $request->role,
        ]);

        ActivityLogger::user('CREATE', "Utilisateur créé : \"{$user->username}\" (role: {$user->role}, email: " . ($user->email ?? '—') . ")");

        // Retour à la liste. Le courrier (PDF + mail) ne part QUE sur clic du
        // bouton 📄 (action unique), il n'y a pas d'envoi automatique.
        return redirect()->route('users.index')->with('success', __('messages.user_created'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'nullable|email|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        $user->username = $request->username;
        $user->email = $request->email ?: null;
        $user->role = $request->role;

        // Réinitialisation du mot de passe = mot de passe PROVISOIRE généré par le
        // système (jamais choisi/connu de l'admin). Transmis via le bouton 📄 PDF
        // (à usage unique) puis obligatoirement changé à la première connexion.
        // Réservé aux non-admins (les admins gèrent leur mot de passe via "Mon compte").
        $passwordReset = false;
        if ($request->boolean('reset_password') && $user->role !== 'admin') {
            $temp = User::generateTempPassword();
            $user->forceFill([
                'password'                 => Hash::make($temp),
                'temp_password'            => $temp,
                'temp_password_expires_at' => now()->addHours(48),
                'must_change_password'     => true,
                'courrier_sent_at'         => null,   // réactive le courrier PDF (one-time)
            ]);
            $passwordReset = true;
        }

        $user->save();

        ActivityLogger::user('UPDATE', "Utilisateur modifié : \"{$user->username}\" (role: {$user->role})"
            . ($passwordReset ? ' [mot de passe provisoire réinitialisé]' : ''));

        return redirect()->route('users.index')
            ->with('success', __($passwordReset ? 'messages.user_password_reset' : 'messages.user_updated'));
    }

    public function courrier($id)
    {
        $user = User::findOrFail($id);

        // Disponible uniquement si mdp provisoire non encore changé ET non-admin
        if (!$user->must_change_password || $user->role === 'admin') {
            abort(403);
        }

        $pdf      = Pdf::loadView('users.courrier', ['user' => $user])->setPaper('a4', 'portrait');
        $filename = 'Courrier_PlanEx_' . $user->username . '.pdf';
        $pdfBinary = $pdf->output();

        // Mail + marquage : une seule fois (évite les doublons si l'endpoint est
        // rappelé). Le PDF, lui, se télécharge à chaque appel.
        if (is_null($user->courrier_sent_at)) {
            if ($user->email) {
                try {
                    Mail::to($user->email)->send(new CourrierIdentifiants($user, $pdfBinary));
                } catch (\Exception $e) {
                    // Ne pas bloquer le téléchargement si l'e-mail échoue
                }
            }
            $user->forceFill(['courrier_sent_at' => now()])->save();
        }

        return response($pdfBinary, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Empêcher de supprimer son propre compte
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->withErrors(['delete' => __('messages.user_cannot_delete_self')]);
        }

        // Récupérer tous les chantiers où cet user est membre
        $chantiers = $user->chantiers()->with('users')->get();

        foreach ($chantiers as $chantier) {
            $removedRole  = \App\Models\Chantier::ROLES[$user->pivot->role_chantier ?? ''] ?? $user->pivot->role_chantier ?? '—';
            $removedUsername = $user->username;

            // Trouver le(s) chef(s) de chantier pour notifier
            $chefs = $chantier->users()
                ->wherePivot('role_chantier', 'chef_chantier')
                ->where('users.id', '!=', $user->id)
                ->get();

            foreach ($chefs as $chef) {
                if ($chef->email) {
                    try {
                        Mail::to($chef->email)->send(
                            new UserRemovedFromChantier($chef, $chantier, $removedUsername, $removedRole)
                        );
                    } catch (\Exception $e) {
                        // Ne pas bloquer si l'email échoue
                    }
                }
            }
        }

        // Supprimer l'user (le cascade sur chantier_user retire les pivots)
        $username = $user->username;
        $user->chantiers()->detach();
        $user->delete();

        ActivityLogger::user('DELETE', "Utilisateur supprimé : \"{$username}\"");

        return redirect()->route('users.index')
            ->with('success', __('messages.user_deleted'));
    }
}