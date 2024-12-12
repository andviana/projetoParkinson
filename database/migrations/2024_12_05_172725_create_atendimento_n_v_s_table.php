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
        Schema::create('atendimento_n_v_s', function (Blueprint $table) {
            $table->id();
            $table->decimal('area_secao_transversal_d');
            $table->decimal('area_secao_transversal_e');
            $table->timestamps();
            $table->foreignId('atendimento_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('profissional_id')->constrained()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimento_n_v_s');
    }
};
