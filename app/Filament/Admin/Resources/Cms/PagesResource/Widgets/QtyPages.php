<?php

namespace App\Filament\Admin\Resources\Cms\PagesResource\Widgets;

use App\Models\Page;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QtyPages extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(ucfirst(__('total pages')), Page::count()),
            Stat::make(ucfirst(__('published pages')), Page::where('is_published', true)->count()),
            Stat::make(ucfirst(__('draft pages')), Page::where('is_published', false)->count()),
        ];
    }
}
