<?php

namespace App\Filament\Resources\Store\MenuEntries\Pages;

use App\Filament\Resources\Store\MenuEntries\MenuEntryResource;
use App\Imports\MenuEntry;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListMenuEntries extends ListRecords {

    protected static string $resource = MenuEntryResource::class;

    protected function getHeaderActions(): array {
        return [
            Action::make('import')->label('Import products')->color('success')
                ->form([
                    FileUpload::make('file')->label('File')->disk('local')->required(),
                ])->action(function (array $data) {
                    Excel::import(new MenuEntry(), $data['file'], 'local');
                    if(Storage::disk('local')->exists($data['file'])) {
                        sleep(2);
                        Storage::disk('local')->delete($data['file']);
                    }
                    $this->redirect('/admin/store/menu-entries');
                }),
            CreateAction::make(),
        ];
    }
}
