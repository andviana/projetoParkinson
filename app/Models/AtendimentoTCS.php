<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AtendimentoTCS extends Model
{
    protected $fillable = [
        'janela_temporal_d',
        'janela_temporal_e',
        'observacao_mesoencefalo',
        'area_total_mesoencefalo',
        'hiperecogenecidade_d',
        'hiperecogenecidade_d_area',
        'hiperecogenecidade_e',
        'hiperecogenecidade_e_area',
    ];

    public function profissional(): HasOne
    {
        return $this->hasOne(Profissional::class);
    }
    public function atendimento(): HasOne
    {
        return $this->hasOne(Atendimento::class);
    }
}
