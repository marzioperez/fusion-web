<?php

namespace App\Filament\Resources\Store\Products\Pages;

use App\Filament\Resources\Store\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
