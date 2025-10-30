<?php

namespace App\Filament\Resources\Cms\Sliders;

use App\Filament\Resources\Cms\Sliders\Pages\CreateSlider;
use App\Filament\Resources\Cms\Sliders\Pages\EditSlider;
use App\Filament\Resources\Cms\Sliders\Pages\ListSliders;
use App\Filament\Resources\Cms\Sliders\RelationManagers\SlidesRelationManager;
use App\Filament\Resources\Cms\Sliders\Schemas\SliderForm;
use App\Filament\Resources\Cms\Sliders\Tables\SlidersTable;
use App\Models\Slider;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource {

    protected static ?string $model = Slider::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::RectangleStack;
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|\UnitEnum $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 21;
    protected static ?string $modelLabel = 'slider';
    protected static ?string $breadcrumb = 'Sliders';

    public static function form(Schema $schema): Schema {
        return SliderForm::configure($schema);
    }

    public static function table(Table $table): Table {
        return SlidersTable::configure($table);
    }

    public static function getRelations(): array {
        return [
            SlidesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSliders::route('/'),
            'create' => CreateSlider::route('/create'),
            'edit' => EditSlider::route('/{record}/edit'),
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
