<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'dataNascimento',
        'genero',
    ];
    protected $dates = ['dataNascimento'];
    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function profissional(): BelongsTo
    {
        return $this->BelongsTo(Profissional::class);
    }

}
