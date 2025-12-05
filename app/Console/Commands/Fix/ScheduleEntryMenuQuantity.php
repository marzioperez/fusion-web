<?php

namespace App\Console\Commands\Fix;

use App\Enums\ProductTypes;
use App\Enums\Status;
use App\Models\Order;
use App\Models\ScheduleEntryMenu;
use App\Models\Student;
use Illuminate\Console\Command;

class ScheduleEntryMenuQuantity extends Command {

    protected $signature = 'fix:schedule-entry-menu-quantity';
    protected $description = 'Corrige ScheduleEntryMenu faltantes según quantity real de los items tipo FOOD';

    public function handle() {
        $orders = Order::query()->where('status', Status::FINISHED->value)->get();

        if ($orders->isEmpty()) {
            $this->error('No se encontraron órdenes.');
            return Command::FAILURE;
        }

        foreach ($orders as $order) {
            $this->info("Procesando Order #{$order->id} ({$order->code})");

            foreach ($order->items as $item) {
                // Aplicar SOLO a FOOD
                if ($item->type !== ProductTypes::FOOD->value) {
                    continue;
                }

                $quantity = (int) ($item->quantity ?? $item->qty ?? 1);
                if ($quantity < 1) {
                    $quantity = 1;
                }

                // Cuántos ScheduleEntryMenu ya existen para este ítem
                $existing = ScheduleEntryMenu::where('order_item_id', $item->id)->count();

                if ($existing >= $quantity) {
                    $this->line(" - Item {$item->id}: OK ({$existing}/{$quantity})");
                    continue;
                }

                // Cuántos faltan
                $missing = $quantity - $existing;

                $this->warn(" - Item {$item->id}: Faltan {$missing} registros");

                $student = Student::find($item->student_id);

                for ($i = 0; $i < $missing; $i++) {
                    ScheduleEntryMenu::create([
                        'order_item_id' => $item->id,
                        'product_id' => $item->product_id,
                        'school_id' => $student->school_id,
                        'grade_id' => $student->grade_id,
                        'student_id' => $student->id,
                        'date' => $item->date,
                        'first_name' => $student->first_name,
                        'last_name' => $student->last_name,
                        'product' => $item->name,
                        'school' => optional($student->school)->name,
                        'grade' => optional($student->grade)->name,
                        'color' => optional($student->school)->color,
                        'allergies' => $student->allergies,
                    ]);
                }

                $this->info("   → Reparado: {$missing} filas creadas");
            }
        }

        $this->info('Proceso completado.');

        return Command::SUCCESS;

    }
}
