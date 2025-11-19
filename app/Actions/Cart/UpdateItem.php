<?php

namespace App\Actions\Cart;

use App\Enums\Status;
use App\Models\Cart;

class UpdateItem {

    public function __invoke($token, $index, $quantity) {
        $cart = Cart::where('token', $token)
            ->where('status', Status::PENDING->value)
            ->latest()
            ->first();

        $items = $cart->items;

        if (count($items) > 0) {
            foreach ($items as $key => $item) {
                if ($key == $index) {
                    $item['quantity'] = $quantity;
                    $item['sub_total'] = round($item['price'] * $quantity, 2);
                }
                $items[$key] = $item;
            }
        }

        $total_items = 0;
        foreach ($items as $item) {
            $total_items += $item['quantity'] ?? 1;
        }

        $cart->update([
            'items' => $items,
            'total_items' => $total_items
        ]);

        CalculateTotals::run($cart);

        return ['items' => $items];
    }

    public static function run(...$args) {
        return app(static::class)(...$args);
    }

}
