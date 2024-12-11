<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'denominacao',
        'projeto_id'
    ];

    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }
    public function projeto(): BelongsTo
    {
        return $this->BelongsTo(Projeto::class);
    }
}
