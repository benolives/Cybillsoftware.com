<?php

namespace App\Filament\Resources\ProductKeysResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProductKeysResource;

class CreateProductKeys extends CreateRecord
{
    protected static string $resource = ProductKeysResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Key Added';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Key Added.')
            ->body('Key Added successfully.');
    }
}
