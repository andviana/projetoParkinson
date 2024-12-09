<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profissional extends Model
{
    use HasFactory;

    protected $fillable = [
        'denominacao',
        'registro',
        'especialidade',
        'pessoa_id'
    ];


    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
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
