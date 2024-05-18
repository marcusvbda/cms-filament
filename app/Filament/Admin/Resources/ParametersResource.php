<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ParametersResource\Pages;
use App\Models\Component;
use App\Models\Parameter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Auth;
use Str;

class ParametersResource extends Resource
{
    protected static ?string $model = Parameter::class;

    protected static ?string $navigationIcon = 'feathericon-settings';
    protected static ?string $recordTitleAttribute = 'label';

    public static function getNavigationGroup(): ?string
    {
        return ucfirst(__('settings'));
    }

    public static function getLabel(): ?string
    {
        return __('parameters');
    }

    public static function getPluralLabel(): ?string
    {
        return __('parameters');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label(ucfirst(__("setting")))
                    ->state(fn ($record) => ucfirst(__($record->label))),
                TextColumn::make('value')
                    ->label(ucfirst(__("value")))
                    ->html()
                    ->state(function ($record) {
                        return match ($record->type) {
                            'color' => (function () use ($record) {
                                $color = $record->value;
                                return <<<BLADE
                                    <div style='display: flex;align-items: center;gap: 5px;'> 
                                        <span style='height: 20px;width: 20px;border-radius: 100%;background-color:$color'></span>
                                        $color
                                    </div>
                                BLADE;
                            })(),
                            'component' => Component::find($record->value)->editUrl,
                            'textarea' => Str::limit($record->value, 50),
                            default => __($record->value)
                        };
                    }),
            ])
            ->actions([
                EditAction::make()
                    ->form(function ($record) {
                        return match ($record->type) {
                            'select' => [
                                Select::make('value')
                                    ->label(ucfirst(__($record->label)))
                                    ->required()
                                    ->options($record->attributes['options'])
                            ],
                            'component' => [
                                Select::make('value')
                                    ->label(ucfirst(__($record->label)))
                                    ->required()
                                    ->lazy()
                                    ->options(Component::query()->pluck('name', 'id'))
                            ],
                            'textarea' => [
                                TextArea::make('value')
                                    ->required()
                                    ->label(ucfirst(__($record->label)))
                                    ->rows(5)
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

    public static function canAccess(): bool
    {
        return Auth::user()->isAdmin();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageParameters::route('/'),
        ];
    }
}
