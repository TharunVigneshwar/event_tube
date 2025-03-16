<?php

namespace App\Imports;

use App\Models\Event;
use App\Models\EventSubscription;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;

class EventSubscriptionImport implements ToModel
{
    private $rowNumber = 0;

    public function model(array $row)
    {
        $this->rowNumber++;

        if (empty($row[0]) && empty($row[1])) {
            return null;
        } elseif (empty($row[1])) {
            echo 'Error: Row 2 is empty.';
        }

        $useremail = strtolower(trim($row[0]));
        $user_id = User::where('email', $useremail)->value('id');

        if ($user_id == null) {
            throw new \Exception('User email '.$useremail.' not found in row '.$this->rowNumber);
        }

        $eventName = strtoupper(trim($row[1]));
        $event = Event::where('name', $eventName)->first();

        if (! $event) {
            throw new \Exception('Event name '.$eventName.' not found in row '.$this->rowNumber);
        }

        if ($event->status !== 'Active') {
            throw new \Exception('Event '.$eventName.' is inactive in row '.$this->rowNumber);
        }

        $existingSubscription = EventSubscription::where('user_id', $user_id)
            ->where('event_id', $event->id)
            ->first();

        if ($existingSubscription) {
            throw new \Exception('User '.$useremail.' and Event '.$eventName.' already exists in row '.$this->rowNumber);
        }

        return EventSubscription::create([
            'user_id' => $user_id,
            'event_id' => $event->id,
        ]);
    }

    public function onRow(Row $row)
    {
        $this->rowNumber = $row->getIndex();
    }
}
