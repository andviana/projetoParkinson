<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'ativo',
        'dataVinculo',
        'dataDesligamento',
        'grupo_id',
        'pessoa_id',
        'condicao_id',
    ];
    protected $dates = ['dataVinculo, dataDesligamento'];


    public function pessoa(): BelongsTo
    {
        return $this->BelongsTo(Pessoa::class);
    }
    public function grupo(): BelongsTo
    {
        return $this->BelongsTo(Grupo::class);
    }
    public function condicao(): BelongsTo
    {
        return $this->BelongsTo(Condicao::class);
    }
    public function atendimentos(): HasMany
    {
        return $this->hasMany(Atendimento::class);
    }
}
