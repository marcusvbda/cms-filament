<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostsResource\Pages;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms\Components\{Section, TextInput, Toggle, RichEditor, Select};
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\{TextColumn};
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Str;

class PostsResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $recordTitleAttribute = 'title';

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Toggle::make('is_published')->label(ucfirst(__('published')))->default(false),
                    TextInput::make('title')
                        ->required()
                        ->translateLabel()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state, $context) {
                            if ($context === 'edit') return;
                            $slug = Str::slug($state);
                            $count = Category::where('slug', $slug)->count();
                            if ($count > 0) $slug .= "-$count";
                            $set('slug', $slug);
                        }),
                    TextInput::make('slug')
                        ->unique(ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', preg_replace('/\s+/', '', $state));
                        })
                        ->required()
                        ->maxLength(255)
                        ->columnSpan('full'),
                    Select::make('category_id')
                        ->label((ucfirst(__('category'))))
                        ->required()
                        ->relationship('category', 'name')
                        ->searchable(),
                    RichEditor::make('content')->required()->label((ucfirst(__('content'))))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('title')->limit(20)->sortable()->searchable()->translateLabel(),
                TextColumn::make('slug')->limit(50)->sortable()->searchable(),
                TextColumn::make('category.name')->limit(50)->sortable()->searchable()->label(ucfirst(__('category'))),
                TextColumn::make('is_published')->searchable()->label(ucfirst(__('published')))
                    ->badge()
                    ->state(function ($record) {
                        return ucfirst(__($record->is_published ? 'published' : 'draft'));
                    })
                    ->color(function ($record) {
                        return $record->is_published ? 'success' : 'danger';
                    })
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label(ucfirst(__('category')))
                    ->relationship('category', 'name')
                    ->searchable(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
