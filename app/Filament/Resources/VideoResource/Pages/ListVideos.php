<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Enums\RolesEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\VideoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListVideos extends ListRecords
{
    protected static string $resource = VideoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // protected function getTableQuery(): Builder
    // {
    //     /**
    //      * @var \App\Models\User $user
    //      */
    //     $user = Auth::user();

    //     if ($user->hasRole('student')) {
    //         return parent::getTableQuery()->where('user_id', $user->id);
    //     }

    //     return parent::getTableQuery();

    // }
    protected function getTableQuery(): Builder
    {
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();

        if ($user->hasRole(RolesEnum::STUDENT)) {
            return parent::getTableQuery()->where('user_id', $user->id);
        }

        if ($user->hasRole(RolesEnum::STUDENT)) {
            return parent::getTableQuery()
                ->whereHas('event', function ($query) {
                    $query->where('status', StatusEnum::Active);
                });
        }

        return parent::getTableQuery()->whereHas('event', function ($query) {
            $query->where('status', StatusEnum::Active);
        });
    }
}
