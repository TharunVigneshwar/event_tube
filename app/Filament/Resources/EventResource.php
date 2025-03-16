<?php

namespace App\Filament\Resources;

use App\Enums\RolesEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers\VideosRelationManager;
use App\Models\Event;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationGroup = 'Event';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Event Name')
                        ->unique(ignoreRecord: true)
                        ->required(),
                    DateTimePicker::make('start_date')
                        ->label('Start Time')
                        ->minDate(today())
                        ->required(),
                    Select::make('status')
                        ->options(StatusEnum::class)
                        ->default(StatusEnum::Active)
                        ->required(),
                    DateTimePicker::make('end_date')
                        ->label('End Time')
                        ->after('start_date')
                        ->minDate(today())
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Start Time')
                    ->datetime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('End Time')
                    ->datetime()
                    ->sortable(),
                SelectColumn::make('status')
                    ->options(StatusEnum::class)
                    ->disabled(! Auth::user()->hasRole(RolesEnum::SUPER_ADMIN))
                    ->searchable(),
                // ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(StatusEnum::class),

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
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            VideosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
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
