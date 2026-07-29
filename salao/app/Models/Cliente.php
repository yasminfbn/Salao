<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'telefone',
        'email',
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}