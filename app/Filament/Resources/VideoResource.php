<?php

namespace App\Filament\Resources;

use App\Enums\RolesEnum;
use App\Enums\StatusEnum;
use App\Enums\VideoStatusEnum;
use App\Filament\Resources\VideoResource\Pages\CreateVideo;
use App\Filament\Resources\VideoResource\Pages\EditVideo;
use App\Filament\Resources\VideoResource\Pages\ListVideos;
use App\Filament\Resources\VideoResource\Pages\ViewVideo;
use App\Filament\Resources\VideoResource\RelationManagers\LikedRelationManager;
use App\Filament\Resources\VideoResource\RelationManagers\ViewsRelationManager;
use App\Models\Event;
use App\Models\EventSubscription;
use App\Models\User;
use App\Models\Video;
use Closure;
use FFMpeg\FFProbe;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Livewire\TemporaryUploadedFile;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationGroup = 'Video';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('event_id')
                        ->label('Event Name')
                        ->options(self::getEvents(Auth::user()->email))
                        ->autofocus()
                        ->preload()
                        ->reActive()
                        ->required(),
                    TextInput::make('title')
                        ->label('Title')
                        ->autofocus()
                        ->required(),
                    FileUpload::make('thumbnail')
                        ->label('Upload Thumbnail')
                        ->imagePreviewHeight('320')
                        ->image('jpg', 'jpeg')
                        ->disk('events')
                        ->directory(fn (Closure $get) => 'Thumbnail/'.self::getEventName($get('event_id')))
                        ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                            $timestamp = now()->format('Y_m_d_His');
                            $originalName = $file->getClientOriginalName();
                            $fileName = "{$timestamp}_{$originalName}";

                            return $fileName;
                        })
                        ->required(),
                    FileUpload::make('video')
                        ->label('Upload Video')
                        // Save video with timestamp and original name
                        ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                            $timestamp = now()->format('Y_m_d_His');
                            $originalName = $file->getClientOriginalName();
                            $fileName = "{$timestamp}_{$originalName}";

                            return $fileName;
                        })
                        ->acceptedFileTypes(['video/mp4'])
                        ->disk('events')
                        ->helperText('Video must be 480p and less than 20MB')
                        ->maxSize(20480)
                        // Save video in Videos/{event_name}/ directory
                        ->directory(fn (Closure $get) => 'Videos/'.self::getEventName($get('event_id')))
                        // Checking video resolution use ffprobe library
                        // ->rules([
                        //     function () {
                        //         return function (string $attribute, $value, Closure $fail) {
                        //             $ffprobe = FFProbe::create();
                        //             $videoInfo = $ffprobe->streams($value->getRealPath())->videos()->first();
                        //             if ($videoInfo) {
                        //                 $width = $videoInfo->get('width');
                        //                 $height = $videoInfo->get('height');
                        //                 if ($width != 854 || $height != 480) {
                        //                     $fail('Video dimensions must be 854x480. Refer to the pixel conversion tool at https://ffmpeg.org/download.html');
                        //                 }
                        //             }
                        //         };
                        //     },
                        // ])
                        ->required(),
                    Select::make('status')
                        ->options(VideoStatusEnum::class)
                        ->default(VideoStatusEnum::Public)
                        ->disabled(! Auth::user()->hasRole(RolesEnum::SUPER_ADMIN))
                        // Hide status field for super admin
                        // ->hidden(! Auth::user()->hasRole(RolesEnum::SUPER_ADMIN))
                        ->required(),
                    Hidden::make('user_id')
                        ->default(Auth::user()->id),
                ])->columns(2),
            ]);
    }

    // Get event name by event id
    public static function getEventName(?int $event_id): ?string
    {
        return Event::where('id', $event_id)->value('name');
    }

    public static function getEvents(?string $email): array
    {
        $events = [];

        $user = User::where('email', $email)->first();

        if ($user && ! $user->hasRole(RolesEnum::SUPER_ADMIN)) {
            $eventsubscription = EventSubscription::where('user_id', $user->id)->pluck('event_id')->toArray();

            if ($eventsubscription) {
                $events = Event::whereIn('id', $eventsubscription)
                    ->where('status', StatusEnum::Active)
                    ->pluck('name', 'id')
                    ->toArray();
            }
        } else {
            $events = Event::where('status', StatusEnum::Active)
                ->pluck('name', 'id')
                ->toArray();
        }

        return $events;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User Name')
                    ->hidden(! Auth::user()->hasRole(RolesEnum::SUPER_ADMIN))
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('events'),
                TextColumn::make('title')
                    ->searchable()
                    ->limit('30'),
                TextColumn::make('event.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('likes_count')
                    ->label('Likes')
                    ->sortable()
                    ->counts('likes'),
                TextColumn::make('views_count')
                    ->label('Views')
                    ->sortable()
                    ->counts('views'),
                SelectColumn::make('status')
                    ->options(VideoStatusEnum::class)
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Event Name')
                    ->relationship('event', 'name', function ($query) {
                        $query->where('status', StatusEnum::Active);
                    }),
                SelectFilter::make('status')
                    ->options(VideoStatusEnum::class),
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
            LikedRelationManager::class,
            ViewsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVideos::route('/'),
            'create' => CreateVideo::route('/create'),
            'view' => ViewVideo::route('/{record}'),
            'edit' => EditVideo::route('/{record}/edit'),
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
