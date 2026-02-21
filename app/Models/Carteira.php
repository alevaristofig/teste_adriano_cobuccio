<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carteira extends Model
{
    protected $fillable = [
        'numero', 'valor', 'status', 'created_at'
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
