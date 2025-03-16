<?php

namespace App\Filament\Resources\EventSubscriptionResource\Pages;

use App\Filament\Resources\EventSubscriptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEventSubscription extends CreateRecord
{
    protected static string $resource = EventSubscriptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
