<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'nome' => 'Ana Souza',
            'telefone' => '(24) 99999-1111',
            'email' => 'ana@email.com',
            'pontos' => 450, // Ouro
        ]);

        Cliente::create([
            'nome' => 'Mariana Lima',
            'telefone' => '(24) 99999-2222',
            'email' => 'mariana@email.com',
            'pontos' => 120, // Prata
        ]);

        Cliente::create([
            'nome' => 'Yasmin',
            'telefone' => '(24) 99999-2223',
            'email' => 'yasmin@email.com',
            'pontos' => 580, // VIP
        ]);

        Cliente::create([
            'nome' => 'Isabelle',
            'telefone' => '(24) 99999-2221',
            'email' => 'isa@email.com',
            'pontos' => 50, // Bronze
        ]);

        Cliente::create([
            'nome' => 'Thais',
            'telefone' => '(24) 99999-2212',
            'email' => 'thias@email.com',
            'pontos' => 320, // Ouro
        ]);

        Cliente::create([
            'nome' => 'Rayane',
            'telefone' => '(24) 99899-2222',
            'email' => 'rayane@email.com',
            'pontos' => 210, // Prata
        ]);

        Cliente::create([
            'nome' => 'Gisseli',
            'telefone' => '(24) 99799-2222',
            'email' => 'gisseli@email.com',
            'pontos' => 600, // VIP
        ]);

        Cliente::create([
            'nome' => 'Nicolly',
            'telefone' => '(24) 99949-2222',
            'email' => 'nicolly@email.com',
            'pontos' => 80, // Bronze
        ]);

        Cliente::create([
            'nome' => 'Maria',
            'telefone' => '(24) 99999-4222',
            'email' => 'maria@email.com',
            'pontos' => 350, // Ouro
        ]);

        Cliente::create([
            'nome' => 'Sophia',
            'telefone' => '(24) 99789-4222',
            'email' => 'sophia@email.com',
            'pontos' => 150, // Prata
        ]);

        Cliente::create([
            'nome' => 'Beatriz',
            'telefone' => '(24) 99699-4222',
            'email' => 'bia@email.com',
            'pontos' => 510, // VIP
        ]);

        Cliente::create([
            'nome' => 'Ana Luiza',
            'telefone' => '(24) 99695-4222',
            'email' => 'analuiza@email.com', // Ajustado para evitar e-mail duplicado da Ana Souza
            'pontos' => 20, // Bronze
        ]);
    }
}