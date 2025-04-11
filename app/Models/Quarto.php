<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    //
    protected $fillable = [
        'numero',
        'andar',
        'tipo_quarto_id',
        'status',
        'preco_noite',
        'descricao',
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoQuarto::class, 'tipo_quarto_id');
    }
}
