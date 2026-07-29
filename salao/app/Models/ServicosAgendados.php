<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Agendamento;

class ServicosAgendados extends Model
{
    protected $fillable = [
        'cliente_id',
        'codigo',
        'servico',
    ];

    public function servico()
    {
        return $this->belongsTo(Servicos::class);
    }

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }
}