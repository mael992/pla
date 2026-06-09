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


<div class="cover">

    <?php if($logoData): ?>
        <img src="<?php echo e($logoData); ?>" class="cover-logo" alt="PlanEx">
    <?php else: ?>
        <div style="font-size:20pt;font-weight:bold;color:#e30613;margin-bottom:20px;">PlanEx</div>
    <?php endif; ?>

    <div class="cover-rule"></div>

    <div class="cover-title">Rapport des anomalies</div>

    <?php if($chantier): ?>
        <div class="cover-chantier"><?php echo e($chantier->nom); ?></div>
        <div class="cover-localite"><?php echo e($chantier->localite); ?></div>
    <?php else: ?>
        <div class="cover-localite">Tous chantiers confondus</div>
    <?php endif; ?>

    <table class="cover-kpis">
        <tr>
            <td>
                <span class="kpi-val"><?php echo e($globalTotal); ?></span>
                <span class="kpi-lbl">Total anomalies</span>
            </td>
            <td>
                <span class="kpi-val red"><?php echo e($incidents->whereIn('statut',['ouvert','en_cours'])->count()); ?></span>
                <span class="kpi-lbl">En cours / ouvertes</span>
            </td>
            <td>
                <span class="kpi-val green"><?php echo e($globalClosed); ?></span>
                <span class="kpi-lbl">Fermées</span>
            </td>
            <td>
                <span class="kpi-val orange"><?php echo e($globalPct); ?>%</span>
                <span class="kpi-lbl">Taux de clôture</span>
            </td>
        </tr>
    </table>

    <div class="cover-date">
        Généré le <?php echo e(now()->format('d/m/Y à H:i')); ?> — PlanEx
    </div>
</div>



<div class="page-header">
    <table class="page-header-inner">
        <tr>
            <td>
                <div class="hdr-title">
                    Tableau des anomalies
                    <?php if($chantier): ?> — <?php echo e($chantier->nom); ?> <?php endif; ?>
                </div>
                <div class="hdr-sub"><?php echo e($globalTotal); ?> anomalie(s) — au <?php echo e(now()->format('d/m/Y')); ?></div>
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
    <?php $__empty_1 = true; $__currentLoopData = $incidents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $incident): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $st      = $incident->statut ?? 'na';
            $stLbl   = ['ouvert'=>'Ouvert','en_cours'=>'En cours','fermer'=>'Fermé','na'=>'N/A'][$st] ?? $st;
            $rowClass= $i % 2 === 0 ? 'odd' : 'even';
        ?>
        <tr class="<?php echo e($rowClass); ?>">
            <td><span class="ref"><?php echo e($incident->reference ?? '#'.$incident->id_incident); ?></span></td>
            <td><?php echo e($incident->discipline ?? '—'); ?></td>
            <td><?php echo e($incident->systeme ?? '—'); ?></td>
            <td><?php echo e($incident->lot_travail ?? '—'); ?></td>
            <td><?php echo e($incident->zoneobj->name ?? '—'); ?></td>
            <td><?php echo e($incident->etiquette ?? '—'); ?></td>
            <td><?php echo e($incident->categorie ?? '—'); ?></td>
            <td><span class="st st-<?php echo e($st); ?>"><?php echo e($stLbl); ?></span></td>
            <td><?php echo e($incident->date_emis     ? \Carbon\Carbon::parse($incident->date_emis)->format('d/m/Y')     : '—'); ?></td>
            <td><?php echo e($incident->cloture_prevue ? \Carbon\Carbon::parse($incident->cloture_prevue)->format('d/m/Y') : '—'); ?></td>
            <td><?php echo e($incident->date_cloture  ? \Carbon\Carbon::parse($incident->date_cloture)->format('d/m/Y')  : '—'); ?></td>
            <td><?php echo e($incident->emis_par ?? '—'); ?></td>
            <td><?php echo e($incident->qfc_ouvert ?? '—'); ?></td>
            <td><?php echo e($incident->qfc_ferme  ?? '—'); ?></td>
            <td style="max-width:130px;"><?php echo e(\Illuminate\Support\Str::limit($incident->description ?? '', 75)); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr class="odd">
            <td colspan="15" style="text-align:center;padding:16px;color:#999;">
                Aucune anomalie.
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>



<div class="stats-page">

    <div class="stats-header">
        <div class="stats-h1">Récapitulatif d'avancement par discipline</div>
        <div class="stats-sub">
            <?php echo e($globalTotal); ?> anomalie(s)
            <?php if($chantier): ?> — chantier <strong><?php echo e($chantier->nom); ?></strong> (<?php echo e($chantier->localite); ?>) <?php endif; ?>
            — au <?php echo e(now()->format('d/m/Y')); ?>

        </div>
    </div>

    
    <div class="global-card">
        <table class="global-inner">
            <tr>
                <td class="global-pct-cell">
                    <span class="g-pct"><?php echo e($globalPct); ?>%</span>
                </td>
                <td>
                    <div class="g-lbl">Taux global de clôture</div>
                    <div class="g-det"><?php echo e($globalClosed); ?> fermée(s) sur <?php echo e($globalTotal); ?> anomalie(s)</div>
                </td>
            </tr>
        </table>
    </div>

    
    <?php if($statsByDiscipline->isNotEmpty()): ?>
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
        <?php $__currentLoopData = $statsByDiscipline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disc => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $pct      = $s['pct'];
                $barCls   = $pct >= 70 ? 'bar-high' : ($pct >= 30 ? 'bar-medium' : 'bar-low');
                $pctColor = $pct >= 70 ? '#166534'  : ($pct >= 30 ? '#9a3412'    : '#991b1b');
                $rCls     = $loop->index % 2 === 0 ? 'odd' : 'even';
            ?>
            <tr class="<?php echo e($rCls); ?>">
                <td class="disc-name"><?php echo e($disc); ?></td>
                <td style="text-align:center;font-weight:bold;"><?php echo e($s['total']); ?></td>
                <td style="text-align:center;color:#166534;font-weight:bold;"><?php echo e($s['fermer']); ?></td>
                <td style="text-align:center;color:#991b1b;"><?php echo e($s['ouvert']); ?></td>
                <td style="text-align:center;color:#9a3412;"><?php echo e($s['en_cours']); ?></td>
                <td style="text-align:center;font-weight:bold;font-size:9pt;"><?php echo e($pct); ?>%</td>
                <td>
                    <div class="bar-wrap">
                        <div class="bar-fill <?php echo e($barCls); ?>" style="width:<?php echo e($pct); ?>%;"></div>
                    </div>
                    <span class="pct-inline" style="color:<?php echo e($pctColor); ?>;">
                        <?php echo e($s['fermer']); ?>/<?php echo e($s['total']); ?>

                    </span>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>

</div>


<div class="footer">
    PlanEx &bull; Rapport généré le <?php echo e(now()->format('d/m/Y à H:i')); ?>

    <?php if($chantier): ?> &bull; <?php echo e($chantier->nom); ?> — <?php echo e($chantier->localite); ?> <?php endif; ?>
</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\planex\resources\views/pdf/incidents.blade.php ENDPATH**/ ?>