<?php

namespace App\Filament\Resources\ServicosResource\Pages;

use App\Filament\Resources\ServicosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServicos extends EditRecord
{
    protected static string $resource = ServicosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
