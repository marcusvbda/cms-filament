<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CollectionsResource\Pages;
use App\Filament\Admin\Resources\CollectionsResource\RelationManagers\RowsRelationManager;
use App\Models\Collection;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class CollectionsResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return ucfirst(__('auxiliary'));
    }

    public static function getLabel(): ?string
    {
        return __('collection');
    }

    public static function getPluralLabel(): ?string
    {
        return __('collections');
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
                    TextInput::make('webhook')
                        ->label(ucfirst(__('webhook')))
                        ->maxLength(50)
                        ->columnSpanFull()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, $state) => $set('webhook', str_replace(" ", "-", $state)))->rules([
                            fn ($get) => function ($attribute, $value, $fail) use ($get) {
                                if (Collection::where('webhook', $value)->where('id', '!=', $get("id"))->exists()) {
                                    $fail(__('The :attribute has already been taken.', ['attribute' => __('webhook')]));
                                }
                            },
                        ]),
                    Repeater::make('columns')
                        ->label(ucfirst(__('columns')))
                        ->schema([
                            TextInput::make('key')->required()->columnSpan(1)->label(ucfirst(__('key')))->distinct()->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, $state) => $set('key', str_replace(" ", "_", $state))),
                            ToggleButtons::make('type')
                                ->label(ucfirst(__('type')))
                                ->required()
                                ->options([
                                    'text' => ucfirst(__('text')),
                                    'boolean' => ucfirst(__('boolean')),
                                ])->default('text')->live()
                                ->inline()
                                ->columnSpan(1),
                        ])->columns(2)
                        ->columnSpanFull(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->label(ucfirst(__('id'))),
                TextColumn::make('name')
                    ->searchable()
                    ->label(ucfirst(__('name'))),
                TextColumn::make('webhook')
                    ->searchable()
                    ->label(ucfirst(__('webhook')))
                    ->copyable()
                    ->copyableState(fn (string $state): string => route('webhook', ['slug' => $state]))
                    ->html()

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            RowsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollections::route('/'),
            'create' => Pages\CreateCollections::route('/create'),
            'edit' => Pages\EditCollections::route('/{record}/edit'),
        ];
    }
}
