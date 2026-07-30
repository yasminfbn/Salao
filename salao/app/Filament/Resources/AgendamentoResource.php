<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendamentoResource\Pages;
use App\Models\Agendamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AgendamentoResource extends Resource
{
    protected static ?string $model = Agendamento::class;

    // Grupo no menu lateral
    protected static ?string $navigationGroup = 'Atendimento';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Agendamentos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('cliente_id')
                    ->label('Cliente')
                    ->relationship('cliente', 'nome')
                    ->searchable()
                    ->required(),

                // Select para escolher o serviço baseado na coluna 'nome' da tabela 'servicos'
                Forms\Components\Select::make('servico')
                    ->label('Serviço')
                    ->relationship('servicoRelacao', 'nome') // Certifique-se de que a relação no Model se chama servicoRelacao, ou ajuste para o nome da função correta
                    ->searchable()
                    ->required(),

                Forms\Components\DatePicker::make('data')
                    ->label('Data')
                    ->required(),

                Forms\Components\TimePicker::make('hora')
                    ->label('Hora')
                    ->seconds(false)
                    ->required(),

                Forms\Components\Textarea::make('observacao')
                    ->label('Observação')
                    ->rows(4)
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable(),

                Tables\Columns\TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('servico')
                    ->label('Serviço')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('data')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('hora')
                    ->label('Hora'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendamentos::route('/'),
            'create' => Pages\CreateAgendamento::route('/create'),
            'edit' => Pages\EditAgendamento::route('/{record}/edit'),
        ];
    }
}