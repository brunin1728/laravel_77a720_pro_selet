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
        Schema::create('pacientes_endereco', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_paciente')->unsigned();
            $table->foreign('id_paciente')->references('id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('cep', 50);
            $table->string('endereco', 300);
            $table->string('numero', 20);
            $table->string('complemento', 200);
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->string('estado', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes_endereco');
    }
};
