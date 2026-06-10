<?php

namespace App\Http\Controllers;

use App\Mail\ChantierUserAdded;
use App\Models\Chantier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ChantierController extends Controller
{
    // ── Liste ────────────────────────────────────────────────
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // L'admin voit tous les chantiers sans apparaître dedans
            $chantiers = Chantier::withCount('incidents')->orderBy('nom')->get();
        } else {
            // Les autres voient uniquement leurs chantiers
            $chantiers = $user->chantiers()
                ->withCount('incidents')
                ->orderBy('nom')
                ->get();
        }

        return view('chantiers.index', compact('chantiers'));
    }

    // ── Créer (form) ─────────────────────────────────────────
    public function create()
    {
        return view('chantiers.create');
    }

    // ── Enregistrer ──────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'nom'      => ['required', 'string', 'max:255', Rule::unique('chantiers', 'nom')],
            'localite' => ['required', 'string', 'max:255'],
        ], [
            'nom.unique' => __('messages.chantier_name_taken'),
        ]);

        $chantier = Chantier::create($request->only('nom', 'localite'));

        // Créateur = Chef Chantier automatiquement
        $creator = auth()->user();
        $chantier->users()->attach($creator->id, [
            'role_chantier' => 'chef_chantier',
            'is_creator'    => true,
        ]);

        return redirect()->route('chantiers.index')
            ->with('success', __('messages.chantier_created'));
    }

    // ── Fiche détail ─────────────────────────────────────────
    public function show(Chantier $chantier)
    {
        $this->authorizeChantier($chantier);

        $incidents = $chantier->incidents()->with('zoneobj')->latest('id_incident')->get();
        $members   = $chantier->users()->get();
        $allUsers  = User::whereNotIn('id', $members->pluck('id'))->orderBy('username')->get();

        $statutColors = [
            'ouvert'   => ['label' => __('messages.status_open'),        'color' => '#ef4444'],
            'en_cours' => ['label' => __('messages.status_in_progress'),  'color' => '#f97316'],
            'fermer'   => ['label' => __('messages.status_closed'),       'color' => '#22c55e'],
            'na'       => ['label' => __('messages.status_na'),           'color' => '#94a3b8'],
        ];

        $grouped = $incidents->groupBy('statut');
        $chartLabels = $chartData = $chartColors = [];
        $stats = ['ouvert' => 0, 'en_cours' => 0, 'fermer' => 0, 'na' => 0];

        foreach ($statutColors as $key => $info) {
            $count = $grouped->get($key, collect())->count();
            if ($count > 0) {
                $chartLabels[] = strip_tags($info['label']);
                $chartData[]   = $count;
                $chartColors[] = $info['color'];
            }
            $stats[$key] = $count;
        }

        $globalTotal  = $incidents->count();
        $globalClosed = $stats['fermer'];
        $globalPct    = $globalTotal > 0 ? round($globalClosed / $globalTotal * 100) : 0;

        $isChef = $this->isChef($chantier);

        return view('chantiers.show', compact(
            'chantier', 'incidents', 'members', 'allUsers',
            'chartLabels', 'chartData', 'chartColors', 'stats',
            'globalTotal', 'globalClosed', 'globalPct', 'isChef'
        ));
    }

    // ── Modifier (form) ───────────────────────────────────────
    public function edit(Chantier $chantier)
    {
        $this->authorizeChef($chantier);
        return view('chantiers.edit', compact('chantier'));
    }

    // ── Mettre à jour ─────────────────────────────────────────
    public function update(Request $request, Chantier $chantier)
    {
        $this->authorizeChef($chantier);

        $request->validate([
            'nom'      => ['required', 'string', 'max:255', Rule::unique('chantiers', 'nom')->ignore($chantier->id)],
            'localite' => ['required', 'string', 'max:255'],
        ], [
            'nom.unique' => __('messages.chantier_name_taken'),
        ]);

        $chantier->update($request->only('nom', 'localite'));

        return redirect()->route('chantiers.index')
            ->with('success', __('messages.chantier_updated'));
    }

    // ── Supprimer ─────────────────────────────────────────────
    public function destroy(Chantier $chantier)
    {
        $chantier->delete();
        return redirect()->route('chantiers.index')
            ->with('success', __('messages.chantier_deleted'));
    }

    // ── Ajouter un membre ─────────────────────────────────────
    public function addUser(Request $request, Chantier $chantier)
    {
        $this->authorizeChef($chantier);

        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'role_chantier' => ['required', 'string', Rule::in(array_keys(Chantier::ROLES))],
        ]);

        $user = User::findOrFail($request->user_id);

        // Vérifier qu'il n'est pas déjà membre
        if ($chantier->users()->where('user_id', $user->id)->exists()) {
            return back()->withErrors(['user_id' => __('messages.chantier_user_already')]);
        }

        $chantier->users()->attach($user->id, [
            'role_chantier' => $request->role_chantier,
            'is_creator'    => false,
        ]);

        // Email de notification si l'user a un email
        if ($user->email) {
            $roleLabel = Chantier::ROLES[$request->role_chantier] ?? $request->role_chantier;
            try {
                Mail::to($user->email)->send(new ChantierUserAdded($user, $chantier, $roleLabel));
            } catch (\Exception $e) {
                // Ne pas bloquer si l'email échoue
            }
        }

        return back()->with('success', __('messages.chantier_user_added'));
    }

    // ── Modifier le rôle d'un membre (créateur inclus) ───────
    public function updateUser(Request $request, Chantier $chantier, User $user)
    {
        $this->authorizeChef($chantier);

        $request->validate([
            'role_chantier' => ['required', Rule::in(array_keys(Chantier::ROLES))],
        ]);

        // Mise à jour du rôle — autorisé pour tout le monde (créateur ou non)
        $chantier->users()->updateExistingPivot($user->id, [
            'role_chantier' => $request->role_chantier,
        ]);

        return back()->with('success', __('messages.chantier_user_updated'));
    }

    // ── Retirer un membre ─────────────────────────────────────
    public function removeUser(Chantier $chantier, User $user)
    {
        $this->authorizeChef($chantier);

        $pivot = $chantier->users()->where('user_id', $user->id)->first();
        if ($pivot && $pivot->pivot->is_creator) {
            return back()->withErrors(['remove' => __('messages.chantier_creator_no_remove')]);
        }

        $chantier->users()->detach($user->id);
        return back()->with('success', __('messages.chantier_user_removed'));
    }

    // ── Membres d'un chantier (AJAX pour select responsabilité) ─
    public function members(Chantier $chantier)
    {
        $members = $chantier->users()
            ->get(['users.id', 'users.username', 'chantier_user.role_chantier'])
            ->map(fn($u) => [
                'username'   => $u->username,
                'role_label' => Chantier::ROLES[$u->pivot->role_chantier] ?? $u->pivot->role_chantier,
            ]);

        return response()->json($members);
    }

    // ── Peut voir le chantier (membre ou admin) ───────────────
    private function authorizeChantier(Chantier $chantier): void
    {
        $user = auth()->user();
        if ($user->isAdmin()) return;
        if (!$chantier->users()->where('user_id', $user->id)->exists()) {
            abort(403);
        }
    }

    // ── Peut modifier le chantier (chef de chantier ou admin) ─
    private function authorizeChef(Chantier $chantier): void
    {
        $user = auth()->user();
        if ($user->isAdmin()) return;
        $member = $chantier->users()->where('user_id', $user->id)->first();
        if (!$member || $member->pivot->role_chantier !== 'chef_chantier') {
            abort(403, __('messages.chantier_not_chef'));
        }
    }

    // ── Vérification booléenne (pour la vue) ──────────────────
    private function isChef(Chantier $chantier): bool
    {
        $user = auth()->user();
        if ($user->isAdmin()) return true;
        $member = $chantier->users()->where('user_id', $user->id)->first();
        return $member && $member->pivot->role_chantier === 'chef_chantier';
    }
}
