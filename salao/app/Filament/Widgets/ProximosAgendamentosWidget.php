<?php

namespace App\Filament\Widgets;

use App\Models\Agendamento;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProximosAgendamentosWidget extends BaseWidget
{
    protected static ?string $heading = 'Próximos Agendamentos';

    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Ordena pelos agendamentos mais próximos de hoje em diante
                Agendamento::query()
                    ->where('data', '>=', now()->toDateString())
                    ->orderBy('data', 'asc')
                    ->orderBy('hora', 'asc')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('data')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('hora')
                    ->label('Horário')
                    ->time('H:i')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable(),

                Tables\Columns\TextColumn::make('servico')
                    ->label('Serviço'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pendente',
                        'success' => 'confirmado',
                        'primary' => 'concluido',
                        'danger' => 'cancelado',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
            ])
            ->paginated(false);
    }
}