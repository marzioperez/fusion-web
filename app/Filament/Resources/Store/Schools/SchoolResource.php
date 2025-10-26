<?php

namespace App\Filament\Resources\Store\Schools;

use App\Filament\Resources\Store\Schools\Pages\CreateSchool;
use App\Filament\Resources\Store\Schools\Pages\EditSchool;
use App\Filament\Resources\Store\Schools\Pages\ListSchools;
use App\Filament\Resources\Store\Schools\RelationManagers\GradesRelationManager;
use App\Filament\Resources\Store\Schools\RelationManagers\LockedDatesRelationManager;
use App\Filament\Resources\Store\Schools\Schemas\SchoolForm;
use App\Filament\Resources\Store\Schools\Tables\SchoolsTable;
use App\Models\School;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class SchoolResource extends Resource {

    protected static ?string $model = School::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingLibrary;
    protected static ?string $recordTitleAttribute = 'name';
    protected static string | UnitEnum | null $navigationGroup = 'Tienda';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'colegio';
    protected static ?string $breadcrumb = 'Colegios';

    public static function form(Schema $schema): Schema {
        return SchoolForm::configure($schema);
    }

    public static function table(Table $table): Table {
        return SchoolsTable::configure($table);
    }

    public static function getRelations(): array {
        return [
            GradesRelationManager::class,
            LockedDatesRelationManager::class,
        ];
    }

    public static function getPages(): array {
        return [
            'index' => ListSchools::route('/'),
            'create' => CreateSchool::route('/create'),
            'edit' => EditSchool::route('/{record}/edit'),
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
