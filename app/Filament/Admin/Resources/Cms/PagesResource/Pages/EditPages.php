<?php

namespace App\Filament\Admin\Resources\Cms\PagesResource\Pages;

use App\Filament\Admin\Resources\Cms\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPages extends EditRecord
{
    protected static string $resource = PagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
