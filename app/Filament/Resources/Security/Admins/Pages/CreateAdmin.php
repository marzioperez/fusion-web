<?php

namespace App\Filament\Resources\Security\Admins\Pages;

use App\Filament\Resources\Security\Admins\AdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;
}
