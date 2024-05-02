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
            Stat::make(ucfirst(__('total posts')), Post::count()),
            Stat::make(ucfirst(__('published posts')), Post::where('is_published', true)->count()),
            Stat::make(ucfirst(__('draft posts')), Post::where('is_published', false)->count()),
        ];
    }
}
