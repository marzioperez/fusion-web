<?php

namespace App\Jobs;

use App\Models\MenuEntry;
use App\Models\Product;
use App\Models\School;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessMenuEntry implements ShouldQueue{
    use Queueable;

    public function __construct(public $data) {
    }

    public function handle(): void {
        $product = Product::where('sku', $this->data['sku_del_plato'])->first();
        if ($product) {
            $school_model = School::query();
            $exclude_school_names = [];
            if ($this->data['no_considerar_1']) {
                $exclude_school_names[] = $this->data['no_considerar_1'];
            }
            if ($this->data['no_considerar_2']) {
                $exclude_school_names[] = $this->data['no_considerar_2'];
            }
            if ($this->data['no_considerar_3']) {
                $exclude_school_names[] = $this->data['no_considerar_3'];
            }
            if ($this->data['no_considerar_4']) {
                $exclude_school_names[] = $this->data['no_considerar_4'];
            }
            if ($this->data['no_considerar_5']) {
                $exclude_school_names[] = $this->data['no_considerar_5'];
            }

            if ($this->data['colegio'] !== 'Todos') {
                $school_model->where('name', $this->data['colegio']);
            }

            if (count($exclude_school_names) > 0) {
                $exclude_schools = $school_model->clone()->whereIn('name', $exclude_school_names)->get()->pluck('id');
                $school_model->whereNotIn('id', $exclude_schools);
            }

            $schools = $school_model->get();
            if (!$schools->isEmpty()) {
                foreach ($schools as $school) {
                    $gradesInput = $this->data['grados'] ?? null;

                    if ($gradesInput && strtolower(trim($gradesInput)) !== 'todos') {
                        // Convert "nombre1, nombre2, nombre3" into an array [nombre1, nombre2, nombre3]
                        $gradeNames = collect(explode(',', $gradesInput))
                            ->map(fn ($name) => trim($name))
                            ->filter()
                            ->unique()
                            ->values();

                        if ($gradeNames->isNotEmpty()) {
                            // Filter grades of this school by the provided names
                            $grades = $school->grades()->whereIn('name', $gradeNames->all())->get();
                        } else {
                            // If after cleaning there are no valid names, use all grades
                            $grades = $school->grades;
                        }
                    } else {
                        // If "grados" is empty or "Todos", use all grades
                        $grades = $school->grades;
                    }

                    if ($grades->isNotEmpty()) {
                        foreach ($grades as $grade) {
                            $customPrice = $this->data['precio_personalizado'] ?? null;
                            $price = is_numeric($customPrice) ? (float) $customPrice : $product->price;

                            MenuEntry::create([
                                'school_id' => $school->id,
                                'grade_id' => $grade->id,
                                'date' => $this->data['fecha_yyyy_mm_dd'],
                                'product_id' => $product->id,
                                'price' => $price
                            ]);
                        }
                    }
                }
            }
        }
    }
}
