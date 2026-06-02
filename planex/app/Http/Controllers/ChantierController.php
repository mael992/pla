<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use Illuminate\Http\Request;

class ChantierController extends Controller
{
    public function index()
    {
        $chantiers = Chantier::withCount('incidents')->orderBy('nom')->get();
        return view('chantiers.index', compact('chantiers'));
    }

    public function show(Chantier $chantier)
    {
        $incidents = $chantier->incidents()->with('zoneobj')->latest('id_incident')->get();

        // Données pour le camembert — groupement par statut
        $statutColors = [
            'ouvert'   => ['label' => __('messages.status_open'),        'color' => '#ef4444'],
            'en_cours' => ['label' => __('messages.status_in_progress'),  'color' => '#f97316'],
            'fermer'   => ['label' => __('messages.status_closed'),       'color' => '#22c55e'],
            'na'       => ['label' => __('messages.status_na'),           'color' => '#94a3b8'],
        ];

        $grouped = $incidents->groupBy('statut');

        $chartLabels = [];
        $chartData   = [];
        $chartColors = [];
        $stats       = [];

        foreach ($statutColors as $key => $info) {
            $count = $grouped->get($key, collect())->count();
            if ($count > 0) {
                $chartLabels[] = strip_tags($info['label']);
                $chartData[]   = $count;
                $chartColors[] = $info['color'];
            }
            $stats[$key] = $count;
        }

        return view('chantiers.show', compact(
            'chantier', 'incidents',
            'chartLabels', 'chartData', 'chartColors',
            'stats'
        ));
    }

    public function create()
    {
        return view('chantiers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:255',
            'localite' => 'required|string|max:255',
        ]);

        Chantier::create($request->only('nom', 'localite'));

        return redirect()->route('chantiers.index')
            ->with('success', __('messages.chantier_created'));
    }

    public function edit(Chantier $chantier)
    {
        return view('chantiers.edit', compact('chantier'));
    }

    public function update(Request $request, Chantier $chantier)
    {
        $request->validate([
            'nom'      => 'required|string|max:255',
            'localite' => 'required|string|max:255',
        ]);

        $chantier->update($request->only('nom', 'localite'));

        return redirect()->route('chantiers.index')
            ->with('success', __('messages.chantier_updated'));
    }

    public function destroy(Chantier $chantier)
    {
        // Les anomalies liées auront chantier_id = NULL (nullOnDelete)
        $chantier->delete();

        return redirect()->route('chantiers.index')
            ->with('success', __('messages.chantier_deleted'));
    }
}
