<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
/* ══ RESET ══ */
* { margin:0; padding:0; box-sizing:border-box; }

body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 9pt;
    color: #111;
    background: #fff;
}

/* ══ COUVERTURE ══ */
.cover {
    width: 100%;
    text-align: center;
    padding-top: 60px;
    page-break-after: always;
}
.cover-logo {
    max-width: 220px;
    max-height: 80px;
    margin: 0 auto 20px;
    display: block;
}
.cover-rule {
    width: 70px;
    height: 4px;
    background: #e30613;
    margin: 0 auto 22px;
}
.cover-title {
    font-size: 22pt;
    font-weight: bold;
    color: #111;
    margin-bottom: 10px;
}
.cover-chantier {
    font-size: 14pt;
    font-weight: bold;
    color: #e30613;
    margin-bottom: 4px;
}
.cover-localite {
    font-size: 11pt;
    color: #666;
    margin-bottom: 30px;
}
.cover-kpis {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
}
.cover-kpis td {
    width: 25%;
    padding: 14px 10px;
    text-align: center;
    vertical-align: middle;
}
.kpi-val {
    display: block;
    font-size: 28pt;
    font-weight: bold;
    line-height: 1;
    color: #111;
}
.kpi-val.red    { color: #e30613; }
.kpi-val.green  { color: #16a34a; }
.kpi-val.orange { color: #ea580c; }
.kpi-lbl {
    display: block;
    font-size: 7.5pt;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #888;
    margin-top: 4px;
}
.cover-date {
    font-size: 8pt;
    color: #aaa;
    margin-top: 30px;
}

/* ══ EN-TÊTE PAGE TABLEAU ══ */
.page-header {
    width: 100%;
    border-bottom: 3px solid #e30613;
    margin-bottom: 8px;
}
.page-header-inner {
    width: 100%;
    border-collapse: collapse;
}
.page-header-inner td {
    padding-bottom: 5px;
    vertical-align: bottom;
}
.hdr-title { font-size: 11pt; font-weight: bold; color: #111; }
.hdr-sub   { font-size: 8pt; color: #888; margin-top: 2px; }
.hdr-right { text-align: right; font-size: 7.5pt; color: #bbb; }

/* ══ TABLEAU ANOMALIES ══ */
.tbl {
    width: 100%;
    border-collapse: collapse;
    font-size: 7.5pt;
}
.tbl thead tr {
    background: #111111;
    color: #ffffff;
}
.tbl th {
    padding: 5px 4px;
    text-align: left;
    font-size: 7.5pt;
    font-weight: bold;
    color: #ffffff;
    white-space: nowrap;
    border: none;
}
.tbl tbody tr.even { background: #f5f5f5; }
.tbl tbody tr.odd  { background: #ffffff; }
.tbl td {
    padding: 4px 4px;
    border-bottom: 1px solid #e5e5e5;
    font-size: 7.5pt;
    color: #111;
    vertical-align: middle;
}

/* Ref badge */
.ref {
    font-family: DejaVu Sans Mono, monospace;
    font-size: 7pt;
    font-weight: bold;
    color: #c0020c;
    background: #fde8ea;
    padding: 2px 4px;
    border-radius: 2px;
    white-space: nowrap;
}

/* Statut badges */
.st {
    display: inline-block;
    padding: 2px 5px;
    border-radius: 3px;
    font-size: 7pt;
    font-weight: bold;
    white-space: nowrap;
}
.st-ouvert   { background: #fee2e2; color: #991b1b; }
.st-en_cours { background: #ffedd5; color: #9a3412; }
.st-fermer   { background: #dcfce7; color: #166534; }
.st-na       { background: #e5e7eb; color: #4b5563; }

/* ══ PAGE STATS ══ */
.stats-page { page-break-before: always; padding: 0; }

.stats-header {
    border-bottom: 3px solid #e30613;
    padding-bottom: 6px;
    margin-bottom: 12px;
}
.stats-h1  { font-size: 13pt; font-weight: bold; color: #111; }
.stats-sub { font-size: 8pt; color: #777; margin-top: 3px; }

/* Carte globale */
.global-card {
    background: #f1f5f9;
    border-left: 5px solid #e30613;
    padding: 12px 16px;
    margin-bottom: 16px;
    width: 100%;
}
.global-inner { width: 100%; border-collapse: collapse; }
.global-inner td { vertical-align: middle; padding: 0; }
.global-pct-cell { width: 90px; }
.g-pct  { font-size: 36pt; font-weight: bold; color: #e30613; line-height: 1; }
.g-lbl  { font-size: 10pt; font-weight: bold; color: #333; }
.g-det  { font-size: 8pt; color: #888; margin-top: 3px; }

/* Tableau discipline */
.stats-tbl { width: 100%; border-collapse: collapse; }
.stats-tbl th {
    background: #111;
    color: #fff;
    padding: 6px 8px;
    font-size: 8pt;
    font-weight: bold;
    text-align: left;
}
.stats-tbl td {
    padding: 7px 8px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 8pt;
    color: #111;
    vertical-align: middle;
}
.stats-tbl tr.even td { background: #f9fafb; }
.stats-tbl tr.odd  td { background: #ffffff; }

.disc-name { font-weight: bold; color: #111; }

/* Barre de progression */
.bar-wrap {
    background: #e5e7eb;
    border-radius: 3px;
    height: 9px;
    width: 110px;
    overflow: hidden;
    display: inline-block;
    vertical-align: middle;
}
.bar-fill {
    height: 9px;
    border-radius: 3px;
}
.bar-low    { background: #ef4444; }
.bar-medium { background: #f97316; }
.bar-high   { background: #22c55e; }
.pct-inline {
    font-size: 8pt;
    font-weight: bold;
    margin-left: 5px;
    vertical-align: middle;
}

/* Pied de page fixe */
.footer {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    border-top: 1px solid #ddd;
    padding: 3px 10px;
    font-size: 7pt;
    color: #bbb;
    text-align: center;
    background: #fff;
}
</style>
</head>
<body>

{{-- ══════════════════════════════════════════
     PAGE DE COUVERTURE
══════════════════════════════════════════ --}}
<div class="cover">

    @if($logoData)
        <img src="{{ $logoData }}" class="cover-logo" alt="PlanEx">
    @else
        <div style="font-size:20pt;font-weight:bold;color:#e30613;margin-bottom:20px;">PlanEx</div>
    @endif

    <div class="cover-rule"></div>

    <div class="cover-title">Rapport des anomalies</div>

    @if($chantier)
        <div class="cover-chantier">{{ $chantier->nom }}</div>
        <div class="cover-localite">{{ $chantier->localite }}</div>
    @else
        <div class="cover-localite">Tous chantiers confondus</div>
    @endif

    <table class="cover-kpis">
        <tr>
            <td>
                <span class="kpi-val">{{ $globalTotal }}</span>
                <span class="kpi-lbl">Total anomalies</span>
            </td>
            <td>
                <span class="kpi-val red">{{ $incidents->whereIn('statut',['ouvert','en_cours'])->count() }}</span>
                <span class="kpi-lbl">En cours / ouvertes</span>
            </td>
            <td>
                <span class="kpi-val green">{{ $globalClosed }}</span>
                <span class="kpi-lbl">Fermées</span>
            </td>
            <td>
                <span class="kpi-val orange">{{ $globalPct }}%</span>
                <span class="kpi-lbl">Taux de clôture</span>
            </td>
        </tr>
    </table>

    <div class="cover-date">
        Généré le {{ now()->format('d/m/Y à H:i') }} — PlanEx
    </div>
</div>


{{-- ══════════════════════════════════════════
     TABLEAU DES ANOMALIES
══════════════════════════════════════════ --}}
<div class="page-header">
    <table class="page-header-inner">
        <tr>
            <td>
                <div class="hdr-title">
                    Tableau des anomalies
                    @if($chantier) — {{ $chantier->nom }} @endif
                </div>
                <div class="hdr-sub">{{ $globalTotal }} anomalie(s) — au {{ now()->format('d/m/Y') }}</div>
            </td>
            <td class="hdr-right">PlanEx · Export PDF</td>
        </tr>
    </table>
</div>

<table class="tbl">
    <thead>
        <tr>
            <th>Réf.</th>
            <th>Discipline</th>
            <th>Système</th>
            <th>Lot travail</th>
            <th>Zone</th>
            <th>Étiquette</th>
            <th>Catég.</th>
            <th>Statut</th>
            <th>Émis le</th>
            <th>Clôture prévue</th>
            <th>Clôturé le</th>
            <th>Émis par</th>
            <th>QFC ouv.</th>
            <th>QFC ferm.</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
    @forelse($incidents as $i => $incident)
        @php
            $st      = $incident->statut ?? 'na';
            $stLbl   = ['ouvert'=>'Ouvert','en_cours'=>'En cours','fermer'=>'Fermé','na'=>'N/A'][$st] ?? $st;
            $rowClass= $i % 2 === 0 ? 'odd' : 'even';
        @endphp
        <tr class="{{ $rowClass }}">
            <td><span class="ref">{{ $incident->reference ?? '#'.$incident->id_incident }}</span></td>
            <td>{{ $incident->discipline ?? '—' }}</td>
            <td>{{ $incident->systeme ?? '—' }}</td>
            <td>{{ $incident->lot_travail ?? '—' }}</td>
            <td>{{ $incident->zoneobj->name ?? '—' }}</td>
            <td>{{ $incident->etiquette ?? '—' }}</td>
            <td>{{ $incident->categorie ?? '—' }}</td>
            <td><span class="st st-{{ $st }}">{{ $stLbl }}</span></td>
            <td>{{ $incident->date_emis     ? \Carbon\Carbon::parse($incident->date_emis)->format('d/m/Y')     : '—' }}</td>
            <td>{{ $incident->cloture_prevue ? \Carbon\Carbon::parse($incident->cloture_prevue)->format('d/m/Y') : '—' }}</td>
            <td>{{ $incident->date_cloture  ? \Carbon\Carbon::parse($incident->date_cloture)->format('d/m/Y')  : '—' }}</td>
            <td>{{ $incident->emis_par ?? '—' }}</td>
            <td>{{ $incident->qfc_ouvert ?? '—' }}</td>
            <td>{{ $incident->qfc_ferme  ?? '—' }}</td>
            <td style="max-width:130px;">{{ \Illuminate\Support\Str::limit($incident->description ?? '', 75) }}</td>
        </tr>
    @empty
        <tr class="odd">
            <td colspan="15" style="text-align:center;padding:16px;color:#999;">
                Aucune anomalie.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>


{{-- ══════════════════════════════════════════
     DERNIÈRE PAGE — STATISTIQUES
══════════════════════════════════════════ --}}
<div class="stats-page">

    <div class="stats-header">
        <div class="stats-h1">Récapitulatif d'avancement par discipline</div>
        <div class="stats-sub">
            {{ $globalTotal }} anomalie(s)
            @if($chantier) — chantier <strong>{{ $chantier->nom }}</strong> ({{ $chantier->localite }}) @endif
            — au {{ now()->format('d/m/Y') }}
        </div>
    </div>

    {{-- Carte globale --}}
    <div class="global-card">
        <table class="global-inner">
            <tr>
                <td class="global-pct-cell">
                    <span class="g-pct">{{ $globalPct }}%</span>
                </td>
                <td>
                    <div class="g-lbl">Taux global de clôture</div>
                    <div class="g-det">{{ $globalClosed }} fermée(s) sur {{ $globalTotal }} anomalie(s)</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- Détail par discipline --}}
    @if($statsByDiscipline->isNotEmpty())
    <table class="stats-tbl">
        <thead>
            <tr>
                <th>Discipline</th>
                <th style="text-align:center">Total</th>
                <th style="text-align:center">Fermées</th>
                <th style="text-align:center">Ouvertes</th>
                <th style="text-align:center">En cours</th>
                <th style="text-align:center">%</th>
                <th>Progression</th>
            </tr>
        </thead>
        <tbody>
        @foreach($statsByDiscipline as $disc => $s)
            @php
                $pct      = $s['pct'];
                $barCls   = $pct >= 70 ? 'bar-high' : ($pct >= 30 ? 'bar-medium' : 'bar-low');
                $pctColor = $pct >= 70 ? '#166534'  : ($pct >= 30 ? '#9a3412'    : '#991b1b');
                $rCls     = $loop->index % 2 === 0 ? 'odd' : 'even';
            @endphp
            <tr class="{{ $rCls }}">
                <td class="disc-name">{{ $disc }}</td>
                <td style="text-align:center;font-weight:bold;">{{ $s['total'] }}</td>
                <td style="text-align:center;color:#166534;font-weight:bold;">{{ $s['fermer'] }}</td>
                <td style="text-align:center;color:#991b1b;">{{ $s['ouvert'] }}</td>
                <td style="text-align:center;color:#9a3412;">{{ $s['en_cours'] }}</td>
                <td style="text-align:center;font-weight:bold;font-size:9pt;">{{ $pct }}%</td>
                <td>
                    <div class="bar-wrap">
                        <div class="bar-fill {{ $barCls }}" style="width:{{ $pct }}%;"></div>
                    </div>
                    <span class="pct-inline" style="color:{{ $pctColor }};">
                        {{ $s['fermer'] }}/{{ $s['total'] }}
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif

</div>

{{-- Pied de page sur toutes les pages --}}
<div class="footer">
    PlanEx &bull; Rapport généré le {{ now()->format('d/m/Y à H:i') }}
    @if($chantier) &bull; {{ $chantier->nom }} — {{ $chantier->localite }} @endif
</div>

</body>
</html>
