<?php

namespace App\Filament\Admin\Resources\Settings\ParametersResource\Pages;

use App\Filament\Admin\Resources\Settings\ParametersResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageParameters extends ManageRecords
{
    protected static string $resource = ParametersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
