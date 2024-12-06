<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condicao extends Model
{
    protected $fillable = [
        'denominacao',
    ];

    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }
}
