<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class VideoPlayer extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.video-player';

    protected static ?string $title = '';

    protected static ?string $slug = 'video-player/{slug}';

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
