<?php

namespace App\Filament\Admin\Resources\CollectionsResource\Pages;

use App\Filament\Admin\Resources\CollectionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCollections extends EditRecord
{
    protected static string $resource = CollectionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
