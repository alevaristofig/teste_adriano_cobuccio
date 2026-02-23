<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operacao extends Model
{
    protected $table = 'operacao';

    protected $fillable = [
        'carteira_id', 'descricao', 'status', 'valor', 'created_at'
    ];

    public function carteira(): BelongsTo {
        return $this->belongsTo(Carteira::class);
    }
}
