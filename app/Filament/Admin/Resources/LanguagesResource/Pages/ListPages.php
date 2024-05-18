<?php

namespace App\Filament\Admin\Resources\LanguagesResource\Pages;

use App\Filament\Admin\Resources\LanguagesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = LanguagesResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
