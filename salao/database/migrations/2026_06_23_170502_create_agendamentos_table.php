<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique();

            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->cascadeOnDelete();

            $table->date('data');
            $table->time('hora');

            $table->text('observacao')->nullable();

            $table->string('servico');

            $table->foreign('servico')
                ->references('nome')
                ->on('servicos')
                ->cascadeOnDelete();

            $table->string('status')->default('pendente'); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};