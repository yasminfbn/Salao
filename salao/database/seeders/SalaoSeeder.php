<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Servicos;

class SalaoSeeder extends Seeder
{
    public function run(): void
    {
        // Criar Serviços Padrão do Salão com duração em minutos
        $servicos = [
            ['nome' => 'Corte Feminino', 'preco' => 70.00, 'duracao' => 45],
            ['nome' => 'Hidratação Capilar', 'preco' => 90.00, 'duracao' => 60],
            ['nome' => 'Escova Modelada', 'preco' => 50.00, 'duracao' => 30],
            ['nome' => 'Manicure e Pedicure', 'preco' => 60.00, 'duracao' => 60],
            ['nome' => 'Design de Sobrancelha', 'preco' => 40.00, 'duracao' => 20],
            ['nome' => 'Coloração', 'preco' => 150.00, 'duracao' => 120],
        ];

        foreach ($servicos as $servico) {
            Servicos::firstOrCreate(['nome' => $servico['nome']], $servico);
        }

        // Criar 10 Clientes Fictícios Usando o Faker
        $faker = \Faker\Factory::create('pt_BR');

        for ($i = 1; $i <= 10; $i++) {
            Cliente::create([
                'nome' => $faker->name(),
                'telefone' => $faker->cellphoneNumber(),
                'email' => $faker->unique()->safeEmail(),
            ]);
        }
    }
}