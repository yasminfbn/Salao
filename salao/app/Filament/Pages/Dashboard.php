<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Painel de Controle';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = '';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\ProximosAgendamentosWidget::class,
            \App\Filament\Widgets\SalonDashboardWidget::class,
        ];
    }

    // Força o grid do dashboard a usar 2 colunas perfeitamente
    public function getColumns(): int | string | array
    {
        return 2;
    }
}