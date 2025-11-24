<?php

namespace App\Filament\Resources\Store\ScheduleEntryMenus\Pages;

use App\Filament\Resources\Store\ScheduleEntryMenus\ScheduleEntryMenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditScheduleEntryMenu extends EditRecord
{
    protected static string $resource = ScheduleEntryMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
