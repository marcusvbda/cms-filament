<?php

namespace App\Filament\Admin\Resources\PostsResource\Pages;

use App\Filament\Admin\Resources\PostsResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostsResource::class;
}
