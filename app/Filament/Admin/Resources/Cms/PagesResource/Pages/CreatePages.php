<?php

namespace App\Filament\Admin\Resources\Cms\PagesResource\Pages;

use App\Filament\Admin\Resources\Cms\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePages extends CreateRecord
{
    protected static string $resource = PagesResource::class;
}
