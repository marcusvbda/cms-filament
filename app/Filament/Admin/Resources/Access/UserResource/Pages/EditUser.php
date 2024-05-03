<?php

namespace App\Filament\Admin\Resources\Access\UserResource\Pages;

use App\Filament\Admin\Resources\Access\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
