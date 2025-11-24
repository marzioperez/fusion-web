<?php

namespace App\Filament\Resources\Store\Ingredients;

use App\Filament\Resources\Store\Ingredients\Pages\ManageIngredients;
use App\Models\Ingredient;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IngredientResource extends Resource {

    protected static ?string $model = Ingredient::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|null|\UnitEnum $navigationGroup = 'Store';
    protected static ?string $modelLabel = 'ingredient';
    protected static ?string $breadcrumb = 'Ingredients';
    protected static ?string $navigationParentItem = 'Products';

    public static function form(Schema $schema): Schema {
        return $schema
            ->components([
                TextInput::make('name')->label('Nombre')->required()->columnSpanFull(),
            ])->columns([
                'default' => 1,
                'sm' => 3,
                'xl' => 12,
                '2xl' => 12
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageIngredients::route('/'),
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
