<?php

namespace App\Filament\Resources\Store\Orders;

use App\Filament\Resources\Store\Orders\Pages\CreateOrder;
use App\Filament\Resources\Store\Orders\Pages\EditOrder;
use App\Filament\Resources\Store\Orders\Pages\ListOrders;
use App\Filament\Resources\Store\Orders\Pages\ViewOrder;
use App\Filament\Resources\Store\Orders\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\Store\Orders\Schemas\OrderForm;
use App\Filament\Resources\Store\Orders\Tables\OrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource {

    protected static ?string $model = Order::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingCart;
    protected static ?string $recordTitleAttribute = 'code';
    protected static string|null|\UnitEnum $navigationGroup = 'Tienda';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema {
        return OrderForm::configure($schema);
    }

    public static function table(Table $table): Table {
        return OrdersTable::configure($table)->modifyQueryUsing(fn(Builder $query) => $query->orderBy('created_at', 'desc'));
    }

    public static function getRelations(): array {
        return [
            ItemsRelationManager::class
        ];
    }

    public static function getPages(): array {
        return [
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
            'view' => ViewOrder::route('/{record}/view'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
