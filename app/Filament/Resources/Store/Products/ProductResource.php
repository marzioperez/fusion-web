<?php

namespace App\Filament\Resources\Store\Products;

use App\Filament\Resources\Store\Products\Pages\CreateProduct;
use App\Filament\Resources\Store\Products\Pages\EditProduct;
use App\Filament\Resources\Store\Products\Pages\ListProducts;
use App\Filament\Resources\Store\Products\RelationManagers\IngredientsRelationManager;
use App\Filament\Resources\Store\Products\Schemas\ProductForm;
use App\Filament\Resources\Store\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource {

    protected static ?string $model = Product::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Briefcase;
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|\UnitEnum $navigationGroup = 'Tienda';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'producto';
    protected static ?string $breadcrumb = 'Productos';

    public static function form(Schema $schema): Schema {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array {
        return [
            IngredientsRelationManager::class
        ];
    }

    public static function getPages(): array {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
