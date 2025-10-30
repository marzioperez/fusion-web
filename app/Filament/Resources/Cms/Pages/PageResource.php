<?php

namespace App\Filament\Resources\Cms\Pages;

use App\Filament\Resources\Cms\Pages\Pages\CreatePage;
use App\Filament\Resources\Cms\Pages\Pages\EditPage;
use App\Filament\Resources\Cms\Pages\Pages\ListPages;
use App\Filament\Resources\Cms\Pages\Schemas\PageForm;
use App\Filament\Resources\Cms\Pages\Tables\PagesTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource {

    protected static ?string $model = Page::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCheck;
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|\UnitEnum $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 20;
    protected static ?string $modelLabel = 'página';
    protected static ?string $breadcrumb = 'Páginas';

    public static function form(Schema $schema): Schema {
        return PageForm::configure($schema);
    }

    public static function table(Table $table): Table {
        return PagesTable::configure($table);
    }

    public static function getRelations(): array {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
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
