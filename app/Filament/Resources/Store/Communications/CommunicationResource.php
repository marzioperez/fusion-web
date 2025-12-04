<?php

namespace App\Filament\Resources\Store\Communications;

use App\Filament\Resources\Store\Communications\Pages\CreateCommunication;
use App\Filament\Resources\Store\Communications\Pages\EditCommunication;
use App\Filament\Resources\Store\Communications\Pages\ListCommunications;
use App\Filament\Resources\Store\Communications\Schemas\CommunicationForm;
use App\Filament\Resources\Store\Communications\Tables\CommunicationsTable;
use App\Models\Communication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommunicationResource extends Resource {

    protected static ?string $model = Communication::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleBottomCenter;
    protected static ?string $recordTitleAttribute = 'subject';
    protected static string|null|\UnitEnum $navigationGroup = 'Store';
    protected static ?int $navigationSort = 9;

    public static function form(Schema $schema): Schema {
        return CommunicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunicationsTable::configure($table);
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
            'index' => ListCommunications::route('/'),
            'create' => CreateCommunication::route('/create'),
            'edit' => EditCommunication::route('/{record}/edit'),
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
