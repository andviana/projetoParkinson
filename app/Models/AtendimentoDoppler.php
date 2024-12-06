<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AtendimentoDoppler extends Model
{
    protected $fillable = [
        'p1_d_indice_pulsatilidade',
        'p1_d_velocidade_media',
        'p1_d_pico_cistolico',
        'p1_d_pico_diastolico',
        'p1_e_indice_pulsatilidade',
        'p1_e_velocidade_media',
        'p1_e_pico_cistolico',
        'p1_e_pico_diastolico',
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
