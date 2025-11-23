<?php

namespace App\Filament\Resources\Store\MenuEntries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class MenuEntriesTable {

    public static function configure(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('product.name')->label('Product')->searchable()->sortable(),
                TextColumn::make('school.name')->label('School')->searchable()->sortable(),
                TextColumn::make('grade.name')->label('Grade')->searchable()->sortable(),
                TextColumn::make('date')->label('Date')->date('d/m/Y')->searchable()->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
