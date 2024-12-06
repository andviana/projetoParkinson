<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Paciente extends Model
{
    protected $fillable = [
        'ativo',
        'dataVinculo',
        'dataDesligamento'
    ];
    protected $dates = ['dataVinculo, dataDesligamento'];


    public function atendimentos(): HasMany
    {
        return $this->hasMany(Atendimento::class);
    }
    public function pessoa(): HasOne
    {
        return $this->hasOne(Pessoa::class);
    }
    public function grupo(): HasOne
    {
        return $this->hasOne(Grupo::class);
    }
    public function condicao(): HasOne
    {
        return $this->hasOne(Condicao::class);
    }
}
