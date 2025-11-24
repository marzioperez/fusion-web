<?php

namespace App\Filament\Resources\Store\ScheduleEntryMenus;

use App\Filament\Resources\Store\ScheduleEntryMenus\Pages\CreateScheduleEntryMenu;
use App\Filament\Resources\Store\ScheduleEntryMenus\Pages\EditScheduleEntryMenu;
use App\Filament\Resources\Store\ScheduleEntryMenus\Pages\ListScheduleEntryMenus;
use App\Filament\Resources\Store\ScheduleEntryMenus\Schemas\ScheduleEntryMenuForm;
use App\Filament\Resources\Store\ScheduleEntryMenus\Tables\ScheduleEntryMenusTable;
use App\Models\ScheduleEntryMenu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ScheduleEntryMenuResource extends Resource {

    protected static ?string $model = ScheduleEntryMenu::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDateRange;
    protected static ?string $recordTitleAttribute = 'date';
    protected static string|null|\UnitEnum $navigationGroup = 'Store';
    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema {
        return ScheduleEntryMenuForm::configure($schema);
    }

    public static function table(Table $table): Table {
        return ScheduleEntryMenusTable::configure($table)->modifyQueryUsing(fn(Builder $query) => $query->orderBy('date', 'asc'));
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
            'index' => ListScheduleEntryMenus::route('/'),
            'create' => CreateScheduleEntryMenu::route('/create'),
            // 'edit' => EditScheduleEntryMenu::route('/{record}/edit'),
        ];
    }
}
