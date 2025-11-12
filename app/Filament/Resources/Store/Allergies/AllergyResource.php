<?php

namespace App\Filament\Resources\Store\Allergies;

use App\Filament\Resources\Store\Allergies\Pages\CreateAllergy;
use App\Filament\Resources\Store\Allergies\Pages\EditAllergy;
use App\Filament\Resources\Store\Allergies\Pages\ListAllergies;
use App\Filament\Resources\Store\Allergies\Schemas\AllergyForm;
use App\Filament\Resources\Store\Allergies\Tables\AllergiesTable;
use App\Models\Store\Allergy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AllergyResource extends Resource
{
    protected static ?string $model = Allergy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AllergyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AllergiesTable::configure($table);
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
            'index' => ListAllergies::route('/'),
            'create' => CreateAllergy::route('/create'),
            'edit' => EditAllergy::route('/{record}/edit'),
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
