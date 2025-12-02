<?php

namespace App\Filament\Resources\Store\Students\RelationManagers;

use App\Filament\Resources\Store\Users\UserResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserRelationManager extends RelationManager {

    protected static string $relationship = 'user';
    protected static ?string $relatedResource = UserResource::class;

    public function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('first_name')
            ->columns([
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('email'),
            ])
            ->filters([])
            ->headerActions([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ]);
    }
}
