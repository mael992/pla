<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    // 📊 LISTE
   public function index()
    {
        $incidents = Incident::orderBy('date_incident', 'desc')
            ->paginate(10);

        return view('incidents.index', compact('incidents'));
    }

    // ➕ FORM CREATE
    public function create()
    {
        return view('incidents.create');
    }

    // 💾 STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'date_incident' => 'required|date',
            'departement' => 'required|string',
            'systeme' => 'nullable|string',
            'lot_travail' => 'nullable|string',
            'zone' => 'nullable|string',
            'etiquette' => 'nullable|string',
            'description' => 'required|string',
            'categorie' => 'nullable|string',
            'interne' => 'nullable|string',
            'statut' => 'required|string',
            'responsabilite' => 'nullable|string',
            'emis_par' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        // 📅 date MAJ auto
        $data['date_maj'] = now();

        // 📸 upload photo
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('incidents', 'public');
        }

        Incident::create($data);

        return redirect()->route('incidents.index')->with('success', 'Incident créé');
    }

    // 🔍 SHOW
    public function show($id_incident)
    {
        $incident = Incident::where('id_incident', $id_incident)->firstOrFail();

        return view('incidents.show', compact('incident'));
    }

    // ✏️ EDIT
    public function edit($id_incident)
    {
        $incident = Incident::where('id_incident', $id_incident)->firstOrFail();

        return view('incidents.edit', compact('incident'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id_incident)
    {
        $incident = Incident::where('id_incident', $id_incident)->firstOrFail();

        $data = $request->validate([
            'date_incident' => 'required|date',
            'departement' => 'required|string',
            'systeme' => 'nullable|string',
            'lot_travail' => 'nullable|string',
            'zone' => 'nullable|string',
            'etiquette' => 'nullable|string',
            'description' => 'required|string',
            'categorie' => 'nullable|string',
            'interne' => 'nullable|string',
            'statut' => 'required|string',
            'responsabilite' => 'nullable|string',
            'emis_par' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        // 📅 update date MAJ
        $data['date_maj'] = now();

        // 📸 update photo
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('incidents', 'public');
        }

        $incident->update($data);

        return redirect()->route('incidents.index')->with('success', 'Incident modifié');
    }

    // 🗑 DELETE
    public function destroy($id_incident)
    {
        $incident = Incident::where('id_incident', $id_incident)->firstOrFail();

        $incident->delete();

        return redirect()->route('incidents.index')->with('success', 'Incident supprimé');
    }
}