<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\DB;

trait HasReference
{
    /**
     * Génère la prochaine référence pour une année donnée.
     * Format : ANO-YYYY-NNNN  (ex: ANO-2026-0001)
     */
    public static function generateReference(?int $year = null): string
    {
        $year  = $year ?? now()->year;
        $table = (new static)->getTable();
        $pk    = (new static)->getKeyName();

        // Compte les incidents existants pour cette année (hors soft-deletes éventuels)
        $count = DB::table($table)
            ->whereYear('date_emis', $year)
            ->whereNotNull('reference')
            ->count();

        return sprintf('ANO-%d-%04d', $year, $count + 1);
    }

    /**
     * Renumérotation dense après suppression :
     * repart de ANO-YYYY-0001 et réattribue dans l'ordre de création.
     */
    public static function renumberYear(int $year): void
    {
        $table = (new static)->getTable();
        $pk    = (new static)->getKeyName();

        $rows = DB::table($table)
            ->whereYear('date_emis', $year)
            ->orderBy($pk)
            ->get([$pk]);

        foreach ($rows as $index => $row) {
            DB::table($table)
                ->where($pk, $row->$pk)
                ->update(['reference' => sprintf('ANO-%d-%04d', $year, $index + 1)]);
        }
    }

    /**
     * Renumérotation de toutes les années présentes en base.
     */
    public static function renumberAll(): void
    {
        $table = (new static)->getTable();

        $years = DB::table($table)
            ->selectRaw('YEAR(date_emis) as year')
            ->whereNotNull('date_emis')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('year');

        // Incidents sans date_emis → année courante
        foreach ($years as $year) {
            static::renumberYear((int) $year);
        }

        // Incidents sans date_emis : référence provisoire
        $pk = (new static)->getKeyName();
        DB::table($table)
            ->whereNull('date_emis')
            ->whereNull('reference')
            ->orderBy($pk)
            ->each(function ($row) use ($table, $pk) {
                DB::table($table)
                    ->where($pk, $row->$pk)
                    ->update(['reference' => sprintf('ANO-%d-%04d', now()->year, $row->$pk)]);
            });
    }
}
