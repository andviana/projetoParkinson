<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projeto extends Model
{
    protected $fillable = [
        'denominacao',
    ];

    public function grupos(): HasMany
    {
        return $this->hasMany(Grupo::class);
    }
}
