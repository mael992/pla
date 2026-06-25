<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::orderBy('name')->get();
        return view('zones.index', compact('zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:zones,name',
        ]);

        $zone = Zone::create(['name' => $request->name]);

        if ($request->expectsJson()) {
            return response()->json(['id' => $zone->id, 'name' => $zone->name]);
        }

        return redirect()->route('zones.index')
            ->with('success', 'Zone ajoutée.');
    }

    public function destroy(Zone $zone)
    {
        // Suppression réservée aux administrateurs
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        // Les incidents liés sont conservés : on détache la zone et on les marque
        // "réselection de zone nécessaire" (au lieu de bloquer la suppression).
        $count = $zone->incidents()->count();
        $zone->incidents()->update(['zone_id' => null, 'zone_reselect' => true]);

        $zone->delete();

        $msg = $count > 0
            ? __('messages.zone_deleted_reselect', ['count' => $count])
            : __('messages.zone_deleted');

        return redirect()->route('zones.index')->with('success', $msg);
    }
}