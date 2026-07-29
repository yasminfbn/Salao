<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servicos_agendados', function (Blueprint $table) {
            $table->id();

            $table->string('codigo');

            $table->foreign('codigo')
                ->references('codigo')
                ->on('agendamentos')
                ->cascadeOnDelete();

            $table->string('servico');

            $table->foreign('servico')
                ->references('nome')
                ->on('servicos')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos_agendados');
    }
};