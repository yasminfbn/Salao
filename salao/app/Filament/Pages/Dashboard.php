<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\ProximosAgendamentosWidget;
use App\Filament\Widgets\SalonDashboardWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Painel de Controle';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = '';

    public function getWidgets(): array
    {
        return [
            ProximosAgendamentosWidget::class,
            SalonDashboardWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return [
            'default' => 1,
            'md' => 2,
            'xl' => 2,
        ];
    }
}