<?php

namespace App\Filament\Admin\Resources\LanguagesResource\Pages;

use App\Filament\Admin\Resources\LanguagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPages extends EditRecord
{
    protected static string $resource = LanguagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
