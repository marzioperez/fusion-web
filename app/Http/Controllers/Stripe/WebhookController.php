<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;

class WebhookController extends Controller {

    public function handle(Request $request) {
        $payload = $request->getContent();
        $signHeader = $request->server('HTTP_STRIPE_SIGNATURE');
        $secret = config('services.stripe.webhook_secret');
        try {
            $event = Webhook::constructEvent($payload, $signHeader, $secret);
        } catch (\Exception $e) {
            Log::channel('stripe-webhook')->error('Stripe webhook error: ' . $e->getMessage());
            return response('Invalid payload', 400);
        }

        if ($event->type == 'payment_intent.succeeded') {
            $intent = $event->data->object;
            $payment_intent_id = $intent->id;
            $order_code = $intent->metadata->order_id ?? null;

            $order = Order::lockForUpdate()
                ->where('code', $order_code)
                ->orWhere('stripe_payment_intent_id', $payment_intent_id)
                ->first();

            if ($order) {
                ProcessOrder::dispatch($order['code']);
            }
        }
        return response('OK', 200);
    }

}
