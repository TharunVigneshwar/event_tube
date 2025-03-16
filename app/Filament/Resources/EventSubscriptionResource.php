<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\EventSubscriptionResource\Pages;
use App\Models\Event;
use App\Models\EventSubscription;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventSubscriptionResource extends Resource
{
    protected static ?string $model = EventSubscription::class;

    protected static ?string $navigationGroup = 'Event';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    // ->relationship('user', 'email').
                    ->options(User::all()->pluck('email', 'id'))
                    ->label('User Email')
                    ->searchable()
                    ->reactive()
                    ->required(),
                Select::make('event_id')
                    ->options(function (callable $get) {
                        $get_user_id = $get('user_id');

                        if (! $get_user_id) {
                            return Event::where('status', 'Active')
                                ->pluck('name', 'id');
                        }

                        $event_ids = EventSubscription::where('user_id', $get_user_id)->pluck('event_id')->toArray();

                        $events = Event::where('status', 'Active')
                            ->whereNotIn('id', $event_ids)
                            ->get(['id', 'name']);

                        $selected_event_id = $get('event_id');

                        if ($selected_event_id) {
                            $event_subscription = EventSubscription::where('user_id', $get_user_id)
                                ->where('event_id', $selected_event_id)
                                ->first();

                            if ($event_subscription) {
                                $events->push($event_subscription->event);
                            }
                        }

                        return $events->pluck('name', 'id');
                    })
                    ->searchable()
                    ->label('Event Name')
                    ->required(),

            ]);
    }

    public static function getEvents(?string $email): array
    {
        $events = Event::where('status', StatusEnum::Active)->pluck('name', 'id')->toArray();

        $eventsubscription = EventSubscription::where('user_id')->pluck('event_id')->toArray();

        if ($eventsubscription) {
            $events = Event::where('status', StatusEnum::Active)
                ->whereNotIn('id', $eventsubscription)
                ->pluck('name', 'id')
                ->toArray();
        }

        return $events;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.email')
                    ->label('User Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('event.name')
                    ->label('Event Name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Event Name')
                    ->relationship('event', 'name', function ($query) {
                        $query->where('status', StatusEnum::Active);
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventSubscriptions::route('/'),
            'create' => Pages\CreateEventSubscription::route('/create'),
            'import' => Pages\ImportEventSubscription::route('/import'),
            'edit' => Pages\EditEventSubscription::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
