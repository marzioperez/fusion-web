<?php

namespace App\Filament\Resources\Store\Users;

use App\Filament\Resources\Store\Users\Pages\CreateUser;
use App\Filament\Resources\Store\Users\Pages\EditUser;
use App\Filament\Resources\Store\Users\Pages\ListUsers;
use App\Filament\Resources\Store\Users\RelationManagers\StudentsRelationManager;
use App\Filament\Resources\Store\Users\Schemas\UserForm;
use App\Filament\Resources\Store\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource {

    protected static ?string $model = User::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;
    protected static ?string $recordTitleAttribute = 'first_name';
    protected static string|null|\UnitEnum $navigationGroup = 'Tienda';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'cliente';
    protected static ?string $breadcrumb = 'Clientes';

    public static function form(Schema $schema): Schema {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array {
        return [
            StudentsRelationManager::class
        ];
    }

    public static function getPages(): array {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([]);
    }
}
