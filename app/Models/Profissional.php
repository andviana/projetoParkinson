<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profissional extends Model
{
    protected $fillable = [
        'denominacao',
        'registro'
    ];

    public function pessoa(): HasOne
    {
        return $this->hasOne(Pessoa::class);
    }
    public function atendimentoDopplers(): HasMany
    {
        return $this->hasMany(AtendimentoDoppler::class);
    }
    public function atendimentoNVs(): HasMany
    {
        return $this->hasMany(AtendimentoNV::class);
    }
    public function atendimentoTCSs(): HasMany
    {
        return $this->hasMany(AtendimentoTCS::class);
    }
}
