<?php

namespace App\Actions\Cart;

use App\Enums\Status;
use App\Models\Cart;

class RemoveItem {

    public function __invoke($token, $index) {
        $cart = Cart::where('token', $token)
            ->where('status', Status::PENDING->value)
            ->latest()
            ->first();

        $items = [];
        if (count($cart->items) > 0) {
            foreach ($cart->items as $key => $item) {
                if ($key != $index) {
                    $items[] = $item;
                }
            }
        }
        $cart->update([
            'items' => $items,
            'total_items' => count($items)
        ]);
        return ['items' => $items];
    }

    public static function run(...$args) {
        return app(static::class)(...$args);
    }

}
