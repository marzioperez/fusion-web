<?php

namespace App\Http\Controllers\Stripe;

use App\Enums\ProductTypes;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessOrder;
use App\Mail\Order\OrderPaid;
use App\Models\MenuEntry;
use App\Models\Order;
use App\Models\ScheduleEntryMenu;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

            ProcessOrder::dispatch($order_id, $payment_intent_id);
        }
        return response('OK', 200);
    }

}
