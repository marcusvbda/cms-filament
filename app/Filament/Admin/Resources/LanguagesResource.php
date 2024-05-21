<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LanguagesResource\Pages;
use App\Models\Language;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LanguagesResource extends Resource
{
    protected static ?string $model = Language::class;

    protected static ?string $navigationIcon = 'ik-language';
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return ucfirst(__('content'));
    }

    public static function getLabel(): ?string
    {
        return __('language');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'code'];
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
                        ->columnSpan(1),
                    TextInput::make('code')
                        ->label(ucfirst(__('code')))
                        ->columnSpan(1),
                    FileUpload::make('flag')->moveFiles()->required()->columnSpanFull()->label(ucfirst(__('flag')))->downloadable()->imageEditor(),
                ])->columns(2),
                Section::make([
                    Repeater::make('items')
                        ->reorderable(false)
                        ->label(ucfirst(__('items')))
                        ->schema([
                            TextInput::make('key')->required()->distinct()->label(ucfirst(__('key'))),
                            TextInput::make('value')->required()->label(ucfirst(__('value'))),
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
                TextColumn::make('name')
                    ->label(ucfirst(__("name")))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('code')
                    ->label(ucfirst(__("code")))
                    ->searchable()
                    ->sortable(),
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
