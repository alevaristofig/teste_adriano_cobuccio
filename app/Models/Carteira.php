<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carteira extends Model
{
    protected $fillable = [
        'id', 'user_id', 'numero', 'titular', 'saldo', 'valorNegativo', 'created_at'
    ];

    public function users(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function operacoes(): HasMany
    {
        return $this->hasMany(Operacao::class);
    }
}
