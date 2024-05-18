<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ComponentsResource\Pages;
use App\Filament\Admin\Resources\ComponentsResource\RelationManagers\AttributesRelationManager;
use App\Models\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ComponentsResource extends Resource
{
    protected static ?string $model = Component::class;

    protected static ?string $navigationIcon = 'phosphor-hard-drives';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getLabel(): ?string
    {
        return __('component');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('name')
                        ->required()
                        ->label(ucfirst(__('name')))
                        ->maxLength(255)
                        ->columnSpanFull(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("id")
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(ucfirst(__("name")))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('attributes')
                    ->label(ucfirst(__("attributes")))
                    ->state(function ($record) {
                        $qty = $record->_attributes->count();
                        return $qty . ' ' . __('attribute' . ($qty > 1 ? 's' : ''));
                    })
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            AttributesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComponents::route('/'),
            'create' => Pages\CreateComponents::route('/create'),
            'edit' => Pages\EditComponents::route('/{record}/edit'),
        ];
    }
}
