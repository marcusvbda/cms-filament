<?php

namespace App\Filament\Admin\Resources\PostsResource\Widgets;

use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QtyPosts extends StatsOverviewWidget
{
    protected static ?int $sort = -4;

    protected function getStats(): array
    {
        return [
            Stat::make('Total posts', Post::count()),
            Stat::make('Published posts', Post::where('is_published', true)->count()),
            Stat::make('Draft posts', Post::where('is_published', false)->count()),
        ];
    }
}
