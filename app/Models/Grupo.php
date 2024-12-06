<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Grupo extends Model
{
    protected $fillable = [
        'denominacao',
    ];

    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }
    public function projeto(): HasOne
    {
        return $this->hasOne(Projeto::class);
    }
}
