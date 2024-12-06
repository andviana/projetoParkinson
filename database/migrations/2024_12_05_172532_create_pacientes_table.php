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
            $table->date('dataDesligamento');
            $table->timestamps();
            $table->foreignId('pessoas_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('grupos_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('condicaos_id')->constrained()->cascadeOnUpdate();
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
