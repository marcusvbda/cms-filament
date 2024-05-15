<?php

namespace App\Filament\Admin\Resources\Cms\LanguagesResource\Pages;

use App\Filament\Admin\Resources\Cms\LanguagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePages extends CreateRecord
{
    protected static string $resource = LanguagesResource::class;
}
