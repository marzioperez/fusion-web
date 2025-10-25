<?php

namespace App\Filament\Resources\Store\Schools\Pages;

use App\Filament\Resources\Store\Schools\SchoolResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchools extends ListRecords
{
    protected static string $resource = SchoolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
