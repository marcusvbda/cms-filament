<?php

namespace App\Filament\Admin\Resources\ComponentsResource\Pages;

use App\Filament\Admin\Resources\ComponentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComponents extends ListRecords
{
    protected static string $resource = ComponentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
