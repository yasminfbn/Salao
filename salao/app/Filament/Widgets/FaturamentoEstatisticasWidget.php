<?php

namespace App\Filament\Widgets;

use App\Models\Agendamento;
use App\Models\Cliente;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class FaturamentoEstatisticasWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $mesAtual = Carbon::now()->month;
        $anoAtual = Carbon::now()->year;

        // 1. Faturamento Estimado do Mês (Soma o preço dos serviços concluídos no mês atual)
        // Nota: Certifique-se de que sua tabela de serviços tem o campo 'preco' ou 'valor'
        $faturamentoMes = Agendamento::whereMonth('data', $mesAtual)
            ->whereYear('data', $anoAtual)
            ->where('status', 'concluido')
            ->get()
            ->sum(function ($agendamento) {
                return $agendamento->servicoRelacao->preco ?? 0; // Pega o preço do serviço relacionado
            });

        // 2. Total de Atendimentos Realizados no Mês
        $totalAtendimentos = Agendamento::whereMonth('data', $mesAtual)
            ->whereYear('data', $anoAtual)
            ->where('status', 'concluido')
            ->count();

        // 3. Clientes Novos cadastrados nos últimos 30 dias
        $clientesNovos = Cliente::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // 4. Taxa de Conclusão (Concluídos vs Cancelados do mês)
        $concluidos = Agendamento::whereMonth('data', $mesAtual)->where('status', 'concluido')->count();
        $cancelados = Agendamento::whereMonth('data', $mesAtual)->where('status', 'cancelado')->count();
        $totalGeralMes = $concluidos + $cancelados;
        
        $taxaConclusao = $totalGeralMes > 0 ? round(($concluidos / $totalGeralMes) * 100, 1) : 0;

        return [
            Stat::make('Faturamento do Mês', 'R$ ' . number_format($faturamentoMes, 2, ',', '.'))
                ->description('Baseado nos serviços concluídos')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Atendimentos Concluídos', $totalAtendimentos)
                ->description('Neste mês atual')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),

            Stat::make('Novos Clientes', $clientesNovos)
                ->description('Cadastrados nos últimos 30 dias')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('primary'),

            Stat::make('Taxa de Conclusão', $taxaConclusao . '%')
                ->description("Concluídos vs Cancelados")
                ->descriptionIcon('heroicon-m-chart-pie')
                ->color($taxaConclusao >= 70 ? 'success' : 'warning'),
        ];
    }
}