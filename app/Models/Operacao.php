<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{
    protected $fillable = [
        'carteira_id', 'descricao', 'status', 'valor', 'created_at'
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(Carteira::class);
    }
}
