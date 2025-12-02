<?php

namespace App\Filament\Resources\Store\Users\RelationManagers;

use App\Filament\Resources\Store\Students\StudentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class StudentsRelationManager extends RelationManager {
    protected static string $relationship = 'students';
    protected static ?string $title = 'Students';
    protected static ?string $modelLabel = 'student';

    protected static ?string $relatedResource = StudentResource::class;

    public function table(Table $table): Table {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
