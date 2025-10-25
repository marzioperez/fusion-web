<?php

namespace App\Filament\Resources\Store\Students;

use App\Filament\Resources\Store\Students\Pages\CreateStudent;
use App\Filament\Resources\Store\Students\Pages\EditStudent;
use App\Filament\Resources\Store\Students\Pages\ListStudents;
use App\Filament\Resources\Store\Students\Schemas\StudentForm;
use App\Filament\Resources\Store\Students\Tables\StudentsTable;
use App\Models\Store\Student;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource {

    protected static ?string $model = Student::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'first_name';

    public static function form(Schema $schema): Schema {
        return StudentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentsTable::configure($table);
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
            'index' => ListStudents::route('/'),
            'create' => CreateStudent::route('/create'),
            'edit' => EditStudent::route('/{record}/edit'),
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
