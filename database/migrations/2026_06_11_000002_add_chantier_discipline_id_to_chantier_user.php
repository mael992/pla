<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chantier_user', function (Blueprint $table) {
            $table->unsignedBigInteger('chantier_discipline_id')->nullable()->after('role_chantier');
            $table->foreign('chantier_discipline_id')
                  ->references('id')->on('chantier_disciplines')
                  ->nullOnDelete();
        });

        // ── Migration auto des membres existants ──────────────────
        // Pour chaque (chantier, discipline) des membres non-chef, on crée
        // un couple discipline/entreprise (entreprise vide à compléter) et
        // on rattache les membres concernés à ce couple.
        $members = DB::table('chantier_user')
            ->where('is_creator', false)
            ->where('role_chantier', '!=', 'chef_chantier')
            ->get();

        $coupleByKey = []; // "chantier_id|discipline" => chantier_discipline_id

        foreach ($members as $m) {
            if (empty($m->role_chantier)) {
                continue;
            }
            $key = $m->chantier_id . '|' . $m->role_chantier;

            if (!isset($coupleByKey[$key])) {
                $coupleByKey[$key] = DB::table('chantier_disciplines')->insertGetId([
                    'chantier_id' => $m->chantier_id,
                    'discipline'  => $m->role_chantier,
                    'entreprise'  => null,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }

            DB::table('chantier_user')
                ->where('id', $m->id)
                ->update(['chantier_discipline_id' => $coupleByKey[$key]]);
        }
    }

    public function down(): void
    {
        Schema::table('chantier_user', function (Blueprint $table) {
            $table->dropForeign(['chantier_discipline_id']);
            $table->dropColumn('chantier_discipline_id');
        });
    }
};
