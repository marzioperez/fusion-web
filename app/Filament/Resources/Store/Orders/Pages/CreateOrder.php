<?php

namespace App\Filament\Resources\Store\Orders\Pages;

use App\Filament\Resources\Store\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
