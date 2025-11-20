<?php

namespace App\Http\Controllers\Stripe;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Mail\Order\OrderPaid;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Webhook;
use function Termwind\render;

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
            $order_id = $intent->metadata->order_id ?? null;

            DB::transaction(function () use ($order_id, $payment_intent_id) {
                $order = Order::lockForUpdate()
                    ->where('code', $order_id)
                    ->orWhere('stripe_payment_intent_id', $payment_intent_id)
                    ->first();

                if (!$order || $order->payment_status === Status::FINISHED->value) {
                    return;
                }

                $order->update([
                    'status' => Status::FINISHED->value,
                    'payment_status' => Status::FINISHED->value,
                ]);

                $detail = $order->items;
                foreach ($detail as $item) {
                    
                }

                $user = $order->user;
                Mail::to($user['email'])->send(new OrderPaid($order, $user));

            });
        }
        return response('OK', 200);
    }

}
