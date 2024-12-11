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
            $table->boolean('ativo');
            $table->date('dataVinculo');
            $table->date('dataDesligamento')->nullable();
            $table->timestamps();
            $table->foreignId('grupo_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('pessoa_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('condicao_id')->constrained()->cascadeOnUpdate();
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
