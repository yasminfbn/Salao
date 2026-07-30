<?php

namespace App\Filament\Widgets;

use App\Models\Agendamento;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProximosAgendamentosWidget extends BaseWidget
{
    protected static ?string $heading = 'Próximos Agendamentos';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Agendamento::query()->latest()->limit(5)
            )
            ->columns([
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
            ])
            ->paginated(false);
    }
}