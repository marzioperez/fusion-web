<?php

namespace App\Filament\Widgets;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget {

    protected static ?int $sort = 0;

    protected function getStats(): array {
        return [
            Stat::make('Total customers', User::all()->count())->icon('heroicon-m-users'),
            Stat::make('Total students', Student::all()->count())->icon('heroicon-m-user-group'),
            Stat::make('Total schools', School::all()->count())->icon('heroicon-m-building-office-2'),
        ];
    }
}
