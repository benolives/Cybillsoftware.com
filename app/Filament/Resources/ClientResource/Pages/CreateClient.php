<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Filament\Actions;
use App\Filament\Resources\ClientResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Client Created';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Client created.')
            ->body('Client created successfully.');
    }
}