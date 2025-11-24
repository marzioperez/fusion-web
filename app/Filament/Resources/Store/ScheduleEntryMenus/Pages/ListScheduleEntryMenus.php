<?php

namespace App\Filament\Resources\Store\ScheduleEntryMenus\Pages;

use App\Filament\Resources\Store\ScheduleEntryMenus\ScheduleEntryMenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListScheduleEntryMenus extends ListRecords {

    protected static string $resource = ScheduleEntryMenuResource::class;

    protected function getHeaderActions(): array {
        return [

        ];
    }
}
