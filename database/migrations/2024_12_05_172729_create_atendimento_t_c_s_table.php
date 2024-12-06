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
        Schema::create('atendimento_t_c_s', function (Blueprint $table) {
            $table->id();
            $table->boolean('janela_temporal_d');
            $table->boolean('janela_temporal_e');
            $table->integer('obervacao_mesoencefalo');
            $table->decimal('area_total_mesoencefalo');
            $table->boolean('hiperecogenecidade_d');
            $table->boolean('hiperecogenecidade_d_area');
            $table->boolean('hiperecogenecidade_e');
            $table->boolean('hiperecogenecidade_e_area');
            $table->timestamps();
            $table->foreignId('atendimentos_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('profissionals_id')->constrained()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimento_t_c_s');
    }
};
