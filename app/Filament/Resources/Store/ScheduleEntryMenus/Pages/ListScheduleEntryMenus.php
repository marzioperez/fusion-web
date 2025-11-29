<?php

namespace App\Filament\Resources\Store\ScheduleEntryMenus\Pages;

use App\Filament\Resources\Store\ScheduleEntryMenus\ScheduleEntryMenuResource;
use App\Jobs\ProcessScheduleEntryMenuReport;
use App\Models\School;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Carbon;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class ListScheduleEntryMenus extends ListRecords {

    protected static string $resource = ScheduleEntryMenuResource::class;

    protected function getHeaderActions(): array {
        return [
            Action::make('export')->label('Export schedule menus')->color('success')
                ->form([
                    DateRangePicker::make('date_range')->label('Date range')->columnSpanFull()->required(),
                    Toggle::make('all_schools')->label('All schools')->default(true)->live(true)->columnSpan(6),
                    Toggle::make('send_to_schools')->label('Send email to schools')->default(false)->live(true)->columnSpan(6),
                    Select::make('school_ids')->label('Schools')
                        ->multiple()->options(School::all()->pluck('name', 'id'))
                        ->required(fn(Get $get) => $get('all_schools') == false)
                        ->visible(fn(Get $get) => $get('all_schools') == false),
                ])->action(function (array $data) {
                    $date_range = explode(' - ', $data['date_range']);
                    $from = Carbon::createFromFormat('d/m/Y', trim($date_range[0]))->format('Y-m-d');
                    $to = Carbon::createFromFormat('d/m/Y', trim($date_range[1]))->format('Y-m-d');
                    $school_ids = [];
                    if ($data['all_schools'] == false) {
                        $school_ids = $data['school_ids'];
                    }

                    ProcessScheduleEntryMenuReport::dispatch($from, $to, $school_ids, $data['send_to_schools']);
                    $this->redirect('/admin/store/schedule-entry-menus');
                }),
        ];
    }
}
