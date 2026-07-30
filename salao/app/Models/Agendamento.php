<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Agendamento extends Model
{
    protected $fillable = [
        'codigo',
        'cliente_id',
        'data',
        'hora',
        'observacao',
        'servico'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    protected static function booted()
    {
        static::creating(function ($agendamento) {

            $agendamento->codigo =
                'COD-' . strtoupper(substr(md5(uniqid()), 0, 8));

        });
    }
}