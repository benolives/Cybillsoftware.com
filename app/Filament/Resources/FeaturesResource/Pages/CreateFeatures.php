<?php

namespace App\Filament\Resources\FeaturesResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\FeaturesResource;

class CreateFeatures extends CreateRecord
{
    protected static string $resource = FeaturesResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Feature Added';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Feature Added.')
            ->body('Feature Added successfully.');
    }
}
