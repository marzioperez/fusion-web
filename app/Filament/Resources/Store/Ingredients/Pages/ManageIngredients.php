<?php

namespace App\Filament\Resources\Store\Ingredients\Pages;

use App\Filament\Resources\Store\Ingredients\IngredientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageIngredients extends ManageRecords
{
    protected static string $resource = IngredientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
