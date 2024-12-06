<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoAtendimento extends Model
{
    protected $fillable = [
        'denominacao',
        ];

    public function atendimentos(): HasMany
    {
        return $this->hasMany(Atendimento::class);
    }
}
