<?php

namespace App\Filament\Resources\Security\Admins;

use App\Filament\Resources\Security\Admins\Pages\CreateAdmin;
use App\Filament\Resources\Security\Admins\Pages\EditAdmin;
use App\Filament\Resources\Security\Admins\Pages\ListAdmins;
use App\Filament\Resources\Security\Admins\Schemas\AdminForm;
use App\Filament\Resources\Security\Admins\Tables\AdminsTable;
use App\Models\Admin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdminResource extends Resource {

    protected static ?string $model = Admin::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserCircle;
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|\UnitEnum $navigationGroup = 'Seguridad';
    protected static ?int $navigationSort = 41;
    protected static ?string $modelLabel = 'administrador';
    protected static ?string $breadcrumb = 'Administradores';
    protected static ?string $navigationLabel = 'Administradores';

    public static function form(Schema $schema): Schema {
        return AdminForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdminsTable::configure($table);
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
            'index' => ListAdmins::route('/'),
            'create' => CreateAdmin::route('/create'),
            'edit' => EditAdmin::route('/{record}/edit'),
        ];
    }
}
