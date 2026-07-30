<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicosResource\Pages;
use App\Models\Servicos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServicosResource extends Resource
{
    protected static ?string $model = Servicos::class;
    
    protected static ?string $navigationGroup = 'Cadastros';
    
    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $navigationLabel = 'Serviços';

    protected static ?string $modelLabel = 'Serviço';

    protected static ?string $pluralModelLabel = 'Serviços';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações do Serviço')
                    ->description('Cadastre os detalhes, preço e tempo de duração do procedimento.')
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->label('Nome do Serviço')
                            ->required()
                            ->maxLength(255)
                            ->autofocus()
                            ->columnSpan(['default' => 12, 'md' => 8]),

                        Forms\Components\Toggle::make('ativo')
                            ->label('Serviço Ativo')
                            ->default(true)
                            ->inline(false)
                            ->columnSpan(['default' => 12, 'md' => 4]),

                        Forms\Components\TextInput::make('preco')
                            ->label('Preço')
                            ->numeric()
                            ->prefix('R$')
                            ->required()
                            ->columnSpan(['default' => 12, 'md' => 6]),

                        Forms\Components\TextInput::make('duracao')
                            ->label('Duração (minutos)')
                            ->numeric()
                            ->suffix('min')
                            ->required()
                            ->columnSpan(['default' => 12, 'md' => 6]),

                        Forms\Components\Textarea::make('descricao')
                            ->label('Descrição')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(12),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Serviço')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('preco')
                    ->label('Preço')
                    ->money('BRL')
                    ->sortable()
                    ->color('success'),

                Tables\Columns\TextColumn::make('duracao')
                    ->label('Duração')
                    ->suffix(' min')
                    ->sortable(),

                Tables\Columns\IconColumn::make('ativo')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('nome')
            ->filters([
                Tables\Filters\TernaryFilter::make('ativo')
                    ->label('Status do Serviço')
                    ->boolean()
                    ->trueLabel('Apenas Ativos')
                    ->falseLabel('Apenas Inativos')
                    ->native(false),
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
            'index' => Pages\ListServicos::route('/'),
            'create' => Pages\CreateServicos::route('/create'),
            'edit' => Pages\EditServicos::route('/{record}/edit'),
        ];
    }
}