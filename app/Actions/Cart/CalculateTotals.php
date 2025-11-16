<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Settings\GeneralSettings;

class CalculateTotals {

    public function __invoke(Cart $cart, $credits = 0, $update = true) {
        $sub_total = 0;
        $discount = 0;
        $processing_fee = 0;
        $total = 0;

        $items = $cart['items'] ?? [];
        if (count($items) > 0) {
            foreach ($items as $item) {
                $sub_total += $item['price'];
            }
        }

        $general_settings = new GeneralSettings();
        if ($general_settings->processing_fee) {
            $processing_fee = round($sub_total * ($general_settings->processing_fee / 100), 2);
        }

        $total = $sub_total + $processing_fee - $discount;

        if ($update) {
            $cart->update([
                'sub_total' => $sub_total,
                'discount' => $discount,
                'processing_fee' => $processing_fee,
                'total' => $total
            ]);
        }

    }

    public static function run(...$args) {
        return app(static::class)(...$args);
    }

}
