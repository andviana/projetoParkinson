<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Atendimento extends Model
{
    protected $fillable = [
        'dataAtendimento',
        'dataCadastro',
        ];

    protected $dates = ['dataAtendimento, dataCadastro'];

    public function atendimentoDoppler(): HasOne
    {
        return $this->hasOne(AtendimentoDoppler::class);
    }
    public function atendimentoNV(): HasOne
    {
        return $this->hasOne(AtendimentoNV::class);
    }
    public function atendimentoTCS(): HasOne
    {
        return $this->hasOne(AtendimentoTCS::class);
    }
    public function paciente(): HasOne
    {
        return $this->hasOne(Paciente::class);
    }
    public function tipoAtendimento(): HasOne
    {
        return $this->hasOne(TipoAtendimento::class);
    }

    public function profissional(): HasOne
    {
        return $this->hasOne(Profissional::class);
    }
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
