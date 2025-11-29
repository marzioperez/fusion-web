<?php

namespace App\Filament\Resources\Store\Orders\Pages;

use App\Enums\Status;
use App\Filament\Resources\Store\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListOrders extends ListRecords {

    use ExposesTableToWidgets;

    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array {
        return [
            // CreateAction::make(),
        ];
    }

    public function getTabs(): array {
        return [
            null => Tab::make('All'),
            Status::PENDING->value => Tab::make('Pending')->query(fn($query) => $query->where('status', Status::PENDING->value)),
            Status::FINISHED->value => Tab::make('Finished')->query(fn($query) => $query->where('status', Status::FINISHED->value)),
            Status::CANCELED->value => Tab::make('Canceled')->query(fn($query) => $query->where('status', Status::CANCELED->value)),
            Status::ERROR->value => Tab::make('Error')->query(fn($query) => $query->where('status', Status::ERROR->value)),
        ];
    }
}
