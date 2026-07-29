<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicosAgendadosResource\Pages;
use App\Models\Agendamento;
use App\Models\ServicosAgendados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServicosAgendadosResource extends Resource
{
    protected static ?string $model = ServicosAgendados::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    protected static ?string $navigationLabel = 'Serviços Agendados';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('codigo')
                    ->label('Agendamento')
                    ->options(
                        Agendamento::pluck('codigo', 'codigo')
                    )
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('servico_id')
                    ->label('Serviço')
                    ->relationship('servico', 'nome')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->label('Código do Agendamento')
                    ->searchable(),

                Tables\Columns\TextColumn::make('agendamento.cliente.nome')
                    ->label('Cliente')
                    ->searchable(),

                Tables\Columns\TextColumn::make('servico.nome')
                    ->label('Serviço')
                    ->searchable(),

                Tables\Columns\TextColumn::make('servico.preco')
                    ->label('Preço')
                    ->money('BRL'),

                Tables\Columns\TextColumn::make('servico.duracao')
                    ->label('Duração')
                    ->suffix(' min'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicosAgendados::route('/'),
            'create' => Pages\CreateServicosAgendados::route('/create'),
            'edit' => Pages\EditServicosAgendados::route('/{record}/edit'),
        ];
    }
}