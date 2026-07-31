<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria o usuário de teste padrão do Laravel
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'), // Altere 'password' para a senha que você preferir
        ]);

        // Chama os seeders do sistema do salão
        $this->call([
            SalaoSeeder::class,
            ClienteSeeder::class,
            AgendamentoSeeder::class
        ]);
    }
}