<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuEntry implements WithHeadingRow, ToModel {

    public function model(array $row) {
        $product = Product::where('sku', $row['sku_del_plato'])->first();
        if ($product) {
            $school_model = School::query();
            $exclude_school_names = [];
            if ($row['no_considerar_1']) {
                $exclude_school_names[] = $row['no_considerar_1'];
            }
            if ($row['no_considerar_2']) {
                $exclude_school_names[] = $row['no_considerar_2'];
            }
            if ($row['no_considerar_3']) {
                $exclude_school_names[] = $row['no_considerar_3'];
            }
            if ($row['no_considerar_4']) {
                $exclude_school_names[] = $row['no_considerar_4'];
            }

            if ($row['colegio'] !== 'Todos') {
                $school_model->where('name', $row['colegio']);
            }

            if (count($exclude_school_names) > 0) {
                $exclude_schools = $school_model->clone()->whereIn('name', $exclude_school_names)->get()->pluck('id');
                $school_model->whereNotIn('id', $exclude_schools);
            }

            $schools = $school_model->get();
            if (!$schools->isEmpty()) {
                foreach ($schools as $school) {
                    $grades = $school->grades;
                    if ($grades->isNotEmpty()) {
                        foreach ($grades as $grade) {
                            \App\Models\MenuEntry::create([
                                'school_id' => $school->id,
                                'grade_id' => $grade->id,
                                'date' => $row['fecha_yyyy_mm_dd'],
                                'product_id' => $product->id,
                                'price' => $product->price
                            ]);
                        }
                    }
                }
            }
        }
    }
}
