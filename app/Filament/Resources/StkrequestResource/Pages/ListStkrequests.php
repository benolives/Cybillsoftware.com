<?php

namespace App\Filament\Resources\StkrequestResource\Pages;

use App\Filament\Resources\StkrequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStkrequests extends ListRecords
{
    protected static string $resource = StkrequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
