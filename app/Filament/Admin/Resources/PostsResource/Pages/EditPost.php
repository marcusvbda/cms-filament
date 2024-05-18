<?php

namespace App\Filament\Admin\Resources\PostsResource\Pages;

use App\Filament\Admin\Resources\PostsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
