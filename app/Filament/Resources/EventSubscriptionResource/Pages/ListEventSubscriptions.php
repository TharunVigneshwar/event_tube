<?php

namespace App\Filament\Resources\EventSubscriptionResource\Pages;

use App\Filament\Resources\EventSubscriptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventSubscriptions extends ListRecords
{
    protected static string $resource = EventSubscriptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('Import')
                ->url(static::$resource::getUrl('import')),
            Actions\CreateAction::make(),
        ];
    }
}
