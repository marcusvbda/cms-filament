<?php

namespace App\Filament\Admin\Resources\ComponentsResource\RelationManagers;

use App\Filament\Admin\Resources\PagesResource\RelationManagers\PageAttributesRelationManager;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AttributesRelationManager extends RelationManager
{
    protected static string $relationship = '_attributes';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return ucfirst(__('component attributes'));
    }

    public function form(Form $form): Form
    {
        return $form->schema(PageAttributesRelationManager::createForm(true));
    }

    public function table(Table $table): Table
    {
        $tableContent = app(PageAttributesRelationManager::class)->table($table);
        $tableContent->headerActions([
            Tables\Actions\CreateAction::make()->modelLabel(__('component attribute'))
        ]);
        return $tableContent;
    }
}
