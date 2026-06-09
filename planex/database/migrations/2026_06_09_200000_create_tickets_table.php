<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('token', 32)->unique();
            $table->string('numero')->unique();
            $table->string('email');
            $table->string('question_1');
            $table->string('question_2');
            $table->enum('statut', ['ouvert', 'cloture', 'reouverture_demandee'])->default('ouvert');
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('delete_at')->nullable();
            $table->boolean('no_char_limit_next')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
