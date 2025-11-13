<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\School; // Ajusta si tu modelo se llama diferente (ej. College)
use App\Models\MenuEntry; // Ajusta el namespace/modelo si difiere

class MenuEntrySeeder extends Seeder {

    private const DATE_FIELD = 'date';

    public function run(): void {
        // 1) Determinar rango de fechas
        $start = Carbon::create(2025, 11, 1)->startOfDay();
        $end = Carbon::create(2025, 12, 20)->endOfDay();
        $period = CarbonPeriod::create($start, $end);

        // 2) Cargar colegios con sus grados (ajusta relación si difiere)
        $schools = School::query()->with(['grades:id,school_id'])->get(['id']);

        if ($schools->isEmpty()) {
            $this->command?->warn('No se encontraron colegios (School). Seeder cancelado.');
            return;
        }

        // 3) Recorrer días y crear MenuEntry por colegio y grado (idempotente)
        $created = 0;
        foreach ($period as $date) {
            // ❗ Saltar sábados (6) y domingos (0)
            if ($date->isWeekend()) {
                continue;
            }

            foreach ($schools as $school) {
                if ($school->grades->isEmpty()) {
                    // Si un colegio no tiene grados, se omite
                    continue;
                }

                foreach ($school->grades as $grade) {
                    $product = Product::all()->random();
                    $attributes = [
                        'school_id' => $school->id,
                        'grade_id'  => $grade->id,
                        'price' => $product->price,
                        'offer_price' => $product->offer_price,
                        'product_id' => $product->id,
                        self::DATE_FIELD => $date->toDateString(),
                    ];

                    // Evita duplicados; crea solo si no existe
                    MenuEntry::firstOrCreate($attributes);
                    $created++;
                }
            }
        }

        $this->command?->info("Seeder de MenuEntries completado. Registros verificados/creados: {$created} (todos los días, {$start->toDateString()} → {$end->toDateString()}).");
    }
}
