<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PagesResource\Pages;
use App\Filament\Admin\Resources\PagesResource\RelationManagers\PageAttributesRelationManager;
use App\Models\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PagesResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'ri-collage-fill';

    protected static ?string $navigationGroup = 'Cms';

    protected static ?string $recordTitleAttribute = 'title';

    public static function getLabel(): ?string
    {
        return __('page');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Toggle::make('is_published')->label(ucfirst(__('published')))->default(false)->columnSpanFull(),
                    TextInput::make('title')
                        ->required()
                        ->label(ucfirst(__('title')))
                        ->maxLength(255)
                        ->columnSpanFull(),
                    Textarea::make('description')
                        ->label(ucfirst(__('description')))
                        ->rows(5)
                        ->columnSpanFull(),
                    ToggleButtons::make('type')
                        ->label(ucfirst(__('type')))
                        ->required()
                        ->options([
                            'blade' => ucfirst('blade'),
                            'api' => ucfirst('api')
                        ])->inline()->columnSpan(1),
                    TextInput::make('slug')
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->columnSpan(1),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("id")
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label(ucfirst(__("title")))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label(ucfirst(__("type")))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('is_published')->searchable()->label(ucfirst(__('published')))
                    ->badge()
                    ->state(function ($record) {
                        return ucfirst(__($record->is_published ? 'yes' : 'no'));
                    })
                    ->color(function ($record) {
                        return $record->is_published ? 'success' : 'danger';
                    }),
                TextColumn::make('url')
                    ->state(function ($record) {
                        $slug = str_replace(".", "/", $record->slug);
                        $url = $record->slug === "index" ? "/" : "/" . $slug;
                        return $url;
                    })
                    ->url(function ($record) {
                        $slug = str_replace(".", "/", $record->slug);
                        $url = $record->slug === "index" ? "/" : "/" . $slug;
                        return $url;
                    }, true)
            ])
            ->recordAction(null)
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
            PageAttributesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePages::route('/create'),
            'edit' => Pages\EditPages::route('/{record}/edit'),
        ];
    }
}
