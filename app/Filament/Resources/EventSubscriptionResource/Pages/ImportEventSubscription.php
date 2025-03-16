<?php

namespace App\Filament\Resources\EventSubscriptionResource\Pages;

use App\Filament\Resources\EventSubscriptionResource;
use App\Imports\EventSubscriptionImport;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\Page;
use Maatwebsite\Excel\Facades\Excel;

class ImportEventSubscription extends Page
{
    protected static string $resource = EventSubscriptionResource::class;

    protected static string $view = 'filament.resources.event-subscription-resource.pages.import-event-subscription';

    public $eventSubscription;

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('eventSubscription')
                ->acceptedFileTypes(['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ->required()
                ->label('Upload File')
                ->reactive(),
        ];

    }

    public function import()
    {
        if (is_null($this->eventSubscription)) {
            return $this->notify('danger', 'Please select a file');
        }

        foreach ($this->eventSubscription as $event) {
            $file = $event->store('csv', 'local');
        }

        try {
            Excel::import(new EventSubscriptionImport(), $file);
            $this->notify('success', 'Imported Successfully');
        } catch (\Exception $exception) {
            $this->notify('danger', $exception->getMessage());
        }

        return redirect(url(static::$resource::getUrl('index')));
    }
}
