<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chantier_disciplines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->string('discipline');           // clé : vrd, genie_civil, ...
            $table->string('entreprise')->nullable(); // nom de l'entreprise en charge
            $table->timestamps();

            $table->foreign('chantier_id')->references('id')->on('chantiers')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chantier_disciplines');
    }
};
