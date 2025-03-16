<?php

namespace App\Filament\Pages;

use App\Models\Video;
use Filament\Pages\Dashboard as BasePage;
use Illuminate\Support\Facades\DB;

class Dashboard extends BasePage
{
    protected function getColumns(): int|array
    {
        return [
            'md' => 1,
            'xl' => 1,
        ];
    }

    public function getData(): array
    {
        $videos = Video::select('videos.*', DB::raw('COUNT(views.id) as views_count'))
            ->leftJoin('views', 'views.video_id', '=', 'videos.id')
            ->where('status', 'approved')
            ->groupBy('videos.id')
            ->orderBy('views_count', 'desc')
            ->get();

        return [
            'videos' => $videos,
        ];
    }
}
