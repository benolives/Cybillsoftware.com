<?php

namespace App\Filament\Resources\StkrequestResource\Pages;

use App\Filament\Resources\StkrequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStkrequest extends EditRecord
{
    protected static string $resource = StkrequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
