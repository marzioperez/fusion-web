<?php

namespace App\Filament\Resources\Store\Students\Pages;

use App\Filament\Resources\Store\Students\StudentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;
}
