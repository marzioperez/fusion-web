<?php

namespace App\Filament\Resources\Store\MenuEntries;

use App\Filament\Resources\Store\MenuEntries\Pages\CreateMenuEntry;
use App\Filament\Resources\Store\MenuEntries\Pages\EditMenuEntry;
use App\Filament\Resources\Store\MenuEntries\Pages\ListMenuEntries;
use App\Filament\Resources\Store\MenuEntries\Schemas\MenuEntryForm;
use App\Filament\Resources\Store\MenuEntries\Tables\MenuEntriesTable;
use App\Models\MenuEntry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuEntryResource extends Resource {

    protected static ?string $model = MenuEntry::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDateRange;
    protected static ?string $recordTitleAttribute = 'date';
    protected static string|null|\UnitEnum $navigationGroup = 'Tienda';
    protected static ?int $navigationSort = 6;
    protected static ?string $modelLabel = 'menú del mes';
    protected static ?string $breadcrumb = 'Menú del mes';

    public static function form(Schema $schema): Schema {
        return MenuEntryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenuEntriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenuEntries::route('/'),
            'create' => CreateMenuEntry::route('/create'),
            'edit' => EditMenuEntry::route('/{record}/edit'),
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
