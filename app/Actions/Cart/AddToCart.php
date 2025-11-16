<?php

namespace App\Actions\Cart;

use App\Enums\ProductTypes;
use App\Enums\Status;
use App\Models\Cart;
use Illuminate\Support\Str;

class AddToCart {

    public function __invoke($token, $product, $quantity = 1) {
        // 2. Buscar carrito con ese token
        $cart = Cart::where('token', $token)
            ->where('status', Status::PENDING->value)
            ->latest()
            ->first();

        // 3. Si no existe, crearlo
        if (! $cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'token'   => $token,
                'status'  => Status::PENDING->value,
                'items'   => [],
            ]);
        }

        // 4. Trabajar siempre sobre el array de items
        $items = $cart->items ?? [];

        $status = 'success';
        foreach($items as $item) {
            // Regla para FOOD: mismo producto, mismo alumno, misma fecha
            if ($product['type'] === ProductTypes::FOOD->value) {
                if (
                    ($item['type'] ?? null) === ProductTypes::FOOD->value &&
                    $item['id'] == $product['id'] &&
                    $item['student']['id'] == $product['student']['id'] &&
                    $item['date'] == $product['date']
                ) {
                    $status = 'error';
                    break;
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

        // 5. Si no hay duplicado, agregar el producto
        if ($status === 'success') {
            $items[] = $product;
            $cart->update([
                'items' => $items,
                'total_items' => count($items)
            ]);
        }

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
