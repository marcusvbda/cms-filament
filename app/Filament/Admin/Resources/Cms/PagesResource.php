<?php

namespace App\Filament\Admin\Resources\Cms;

use App\Filament\Admin\Resources\Cms\PagesResource\Pages;
use App\Models\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
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
use Str;

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
                    Select::make('blade')
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->options($bladeFiles),
                ]),
                Section::make([
                    Repeater::make('pageAttributes')
                        ->reorderable(false)
                        ->label(ucfirst(__('attributes')))
                        ->relationship()
                        ->schema([
                            TextInput::make('key')->required()->distinct()->label(ucfirst(__('key')))
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, $state) => $set('key', Str::slug($state, '_'))),
                            Select::make('type')->required()->label(ucfirst(__('type')))
                                ->options([
                                    'text' => ucfirst(__('text')),
                                    'boolean' => ucfirst(__('boolean')),
                                    'file' => ucfirst(__('file')),
                                    'image' => ucfirst(__('image')),
                                    'editor' => ucfirst(__('editor')),
                                    'repeater' => ucfirst(__('repeater')),
                                ])->default('text')->live(),
                            KeyValue::make('metaValue')->visible(fn ($get) => in_array($get('type'), ['file', 'image']))
                                ->label(ucfirst(__('meta')))->columnSpanFull(),
                            Toggle::make('booleanValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                                ->visible(fn ($get) => $get('type') === 'boolean'),
                            TextInput::make('textValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                                ->visible(fn ($get) => $get('type') === 'text'),
                            FileUpload::make('fileValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                                ->visible(fn ($get) => $get('type') === 'file')->downloadable(),
                            FileUpload::make('imageValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                                ->visible(fn ($get) => $get('type') === 'image')->downloadable()->imageEditor(),
                            RichEditor::make('textValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                                ->visible(fn ($get) => $get('type') === 'editor'),
                            Select::make('repeaterType')->required()->label(ucfirst(__('type')))
                                ->columnSpanFull()
                                ->options([
                                    'text' => ucfirst(__('text')),
                                    'image' => ucfirst(__('image')),
                                    'file' => ucfirst(__('file')),
                                ])->default('text')->live()
                                ->visible(fn ($get) => $get('type') === 'repeater'),
                            Repeater::make('repeaterValue')
                                ->label(ucfirst(__('items')))
                                ->schema([
                                    TextInput::make('textValue')->required()->columnSpanFull()->label(ucfirst(__('value')))->distinct()
                                ])
                                ->visible(fn ($get) => ($get('type') === 'repeater' && $get('repeaterType') === 'text'))
                                ->columnSpanFull(),
                            Repeater::make('repeaterValue')
                                ->label(ucfirst(__('items')))
                                ->schema([
                                    KeyValue::make('metaValue')->label(ucfirst(__('meta')))->columnSpanFull(),
                                    FileUpload::make('imageValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                                        ->downloadable()->imageEditor(),
                                ])
                                ->visible(fn ($get) => ($get('type') === 'repeater' && $get('repeaterType') === 'image'))
                                ->columnSpanFull(),
                            Repeater::make('repeaterValue')
                                ->label(ucfirst(__('items')))
                                ->schema([
                                    KeyValue::make('metaValue')->label(ucfirst(__('meta')))->columnSpanFull(),
                                    FileUpload::make('fileValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                                        ->downloadable(),
                                ])
                                ->visible(fn ($get) => ($get('type') === 'repeater' && $get('repeaterType') === 'file'))
                                ->columnSpanFull()
                        ])
                        ->columns(2)
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
                TextColumn::make('blade')
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
