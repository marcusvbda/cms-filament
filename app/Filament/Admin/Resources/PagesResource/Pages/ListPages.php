<?php

namespace App\Filament\Admin\Resources\PagesResource\Pages;

use App\Filament\Admin\Resources\PagesResource;
use App\Filament\Admin\Resources\PagesResource\Widgets\QtyPages;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
// use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
// use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListPages extends ListRecords
{
    protected static string $resource = PagesResource::class;

    public function getHeaderWidgets(): array
    {
        return [
            QtyPages::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // ExportAction::make()->exports([
            //     ExcelExport::make()->fromTable()
            //     // ->withFilename(fn () => uniqid() . '-pages')->queue()->withChunkSize(100)
            // ])->label(ucfirst(__('export')))
        ];
    }
}
