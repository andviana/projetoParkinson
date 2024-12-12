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
        Schema::create('atendimento_dopplers', function (Blueprint $table) {
            $table->id();
            $table->decimal('p1_d_indice_pulsatilidade');
            $table->decimal('p1_d_velocidade_media');
            $table->decimal('p1_d_pico_cistolico');
            $table->decimal('p1_d_pico_distolico');
            $table->decimal('p1_e_indice_pulsatilidade');
            $table->decimal('p1_e_velocidade_media');
            $table->decimal('p1_e_pico_cistolico');
            $table->decimal('p1_e_pico_distolico');
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
        Schema::dropIfExists('atendimento_dopplers');
    }
};
