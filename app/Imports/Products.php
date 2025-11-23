<?php

namespace App\Imports;

use App\Jobs\ProcessProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Products implements WithHeadingRow, ToModel {

    public function model(array $row) {
        ProcessProduct::dispatch($row);
    }
}
