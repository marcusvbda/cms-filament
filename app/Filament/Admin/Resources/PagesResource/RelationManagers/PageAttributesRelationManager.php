<?php

namespace App\Filament\Admin\Resources\PagesResource\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Str;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class PageAttributesRelationManager extends RelationManager
{
    protected static string $relationship = 'pageAttributes';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return ucfirst(__('page attributes'));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('key')->required()->distinct()->label(ucfirst(__('key')))
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($set, $state) => $set('key', Str::slug($state, '_'))),
                    ToggleButtons::make('type')
                        ->label(ucfirst(__('type')))
                        ->required()
                        ->options([
                            'text' => ucfirst(__('text')),
                            'boolean' => ucfirst(__('boolean')),
                            'file' => ucfirst(__('file')),
                            'editor' => ucfirst(__('editor')),
                            'repeater' => ucfirst(__('repeater')),
                        ])->default('text')->live()
                        ->inline()->columnSpan(1),
                    KeyValue::make('metaValue')->visible(fn ($get) => in_array($get('type'), ['file', 'image']))
                        ->label(ucfirst(__('meta')))->columnSpanFull(),
                    Toggle::make('booleanValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                        ->visible(fn ($get) => $get('type') === 'boolean'),
                    TextInput::make('textValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                        ->visible(fn ($get) => $get('type') === 'text'),
                    FileUpload::make('fileValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                        ->visible(fn ($get) => $get('type') === 'file')->downloadable()->imageEditor(),
                    RichEditor::make('textValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                        ->visible(fn ($get) => $get('type') === 'editor'),
                    ToggleButtons::make('repeaterType')
                        ->label(ucfirst(__('type')))
                        ->required()
                        ->options([
                            'text' => ucfirst(__('text')),
                            'file' => ucfirst(__('file')),
                        ])->default('text')->live()
                        ->inline()->visible(fn ($get) => $get('type') === 'repeater')
                        ->columnSpan(1),
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
                            FileUpload::make('fileValue')->required()->columnSpanFull()->label(ucfirst(__('value')))
                                ->downloadable()->imageEditor()
                        ])
                        ->visible(fn ($get) => ($get('type') === 'repeater' && $get('repeaterType') === 'file'))
                        ->columnSpanFull()
                ]),
            ]);
    }

    private function getValueColumn($record, $imageSize = "200px")
    {
        $type =  data_get($record, "type");
        $target = $type . "Value";
        $value = data_get($record, $target);
        $truncatedValue = match ($type) {
            'boolean' => $value ? ucfirst(__('yes')) : ucfirst(__('no')),
            'file' => (function () use ($value, $imageSize) {
                $isImage = Str::contains($value, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                $url = Storage::url($value);
                $link = "<a href='$url' target='_blank'>{{content}}</a>";
                $linkContent = $isImage ? "<img src='$url' alt='image' style='max-width: $imageSize; max-height: $imageSize;border:1px solid #e4e4e4;border-radius:8px; padding:5px'>" : $value;
                $file = str_replace("{{content}}", $linkContent, $link);
                return $file;
            })(),
            'repeater' => (function () use ($value, $record) {
                $values = [];
                foreach ($value as $item) {
                    $item["type"] = data_get($record, "repeaterType");
                    $values[] = $this->getValueColumn($item, "80px");
                }
                $imploded = implode("", $values);
                return <<<HTML
                <div style="display:flex;flex-wrap:wrap;gap:5px;">
                        $imploded
                    </div>
                HTML;
            })(),
            default => Str::limit($value, 80),
        };
        $html = new HtmlString("<span>$truncatedValue</span>");
        return $html;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('key')
            ->columns([
                Tables\Columns\TextColumn::make('key')->label(ucfirst(__('key')) . " / " . ucfirst(__('key')))
                    ->description(fn ($record): string => ucfirst(__($record->type)))->sortable()->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\TextColumn::make('value')->label(ucfirst(__('value')))
                    ->state(fn ($record) => $this->getValueColumn($record))->html()
            ])
            ->defaultSort('id', 'desc')
            ->recordAction(null)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->modelLabel(__('page attribute'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
