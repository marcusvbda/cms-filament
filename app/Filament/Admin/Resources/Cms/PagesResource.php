<?php

namespace App\Filament\Admin\Resources\Cms;

use App\Filament\Admin\Resources\Cms\PagesResource\Pages;
use App\Models\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

    public static function form(Form $form): Form
    {
        $bladeFiles = array_map(function ($file) {
            return str_replace('.blade.php', '', $file);
        }, array_diff(scandir(resource_path('views')), ['..', '.']));
        $bladeFiles = array_combine($bladeFiles, $bladeFiles);

        return $form
            ->schema([
                Section::make([
                    Toggle::make('is_published')->label(ucfirst(__('published')))->default(false),
                    TextInput::make('title')
                        ->required()
                        ->translateLabel()
                        ->maxLength(255),
                    Select::make('slug')
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->options($bladeFiles),
                ]),
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
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('is_published')->searchable()->label(ucfirst(__('published')))
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return ucfirst(__($record->is_published ? 'published' : 'draft'));
                    })
                    ->color(function ($record) {
                        return $record->is_published ? 'success' : 'danger';
                    }),
                TextColumn::make('url')
                    ->getStateUsing(function ($record) {
                        $url = $record->slug === "index" ? "/" : "/" . $record->slug;
                        return $url;
                    })
                    ->url(function ($record) {
                        $url = $record->slug === "index" ? "/" : "/" . $record->slug;
                        return $url;
                    }, true)
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
            //
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
