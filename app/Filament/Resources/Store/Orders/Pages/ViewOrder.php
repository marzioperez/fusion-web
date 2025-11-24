<?php

namespace App\Filament\Resources\Store\Orders\Pages;

use App\Filament\Resources\Store\Orders\OrderResource;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Concerns\HasTabs;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class ViewOrder extends ViewRecord {

    protected static string $resource = OrderResource::class;
    use HasTabs;

    public function infolist(Schema $schema): Schema {
        return $schema->components([

        ]);
    }

    protected function getHeaderActions(): array {
        return [
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
