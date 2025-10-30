<?php

namespace App\Filament\Resources\Store\Products\RelationManagers;

use App\Models\Ingredient;
use App\Settings\GeneralSettings;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IngredientsRelationManager extends RelationManager {

    protected static string $relationship = 'ingredients';
    protected static ?string $modelLabel = 'ingrediente';
    protected static ?string $title = 'Ingredientes';

    public function form(Schema $schema): Schema {
        $units = [];
        $settings = new GeneralSettings();
        foreach ($settings->units as $unit) {
            $units[$unit] = $unit;
        }

        return $schema
            ->components([
                TextInput::make('quantity')->label('Cantidad')->numeric()->required(),
                Select::make('unit')->label('Unidad')->options($units)->required()
            ])->columns();
    }

    public function table(Table $table): Table {
        $units = [];
        $settings = new GeneralSettings();
        foreach ($settings->units as $unit) {
            $units[$unit] = $unit;
        }

        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable(),
                TextColumn::make('pivot.quantity')->label('Cantidad')->sortable(),
                TextColumn::make('pivot.unit')->label('Unidad')->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Nuevo ingrediente')
                ->schema(function(CreateAction $action) use ($units) {
                    return [
                        TextInput::make('name')->label('Nombre del ingrediente')->required(),
                        TextInput::make('quantity')->label('Cantidad')->numeric()->required(),
                        Select::make('unit')->label('Unidad')->options($units)->required(),
                    ];
                }),
                AttachAction::make()
                    ->label('Añadir ingrediente')
                    ->schema(function(AttachAction $action) use ($units) {
                        return [
                            $action->getRecordSelect(),
                            TextInput::make('quantity')->label('Cantidad')->numeric()->required(),
                            Select::make('unit')->label('Unidad')->options($units)->required(),
                        ];
                    }),
            ])
            ->recordActions([
                EditAction::make()->label('Editar'),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
