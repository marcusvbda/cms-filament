<?php

namespace App\Filament\Admin\Resources\PostsResource\Pages;

use App\Filament\Admin\Resources\PostsResource;
use App\Filament\Admin\Resources\PostsResource\Widgets\QtyPosts;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostsResource::class;

    public function getHeaderWidgets(): array
    {
        return [
            QtyPosts::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
