<?php

namespace App\Imports;

use App\Jobs\ProcessMenuEntry;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuEntry implements WithHeadingRow, ToModel {

    public function model(array $row) {
        ProcessMenuEntry::dispatch($row);
    }
}
