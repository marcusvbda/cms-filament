<?php

namespace App\Filament\Admin\Resources\Cms\PagesResource\Pages;

use App\Filament\Admin\Resources\Cms\PagesResource;
use App\Filament\Admin\Resources\Cms\PagesResource\Widgets\QtyPages;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PagesResource::class;

    public function getHeaderWidgets(): array
    {
        return [
            QtyPages::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
