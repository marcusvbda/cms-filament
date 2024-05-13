<?php

namespace App\Filament\Admin\Resources\Cms\PagesResource\Widgets;

use App\Models\Page;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QtyPages extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $createdThisWeek = Page::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $createdLastWeek = Page::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();
        $trend = $createdThisWeek - $createdLastWeek;
        $direction =  $trend > 0 ? 'up' : 'down';
        $qtyEachLastWeeks = collect([
            Page::whereBetween('created_at', [now()->subWeeks(3)->startOfWeek(), now()->subWeeks(3)->endOfWeek()])->count(),
            Page::whereBetween('created_at', [now()->subWeeks(2)->startOfWeek(), now()->subWeeks(2)->endOfWeek()])->count(),
            Page::whereBetween('created_at', [now()->subWeeks(1)->startOfWeek(), now()->subWeeks(1)->endOfWeek()])->count(),
            $createdLastWeek
        ]);
        return [
            Stat::make(ucfirst(__('total pages')), Page::count())
                ->chart($qtyEachLastWeeks->toArray())
                ->color($direction === 'up' ? 'success' : 'danger'),
            Stat::make(ucfirst(__('published pages')), Page::where('is_published', true)->count()),
            Stat::make(ucfirst(__('draft pages')), Page::where('is_published', false)->count()),
        ];
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
