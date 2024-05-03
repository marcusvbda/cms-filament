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
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

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

    public static function scanDirForBladeFiles()
    {
        $bladeFiles = [];
        $viewsPath = resource_path('views');

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($viewsPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $relativePath = str_replace([$viewsPath, '.blade.php'], '', $file->getRealPath());
                $bladeName = str_replace(DIRECTORY_SEPARATOR, '.', $relativePath);
                $bladeFiles[] = basename($bladeName);
            }
        }

        $bladeFiles = array_map(function ($name) {
            return ltrim($name, '.');
        }, $bladeFiles);

        return $bladeFiles;
    }

    public static function form(Form $form): Form
    {
        $bladeFiles = self::scanDirForBladeFiles();
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
