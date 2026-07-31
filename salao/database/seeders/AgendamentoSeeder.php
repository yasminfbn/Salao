<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Servicos;
// Se o seu model de agendamento se chamar Agendamento, ajuste abaixo:
use App\Models\Agendamento; 

class AgendamentoSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::all();
        $servicos = Servicos::all();

        if ($clientes->isEmpty() || $servicos->isEmpty()) {
            return;
        }

        $faker = \Faker\Factory::create('pt_BR');

        for ($i = 0; $i < 15; $i++) {
            $servico = $servicos->random();
            $cliente = $clientes->random();
            
            $dataHora = $faker->dateTimeBetween('-10 days', '+10 days');

            Agendamento::create([
                'codigo' => strtoupper($faker->unique()->bothify('AG-#####')),
                'cliente_id' => $cliente->id,
                'servico' => $servico->nome, // Usa o nome do serviço conforme a migration
                'data' => $dataHora->format('Y-m-d'),
                'hora' => $dataHora->format('H:i:s'),
                'status' => $faker->randomElement(['pendente', 'confirmado', 'concluido', 'cancelado']),
                'observacao' => $faker->optional()->sentence(),
            ]);
        }
    }
}