<?php

namespace App\Filament\Resources\Store\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UsersTable {

    public static function configure(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('first_name')->label('Firstname')->searchable()->sortable(),
                TextColumn::make('last_name')->label('Lastname')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable()->sortable(),
            ])
            ->filters([
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
