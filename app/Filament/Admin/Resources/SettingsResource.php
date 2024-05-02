<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SettingsResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\EditAction;

class SettingsResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'feathericon-settings';
    protected static bool $shouldRegisterNavigation = false;

    public static function getLabel(): ?string
    {
        return __('setting');
    }

    public static function getPluralLabel(): ?string
    {
        return __('settings');
    }

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

    // public static function getNavigationBadgeColor(): ?string
    // {
    //     return 'warning';
    // }

    // public static function getNavigationBadgeTooltip(): ?string
    // {
    //     return 'The number of items';
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label(ucfirst(__("setting")))
                    ->formatStateUsing(fn (string $state): string => ucfirst(__($state))),
                TextColumn::make('value')
                    ->label(ucfirst(__("value")))
            ])
            ->actions([
                EditAction::make()
                    ->form(function (Setting $record) {
                        return match ($record->type) {
                            'select' => [
                                Select::make('value')
                                    ->label(ucfirst(__($record->label)))
                                    ->required()
                                    ->options($record->attributes['options'])
                            ],
                            default => [
                                TextInput::make('value')
                                    ->required()
                                    ->label(ucfirst(__($record->label)))
                                    ->type($record->type)
                            ]
                        };
                    }),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}
