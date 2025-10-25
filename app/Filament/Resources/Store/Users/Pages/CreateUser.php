<?php

namespace App\Filament\Resources\Store\Users\Pages;

use App\Filament\Resources\Store\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
