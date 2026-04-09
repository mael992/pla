<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Zone;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index()
    {
        $incidents = Incident::with('zoneobj')->latest('id_incident')->get();
        return view('incidents.index', compact('incidents'));
    }

    public function create()
    {
        $zones = Zone::orderBy('name')->get();
        return view('incidents.create', compact('zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'discipline'   => 'required',
            'systeme'      => 'required',
            'lot_travail'  => 'required',
            'zone_id'      => 'required',
            'description'  => 'required',
            'categorie'    => 'required',
            'statut'       => 'required',
            'photo_ouverte'=> 'nullable|image|max:5120',
            'photo_fermee' => 'nullable|image|max:5120',
        ]);

        $data = $request->except(['_token', 'date_cloture']);
        $data['emis_par'] = auth()->user()->username;

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
        // with('zone') force le chargement de la relation
        $incident = Incident::with('zoneobj')->findOrFail($id);

        return view('incidents.show', compact('incident'));
    }

   public function edit($id)
    {
        $incident = Incident::with('zoneobj')->findOrFail($id);
        $zones    = Zone::orderBy('name')->get();

        return view('incidents.edit', compact('incident', 'zones'));
    }

    public function update(Request $request, $id)
    {
        $incident = Incident::findOrFail($id);

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

        $request->validate([
            'discipline'   => 'required',
            'systeme'      => 'required',
            'lot_travail'  => 'required',
            'zone_id'      => 'required',
            'description'  => 'required',
            'categorie'    => 'required',
            'statut'       => 'required',
            'photo_ouverte'=> 'nullable|image|max:5120',
            'photo_fermee' => 'nullable|image|max:5120',
        ]);

        $data = $request->except(['_token', '_method', 'date_cloture']);

        if ($request->hasFile('photo_ouverte')) {
            $data['photo_ouverte'] = $request->file('photo_ouverte')
                ->store('incidents', 'public');
            $data['date_emis'] = now()->toDateString();
        }

        if ($request->hasFile('photo_fermee')) {
            $data['photo_fermee'] = $request->file('photo_fermee')
                ->store('incidents', 'public');
            $data['date_maj'] = now()->toDateString();
        }

        if ($request->statut === 'fermer') {
            $data['date_cloture'] = now()->toDateString();
        } else {
            $data['date_cloture'] = null;
        }

        $incident->update($data);

        return redirect()->route('incidents.index')
            ->with('success', 'Incident modifié.');
    }

    public function destroy($id)
    {
        Incident::findOrFail($id)->delete();
        return redirect()->route('incidents.index')
            ->with('success', 'Incident supprimé.');
    }

    /**
 * POLL — retourne les incidents plus récents qu'un ID donné
 */
    public function poll(Request $request)
    {
        $lastId = (int) $request->query('last_id', 0);

        $nouveaux = Incident::with('zoneObj')
            ->where('id_incident', '>', $lastId)
            ->latest('id_incident')
            ->get()
            ->map(function ($i) {
                return [
                    'id'         => $i->id_incident,
                    'date_emis'  => $i->date_emis
                        ? \Carbon\Carbon::parse($i->date_emis)->format('d/m/Y')
                        : '—',
                    'zone'       => $i->zoneObj->name ?? '—',
                    'discipline' => $i->discipline ?? '—',
                    'categorie'  => $i->categorie ?? '—',
                    'statut'     => $i->statut ?? '—',
                    'url_voir'   => route('incidents.show', $i->id_incident),
                    'url_edit'   => route('incidents.edit', $i->id_incident),
                    'url_delete' => route('incidents.destroy', $i->id_incident),
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