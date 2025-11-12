<?php

namespace App\Filament\Resources\Store\Allergies\Pages;

use App\Filament\Resources\Store\Allergies\AllergyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAllergies extends ManageRecords
{
    protected static string $resource = AllergyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
