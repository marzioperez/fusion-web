<?php

namespace App\Filament\Resources\Cms\Menus;

use App\Filament\Resources\Cms\Menus\Pages\CreateMenu;
use App\Filament\Resources\Cms\Menus\Pages\EditMenu;
use App\Filament\Resources\Cms\Menus\Pages\ListMenus;
use App\Filament\Resources\Cms\Menus\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\Cms\Menus\Schemas\MenuForm;
use App\Filament\Resources\Cms\Menus\Tables\MenusTable;
use App\Models\Menu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource {

    protected static ?string $model = Menu::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Squares2x2;
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|\UnitEnum $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 22;
    protected static ?string $modelLabel = 'menu';
    protected static ?string $breadcrumb = 'Menus';

    public static function form(Schema $schema): Schema {
        return MenuForm::configure($schema);
    }

    public static function table(Table $table): Table {
        return MenusTable::configure($table);
    }

    public static function getRelations(): array {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
            'edit' => EditMenu::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
