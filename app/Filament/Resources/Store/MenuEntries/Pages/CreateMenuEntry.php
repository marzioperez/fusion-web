<?php

namespace App\Filament\Resources\Store\MenuEntries\Pages;

use App\Filament\Resources\Store\MenuEntries\MenuEntryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuEntry extends CreateRecord
{
    protected static string $resource = MenuEntryResource::class;
}
