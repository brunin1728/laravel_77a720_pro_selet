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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('foto', 250)->nullable();
            $table->string('nome_completo', 150);
            $table->string('nome_mae', 150);
            $table->string('data_nascimento', 50);
            $table->string('cpf', 50);
            $table->string('cns', 50);
            $table->string('codigo_aleatorio', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
