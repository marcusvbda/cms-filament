<?php

namespace App\Filament\Admin\Resources\CollectionsResource\RelationManagers;

use App\Models\CollectionRow;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RowsRelationManager extends RelationManager
{
    protected static string $relationship = 'rows';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return ucfirst(__('rows'));
    }

    public function form(Form $form): Form
    {
        $fields = [];
        $collection = $this->getOwnerRecord();
        foreach ($collection->columns as $column) {
            $key = data_get($column, "key");
            $completeKey = "data." . $key;
            $fields[] = match (data_get($column, "type")) {
                'boolean' => Toggle::make($completeKey)->label(ucfirst(__($key)))->columnSpanFull(),
                default => TextInput::make($completeKey)->label(ucfirst(__($key)))->columnSpanFull()
            };
        }

        return $form->schema($fields);
    }

    public function table(Table $table): Table
    {
        $columns = [];
        $collection = $this->getOwnerRecord();
        foreach ($collection->columns as $column) {
            $key = data_get($column, "key");
            $completeKey = "data." . $key;
            $columns[] = match (data_get($column, "type")) {
                'boolean' => TextColumn::make($completeKey)->label(ucfirst(__($key)))
                    ->badge()->searchable()
                    ->state(function ($record) use ($completeKey) {
                        return ucfirst(__(data_get($record, $completeKey) ? 'yes' : 'no'));
                    })
                    ->color(function ($record) use ($key) {
                        return data_get($record, "data.$key") ? 'success' : 'danger';
                    }),
                default => TextColumn::make($completeKey)->searchable()->label(ucfirst(__($key)))->state(function ($record) use ($completeKey) {
                    return data_get($record, $completeKey);
                }),
            };
        }

        return $table
            ->recordTitleAttribute('name')
            ->columns($columns)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->modelLabel(__('row'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
