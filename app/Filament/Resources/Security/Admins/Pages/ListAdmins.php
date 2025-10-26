<?php

namespace App\Filament\Resources\Security\Admins\Pages;

use App\Filament\Resources\Security\Admins\AdminResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdmins extends ListRecords {

    protected static string $resource = AdminResource::class;
    protected static ?string $title = 'Administradores';

    protected function getHeaderActions(): array {
        return [
            CreateAction::make(),
        ];
    }
}
