<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AtendimentoNV extends Model
{
    protected $fillable = [
        'area_secao_transversal_d',
        'area_secao_transversal_e',
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
