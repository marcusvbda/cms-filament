<?php

namespace App\Filament\Admin\Resources\PostsResource\Widgets;

use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QtyPosts extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $createdThisWeek = Post::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $createdLastWeek = Post::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();
        $trend = $createdThisWeek - $createdLastWeek;
        $direction =  $trend > 0 ? 'up' : 'down';
        $qtyEachLastWeeks = collect([
            Post::whereBetween('created_at', [now()->subWeeks(3)->startOfWeek(), now()->subWeeks(3)->endOfWeek()])->count(),
            Post::whereBetween('created_at', [now()->subWeeks(2)->startOfWeek(), now()->subWeeks(2)->endOfWeek()])->count(),
            Post::whereBetween('created_at', [now()->subWeeks(1)->startOfWeek(), now()->subWeeks(1)->endOfWeek()])->count(),
            $createdLastWeek
        ]);
        return [
            Stat::make(ucfirst(__('total posts')), Post::count())
                ->chart($qtyEachLastWeeks->toArray())
                ->color($direction === 'up' ? 'success' : 'danger'),
            Stat::make(ucfirst(__('published posts')), Post::where('is_published', true)->count()),
            Stat::make(ucfirst(__('draft posts')), Post::where('is_published', false)->count()),
        ];
    }
}
