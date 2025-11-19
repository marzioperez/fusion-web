<?php

namespace App\Actions\Cart;

use App\Enums\ProductTypes;
use App\Enums\Status;
use App\Models\Cart;
use App\Settings\GeneralSettings;
use Illuminate\Support\Str;

class AddToCart {

    public function __invoke($token, $product, $quantity = 1) {
        // 1. Buscar carrito con ese token
        $cart = Cart::where('token', $token)
            ->where('status', Status::PENDING->value)
            ->latest()
            ->first();

        // 2. Si no existe, crearlo
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'token'   => $token,
                'status'  => Status::PENDING->value,
                'items'   => [],
            ]);
        }

        // 3. Trabajar siempre sobre el array de items
        $items = $cart->items ?? [];

        $status = 'success';
        $existingFoodIndex = null;

        foreach ($items as $index => $item) {
            // Para FOOD sólo identificamos si ya existe el mismo plato para el mismo alumno y fecha
            if ($product['type'] === ProductTypes::FOOD->value) {
                if (
                    ($item['type'] ?? null) === ProductTypes::FOOD->value &&
                    $item['id'] == $product['id'] &&
                    $item['student']['id'] == $product['student']['id'] &&
                    $item['date'] == $product['date']
                ) {
                    $existingFoodIndex = $index;
                }
            }

            // Regla para ALL_DAYS: mismo producto, mismo alumno (sin importar fecha)
            if ($product['type'] === ProductTypes::ALL_DAYS->value) {
                if (
                    ($item['type'] ?? null) === ProductTypes::ALL_DAYS->value &&
                    $item['id'] == $product['id'] &&
                    $item['student']['id'] == $product['student']['id']
                ) {
                    $status = 'error';
                    break;
                }
            }
        }

        // Lógica de cantidad para FOOD (máximo 6 unidades del mismo plato por alumno y fecha)
        $settings = new GeneralSettings();
        $limit = $settings->limit_product_per_student;

        if ($status === 'success' && $product['type'] === ProductTypes::FOOD->value) {
            if (!is_null($existingFoodIndex)) {
                $currentQty = $items[$existingFoodIndex]['quantity'] ?? 1;
                $newQty = $currentQty + $quantity;

                if ($newQty > $limit) {
                    $status = 'error';
                } else {
                    $items[$existingFoodIndex]['quantity'] = $newQty;
                    $items[$existingFoodIndex]['sub_total'] = round($items[$existingFoodIndex]['price'] * $newQty, 2);
                }
            } else {
                $product['quantity'] = min($quantity, $limit);

                if ($product['quantity'] < 1) {
                    $status = 'error';
                } else {
                    $product['sub_total'] = $product['price'] * $quantity;
                    $items[] = $product;
                }
            }
        }

        // Para ALL_DAYS solo se agrega si no entró en error por duplicado
        if ($status === 'success' && $product['type'] === ProductTypes::ALL_DAYS->value) {
            $product['quantity'] = $quantity;
            $product['sub_total'] = $product['price'];
            $items[] = $product;
        }

        // Calculamos el total de ítems
        $total_items = 0;
        foreach ($items as $item) {
            $total_items += $item['quantity'] ?? 1;
        }

        // 5. Si no hay error, actualizar el carrito
        if ($status === 'success') {
            $cart->update([
                'items'       => $items,
                'total_items' => $total_items,
            ]);
        }

        CalculateTotals::run($cart);

        return [
            'items' => $items,
            'status' => $status,
            'token' => $token
        ];
    }

    public static function run(...$args) {
        return app(static::class)(...$args);
    }


}
