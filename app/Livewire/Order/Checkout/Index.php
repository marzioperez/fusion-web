<?php

namespace App\Livewire\Order\Checkout;

use App\Enums\Status;
use App\Models\Cart;
use App\Models\Order;
use App\Settings\GeneralSettings;
use App\Jobs\ProcessOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class Index extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    public Cart $cart;
    public $token;
    public $sub_total = 0, $total = 0, $processing_fee = 0;

    public $credits = 0;
    public $use_credits = false;
    public $credits_applied = 0;
    public $credits_remaining = 0;

    public $current_step = 1;

    public function mount() {
        $token = session()->get('cart-token');
        if ($token) {
            $this->token = $token;
            $this->load_cart();
        }
    }

    #[On('toggle-use-credits')]
    public function apply_credits($enabled) {
        $this->use_credits = $enabled;
        $this->load_cart();
    }

    #[On('cart-updated')]
    public function load_cart():void {
        $cart = Cart::where('token', $this->token)->where('status', Status::PENDING->value)->get()->last();
        if ($cart) {
            $this->cart = $cart;
            if ($this->use_credits) {
                $user = auth()->user();
                $settings = new GeneralSettings();
                $fee = $settings->processing_fee;

                $this->sub_total = $cart->sub_total;
                $this->credits = $user['credits'] ?? 0;

                if ($this->use_credits && $this->credits > 0) {
                    $this->credits_applied = min($this->credits, $this->sub_total);
                    $this->credits_remaining = $this->credits - $this->credits_applied;

                    $sub_total = $this->sub_total - $this->credits_applied;

                    if ($sub_total <= 0) {
                        // No hay fee y el total es 0
                        $this->processing_fee = 0;
                        $this->total = 0;
                        return;
                    }
                    $this->processing_fee = round(($sub_total * ($fee / 100)), 2);
                    $this->total = $sub_total + $this->processing_fee;
                } else {
                    $this->credits_applied = 0;
                    $this->credits_remaining = $this->credits;
                    $this->processing_fee = $cart->processing_fee;
                    $this->total = $cart->total;
                }
            } else {
                $this->sub_total = $cart->sub_total;
                $this->credits = 0;
                $this->processing_fee = $cart->processing_fee;
                $this->total = $cart->total;
            }
        }
    }

    #[On('update-step')]
    public function update_step($step): void {
        $this->current_step = $step;
    }

    #[On('process-cart')]
    public function process(): void {
        $user = auth()->user();

        // Monto mínimo que acepta Stripe
        $minStripeAmount = 0.50;

        if ($this->total < $minStripeAmount) {
            $orderCode = null;
            DB::transaction(function () use ($user, &$orderCode) {
                // Obtenemos el número de la última orden creada
                $number = 1;
                $last_order = Order::select(["number"])->orderBy("id", "DESC")->first();
                if ($last_order) {
                    $number = $last_order->number + 1;
                }

                // Creamos el pedido por defecto como pendiente, sin fee ni total porque es solo créditos
                $order = Order::create([
                    'cart_id' => $this->cart['id'],
                    'code' => 'FSL-' . $number,
                    'number' => $number,

                    'user_id' => $user['id'],
                    'phone' => $user['phone'],
                    'email' => $user['email'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],

                    'sub_total' => $this->sub_total,
                    'credits' => $this->credits_applied,
                    'processing_fee' => 0,
                    'total' => 0,
                ]);

                foreach ($this->cart['items'] as $item) {
                    $student_name = null;
                    if (isset($item['student'])) {
                        $student_name = $item['student']['first_name'] . ' ' . $item['student']['last_name'];
                    }
                    $order->items()->create([
                        'product_id' => $item['product_id'] ?? null,
                        'name' => $item['name'],
                        'label' => $item['label'] ?? null,
                        'student_id' => (isset($item['student']) ? $item['student']['id'] : null),
                        'student_name' => $student_name,
                        'image_url' => $item['image_url'] ?? null,
                        'type' => $item['type'],
                        'menu_entry_id' => $item['id'] ?? null,
                        'date' => $item['date'] ?? null,
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'total' => $item['sub_total'],
                        'data' => ($item['items'] ?? null)
                    ]);
                }

                $orderCode = $order['code'];
            });
            ProcessOrder::dispatch($orderCode);
            $this->redirect(route('order.thank-you', ['order' => $orderCode]));
            return;
        }

        DB::transaction(function () use ($user) {
            // Obtenemos el número de la última orden creada
            $number = 1;
            $last_order = Order::select(["number"])->orderBy("id", "DESC")->first();
            if ($last_order) {
                $number = $last_order->number + 1;
            }

            // Creamos el pedido por defecto como pendiente
            $order = Order::create([
                'cart_id' => $this->cart['id'],
                'code' => 'FSL-' . $number,
                'number' => $number,

                'user_id' => $user['id'],
                'phone' => $user['phone'],
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],

                'sub_total' => $this->sub_total,
                'credits' => $this->credits_applied,
                'processing_fee' => $this->processing_fee,
                'total' => $this->total,
            ]);

            foreach ($this->cart['items'] as $item) {
                $student_name = null;
                if (isset($item['student'])) {
                    $student_name = $item['student']['first_name'] . ' ' . $item['student']['last_name'];
                }
                $order->items()->create([
                    'product_id' => $item['product_id'] ?? null,
                    'name' => $item['name'],
                    'label' => $item['label'] ?? null,
                    'student_id' => (isset($item['student']) ? $item['student']['id'] : null),
                    'student_name' => $student_name,
                    'image_url' => $item['image_url'] ?? null,
                    'type' => $item['type'],
                    'menu_entry_id' => $item['id'] ?? null,
                    'date' => $item['date'] ?? null,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['sub_total'],
                    'data' => ($item['items'] ?? null)
                ]);
            }

            // 2) Crear PaymentIntent en Stripe
            Stripe::setApiKey(config('services.stripe.secret'));
            $intent = PaymentIntent::create([
                'amount' => (int) round($this->total * 100),
                'currency' => 'usd',
                'metadata' => [
                    'order_id' => $order['code'],
                    'user_id' => $user['id']
                ]
            ]);

            $order->update(['stripe_payment_intent_id' => $intent->id]);

            // 3) Abrir modal en el front con el client_secret
            $this->dispatch('open-stripe-modal', clientSecret: $intent->client_secret, orderId: $order['code']);
        });
    }

    public function render() {
        return view('livewire.order.checkout.index')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
