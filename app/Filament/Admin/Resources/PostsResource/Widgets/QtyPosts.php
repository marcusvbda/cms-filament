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
            Stat::make(__('Total'), Post::count()),
            Stat::make(__('Posts publicados'), Post::where('is_published', true)->count()),
            Stat::make(__('Posts não publicados'), Post::where('is_published', false)->count()),
        ];
    }
}
