<?php

namespace App\Filament\Resources\ServicosAgendadosResource\Pages;

use App\Filament\Resources\ServicosAgendadosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServicosAgendados extends EditRecord
{
    protected static string $resource = ServicosAgendadosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
