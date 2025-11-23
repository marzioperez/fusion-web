<?php

namespace App\Filament\Resources\Store\Products\Pages;

use App\Filament\Resources\Store\Products\ProductResource;
use App\Imports\Products;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListProducts extends ListRecords {

    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array {
        return [
            Action::make('import')->label('Import products')->color('success')
            ->form([
                FileUpload::make('file')->label('Archivo')->disk('local')->required(),
            ])->action(function (array $data) {
                Excel::import(new Products(), $data['file'], 'local');
                if(Storage::disk('local')->exists($data['file'])) {
                    sleep(2);
                    Storage::disk('local')->delete($data['file']);
                }
                $this->redirect('/admin/store/products');
            }),
            CreateAction::make(),
        ];
    }
}
