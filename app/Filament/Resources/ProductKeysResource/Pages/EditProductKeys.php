<?php

namespace App\Filament\Resources\ProductKeysResource\Pages;

use App\Filament\Resources\ProductKeysResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductKeys extends EditRecord
{
    protected static string $resource = ProductKeysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
