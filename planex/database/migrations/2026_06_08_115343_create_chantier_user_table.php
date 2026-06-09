<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chantier_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedInteger('user_id');
            $table->string('role_chantier')->default('vrd');
            $table->boolean('is_creator')->default(false);
            $table->timestamps();
            $table->unique(['chantier_id', 'user_id']);
            $table->foreign('chantier_id')->references('id')->on('chantiers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chantier_user');
    }
};
