<?php

namespace App\Filament\Resources\Store\MenuEntries\Pages;

use App\Filament\Resources\Store\MenuEntries\MenuEntryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenuEntries extends ListRecords
{
    protected static string $resource = MenuEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
