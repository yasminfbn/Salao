<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'pontos',
    ];

    // Define o nível de fidelidade de forma compatível com o Filament
    protected function nivelFidelidade(): Attribute
    {
        return Attribute::make(
            get: function () {
                $pontos = $this->pontos ?? 0;

                if ($pontos >= 500) {
                    return ['nome' => 'VIP', 'color' => 'danger', 'icon' => 'heroicon-m-sparkles'];
                } elseif ($pontos >= 301) {
                    return ['nome' => 'Ouro', 'color' => 'warning', 'icon' => 'heroicon-m-star'];
                } elseif ($pontos >= 101) {
                    return ['nome' => 'Prata', 'color' => 'gray', 'icon' => 'heroicon-m-shield-check'];
                } else {
                    return ['nome' => 'Bronze', 'color' => 'info', 'icon' => 'heroicon-m-user'];
                }
            }
        );
    }
}