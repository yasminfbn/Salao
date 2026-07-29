<?php

namespace App\Filament\Resources\ServicosAgendadosResource\Pages;

use App\Filament\Resources\ServicosAgendadosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServicosAgendados extends ListRecords
{
    protected static string $resource = ServicosAgendadosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
