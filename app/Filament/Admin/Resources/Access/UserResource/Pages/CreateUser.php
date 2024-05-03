<?php

namespace App\Filament\Admin\Resources\Access\UserResource\Pages;

use App\Filament\Admin\Resources\Access\UserResource;
// use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
