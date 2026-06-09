<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mot de passe provisoire en clair (pour le PDF courrier), effacé lors du 1er changement
            $table->string('temp_password')->nullable()->after('password');
            // Forcer le changement de mdp à la première connexion
            $table->boolean('must_change_password')->default(false)->after('temp_password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['temp_password', 'must_change_password']);
        });
    }
};
