<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Incident;
use App\Models\Zone;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IncidentController extends Controller
{
    public function index(Request $request)
    {
        $user  = auth()->user();
        $query = Incident::with('zoneobj', 'chantier')
            ->visibleTo($user)
            ->latest('id_incident');

        if ($request->filled('chantier_id')) {
            $query->where('chantier_id', $request->chantier_id);
        } elseif ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('chantier', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('localite', 'like', "%{$search}%");
            });
        }

        $incidents      = $query->get();
        $activeSearch   = $request->input('search', '');
        $activeChantier = $request->filled('chantier_id') ? Chantier::find($request->chantier_id) : null;

        return view('incidents.index', compact('incidents', 'activeSearch', 'activeChantier'));
    }

    /**
     * Export PDF — tableau complet + stats par discipline
     */
    public function exportPdf(Request $request)
    {
        $query = Incident::with('zoneobj', 'chantier')->orderBy('id_incident');

        $chantier = null;
        if ($request->filled('chantier_id')) {
            $chantier = Chantier::find($request->chantier_id);
            $query->where('chantier_id', $request->chantier_id);
        } elseif ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('chantier', fn($q) =>
                $q->where('nom', 'like', "%{$search}%")->orWhere('localite', 'like', "%{$search}%")
            );
        }

        $incidents = $query->get();

        // ── Stats par discipline ──────────────────────────────
        $statsByDiscipline = $incidents
            ->whereNotNull('discipline')
            ->groupBy('discipline')
            ->map(fn($group) => [
                'total'   => $group->count(),
                'fermer'  => $group->where('statut', 'fermer')->count(),
                'ouvert'  => $group->where('statut', 'ouvert')->count(),
                'en_cours'=> $group->where('statut', 'en_cours')->count(),
                'pct'     => $group->count() > 0
                    ? round($group->where('statut', 'fermer')->count() / $group->count() * 100)
                    : 0,
            ])
            ->sortByDesc('pct');

        $globalTotal  = $incidents->count();
        $globalClosed = $incidents->where('statut', 'fermer')->count();
        $globalPct    = $globalTotal > 0 ? round($globalClosed / $globalTotal * 100) : 0;

        $logoPath  = public_path('images/Planex.jpg');
        $logoData  = file_exists($logoPath)
            ? 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath))
            : null;

        $pdf = Pdf::loadView('pdf.incidents', compact(
            'incidents', 'chantier',
            'statsByDiscipline', 'globalTotal', 'globalClosed', 'globalPct',
            'logoData'
        ))->setPaper('a4', 'landscape');

        $filename = 'anomalies_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * AJAX — suggestions autocomplete (nom + localité chantier)
     */
    public function searchSuggestions(Request $request)
    {
        $q = $request->input('q', '');

        if (strlen($q) < 1) {
            return response()->json([]);
        }

        $chantiers = Chantier::where('nom', 'like', "%{$q}%")
            ->orWhere('localite', 'like', "%{$q}%")
            ->orderBy('nom')
            ->limit(8)
            ->get(['id', 'nom', 'localite']);

        return response()->json($chantiers);
    }

    public function create()
    {
        $user      = auth()->user();
        $zones     = Zone::orderBy('name')->get();
        $chantiers = $user->isAdmin()
            ? Chantier::orderBy('nom')->get()
            : $user->chantiers()->orderBy('nom')->get();
        return view('incidents.create', compact('zones', 'chantiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'discipline'    => 'required',
            'chantier_id'   => 'required|exists:chantiers,id',
            'responsabilite'=> 'required|string|max:255',
            'systeme'       => 'nullable',
            'lot_travail'   => 'nullable',
            'zone_id'       => 'nullable',
            'description'   => 'nullable',
            'categorie'     => 'nullable',
            'statut'        => 'nullable',
            'photo_ouverte' => 'required|image|max:5120',
            'photo_fermee'  => 'nullable|image|max:5120',
        ]);

        $data = $request->except(['_token', 'date_cloture']);
        $data['emis_par']  = auth()->user()->username;
        $data['reference'] = Incident::generateReference();

        // Photo ouverte → date_emis auto
        if ($request->hasFile('photo_ouverte')) {
            $data['photo_ouverte'] = $request->file('photo_ouverte')
                ->store('incidents', 'public');
            $data['date_emis'] = now()->toDateString();
        }

        // Photo fermée → date_maj auto
        if ($request->hasFile('photo_fermee')) {
            $data['photo_fermee'] = $request->file('photo_fermee')
                ->store('incidents', 'public');
            $data['date_maj'] = now()->toDateString();
        }

        // Statut fermé → date_cloture auto
        if ($request->statut === 'fermer') {
            $data['date_cloture'] = now()->toDateString();
        } else {
            $data['date_cloture'] = null;
        }

        Incident::create($data);

        return redirect()->route('incidents.index')
            ->with('success', 'Incident créé avec succès.');
    }

    public function show($id)
    {
        $user     = auth()->user();
        $incident = Incident::with('zoneobj', 'chantier')->findOrFail($id);

        $this->authorizeVisible($incident, $user);

        return view('incidents.show', compact('incident'));
    }

    public function edit($id)
    {
        $user     = auth()->user();
        $incident = Incident::with('zoneobj', 'chantier')->findOrFail($id);

        $this->authorizeVisible($incident, $user);

        $zones     = Zone::orderBy('name')->get();
        $chantiers = $user->isAdmin()
            ? Chantier::orderBy('nom')->get()
            : $user->chantiers()->orderBy('nom')->get();

        return view('incidents.edit', compact('incident', 'zones', 'chantiers'));
    }

    public function update(Request $request, $id)
{
    $incident = Incident::findOrFail($id);

    $this->authorizeVisible($incident, auth()->user());

    // Si fermé, seul le statut est modifiable
    if ($incident->statut === 'fermer') {
        $newStatut = $request->input('statut');
        if ($newStatut && $newStatut !== 'fermer') {
            $incident->update([
                'statut'       => $newStatut,
                'date_cloture' => null,
            ]);
            return redirect()->route('incidents.index')
                ->with('success', 'Statut réouvert.');
        }
        return redirect()->back()
            ->with('error', 'Incident fermé — seul le statut peut être modifié.');
    }

    // Vérifie si après modification la photo ouverte sera toujours présente
    // (obligatoire : soit elle existe déjà et n'est pas supprimée, soit une nouvelle est uploadée)
    $photoOuverteExisteApres = (
        $request->hasFile('photo_ouverte')
    ) || (
        !empty($incident->photo_ouverte) && $request->input('remove_photo_ouverte') != '1'
    );

    $request->validate([
        'discipline'     => 'required',
        'chantier_id'    => 'required|exists:chantiers,id',
        'responsabilite' => 'required|string|max:255',
        'systeme'        => 'nullable',
        'lot_travail'    => 'nullable',
        'zone_id'        => 'nullable',
        'description'    => 'nullable',
        'categorie'      => 'nullable',
        'statut'         => 'nullable',
        'photo_ouverte'  => 'nullable|image|max:5120',
        'photo_fermee'   => 'nullable|image|max:5120',
    ]);

    // Validation manuelle : photo ouverte obligatoire après modification
    if (!$photoOuverteExisteApres) {
        return redirect()->back()
            ->withErrors(['photo_ouverte' => 'La photo ouverte est obligatoire.'])
            ->withInput();
    }

    $data = $request->except(['_token', '_method', 'date_cloture',
                               'remove_photo_ouverte', 'remove_photo_fermee']);

    // ===== SUPPRESSION PHOTO OUVERTE =====
    if ($request->input('remove_photo_ouverte') == '1') {
        if (!empty($incident->photo_ouverte)
            && Storage::disk('public')->exists($incident->photo_ouverte)) {
            Storage::disk('public')->delete($incident->photo_ouverte);
        }
        $data['photo_ouverte'] = null;
        $data['date_emis']     = null;
    }

    // ===== SUPPRESSION PHOTO FERMÉE =====
    if ($request->input('remove_photo_fermee') == '1') {
        if (!empty($incident->photo_fermee)
            && Storage::disk('public')->exists($incident->photo_fermee)) {
            Storage::disk('public')->delete($incident->photo_fermee);
        }
        $data['photo_fermee'] = null;
        $data['date_maj']     = null;
    }

    // ===== NOUVELLE PHOTO OUVERTE =====
    if ($request->hasFile('photo_ouverte')) {
        if ($incident->photo_ouverte) {
            Storage::disk('public')->delete($incident->photo_ouverte);
        }
        $data['photo_ouverte'] = $request->file('photo_ouverte')
            ->store('incidents', 'public');
        $data['date_emis'] = now()->toDateString();
    }

    // ===== NOUVELLE PHOTO FERMÉE =====
    if ($request->hasFile('photo_fermee')) {
        if ($incident->photo_fermee) {
            Storage::disk('public')->delete($incident->photo_fermee);
        }
        $data['photo_fermee'] = $request->file('photo_fermee')
            ->store('incidents', 'public');
        $data['date_maj'] = now()->toDateString();
    }

    // ===== STATUT =====
    if (isset($data['statut']) && $data['statut'] === 'fermer') {
        $data['date_cloture'] = now()->toDateString();
    } else {
        $data['date_cloture'] = null;
    }

    // ← MANQUAIT : sauvegarde + redirect
    $incident->update($data);

    return redirect()->route('incidents.index')
        ->with('success', 'Incident modifié.');
    }

   public function destroy($id)
    {
        $incident = Incident::findOrFail($id);

        $this->authorizeVisible($incident, auth()->user());

        if ($incident->photo_ouverte) {
            Storage::disk('public')->delete($incident->photo_ouverte);
        }

        if ($incident->photo_fermee) {
            Storage::disk('public')->delete($incident->photo_fermee);
        }

        // Récupère l'année avant suppression pour renuméroter
        $year = $incident->date_emis
            ? (int) \Carbon\Carbon::parse($incident->date_emis)->year
            : now()->year;

        $incident->delete();

        // Renumérotation dense : comble le trou laissé par la suppression
        Incident::renumberYear($year);

        return redirect()->route('incidents.index')
            ->with('success', 'Anomalie supprimée — références renumérotées.');
    }

    /**
     * Vérifie que l'utilisateur peut voir/modifier l'incident, sinon 403.
     */
    private function authorizeVisible(Incident $incident, $user): void
    {
        if ($user->isAdmin()) return;

        $visible = Incident::visibleTo($user)
            ->where('id_incident', $incident->id_incident)
            ->exists();

        if (!$visible) {
            abort(403);
        }
    }

    /**
     * POLL — retourne les incidents plus récents qu'un ID donné.
     * Applique le MÊME filtrage que index() (visibilité + filtre actif),
     * sinon le temps réel ré-affiche des anomalies hors périmètre.
     */
    public function poll(Request $request)
    {
        $user   = auth()->user();
        $lastId = (int) $request->query('last_id', 0);

        $query = Incident::with('zoneObj')
            ->visibleTo($user)
            ->where('id_incident', '>', $lastId);

        if ($request->filled('chantier_id')) {
            $query->where('chantier_id', $request->query('chantier_id'));
        } elseif ($request->filled('search')) {
            $search = $request->query('search');
            $query->whereHas('chantier', fn($q) =>
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('localite', 'like', "%{$search}%")
            );
        }

        $nouveaux = $query
            ->latest('id_incident')
            ->get()
            ->map(function ($i) {
                return [
                    'id'            => $i->id_incident,
                    'reference'     => $i->reference ?? ('#' . $i->id_incident),
                    'date_emis'     => $i->date_emis
                        ? \Carbon\Carbon::parse($i->date_emis)->format('d/m/Y')
                        : '—',
                    'date_cloture'  => $i->date_cloture
                        ? \Carbon\Carbon::parse($i->date_cloture)->format('d/m/Y')
                        : '—',
                    'photo_ouverte' => $i->photo_ouverte,
                    'photo_fermee'  => $i->photo_fermee,
                    'zone'          => $i->zoneObj->name ?? '—',
                    'discipline'    => $i->discipline ?? '—',
                    'categorie'     => $i->categorie_label ?? '—',
                    'statut'        => $i->statut ?? '—',
                    'url_voir'      => route('incidents.show', $i->id_incident),
                    'url_edit'      => route('incidents.edit', $i->id_incident),
                    'url_delete'    => route('incidents.destroy', $i->id_incident),
                ];
            });

        return response()->json([
            'nouveaux' => $nouveaux,
            'last_id'  => $nouveaux->isNotEmpty()
                ? $nouveaux->first()['id']
                : $lastId,
        ]);
    }
}