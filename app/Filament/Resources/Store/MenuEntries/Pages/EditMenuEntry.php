<?php

namespace App\Filament\Resources\Store\MenuEntries\Pages;

use App\Filament\Resources\Store\MenuEntries\MenuEntryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuEntry extends EditRecord
{
    protected static string $resource = MenuEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
