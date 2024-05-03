<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationGroup(): ?string
    {
        return ucfirst(__('access'));
    }

    public static function getLabel(): ?string
    {
        return __('user');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('name')
                        ->label(ucfirst(__('name')))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->unique('users', 'email', null, 'id')
                        ->required()
                        ->email()
                        ->maxLength(255),
                    TextInput::make('password')
                        ->label(ucfirst(__('password')))
                        ->hiddenOn('edit')
                        ->required()
                        ->password()
                        ->revealable()
                        ->maxLength(255),
                    TextInput::make('password_confirmation')
                        ->label(ucfirst(__('password_confirmation')))
                        ->required()
                        ->hiddenOn('edit')
                        ->password()
                        ->revealable()
                        ->maxLength(255),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(ucfirst(__('name')))->searchable(),
                TextColumn::make('email')->searchable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
