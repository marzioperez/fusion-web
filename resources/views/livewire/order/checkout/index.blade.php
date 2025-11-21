<div class="container py-12" x-data="{ current_step: @entangle('current_step')}">
    <div class="md:grid grid-cols-12 gap-6 space-y-6">
        <div class="col-span-full">
            <nav class="flex items-center">
                <p class="text-sm font-medium">Step <span x-text="current_step"></span> of 3</p>
                <ol class="ml-8 flex items-center space-x-5">
                    <li>
                        <div class="relative flex items-center justify-center">
                            <span class="absolute flex size-5 p-px" x-show="current_step == 1">
                                <span class="size-full rounded-full bg-primary/30"></span>
                            </span>
                            <span class="relative block size-2.5 rounded-full" :class="current_step <= 3 ? 'bg-primary' : 'bg-gray-300'"></span>
                            <span class="sr-only">Step 1</span>
                        </div>
                    </li>
                    <li>
                        <div class="relative flex items-center justify-center">
                            <span class="absolute flex size-5 p-px" x-show="current_step == 2">
                                <span class="size-full rounded-full bg-primary/30"></span>
                            </span>
                            <span class="relative block size-2.5 rounded-full" :class="current_step >= 2 ? 'bg-primary' : 'bg-gray-300'"></span>
                            <span class="sr-only">Step 2</span>
                        </div>
                    </li>
                    <li>
                        <div class="relative flex items-center justify-center">
                            <span class="absolute flex size-5 p-px" x-show="current_step == 3">
                                <span class="size-full rounded-full bg-primary/30"></span>
                            </span>
                            <span class="relative block size-2.5 rounded-full" :class="current_step >= 3 ? 'bg-primary' : 'bg-gray-300'"></span>
                            <span class="sr-only">Step 3</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="col-span-8 space-y-6">
            <div :class="current_step == 1 ? 'block' : 'hidden'">
                @livewire('order.step1')
            </div>
            <div :class="current_step == 2 ? 'block space-y-3' : 'hidden'">
                @livewire('order.step2')
                @if ($use_credits && $credits_applied == $sub_total && $credits_remaining > 0)
                    <div class="p-3 bg-amber-100 rounded-2xl">
                        <p class="text-amber-900 text-sm">
                            De tus créditos disponibles <b>(${{ number_format($credits, 2) }})</b>,
                            solo se descontarán <b>${{ number_format($credits_applied, 2) }}</b> para cubrir este pedido.
                            El saldo restante de <b>${{ number_format($credits_remaining, 2) }}</b> permanecerá en tu cuenta.
                        </p>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-span-4">
            <div class="rounded-xl shadow-md p-6 bg-white space-y-6">
                <div class="border-b border-gray-300 border-dashed pb-2">
                    <h4 class="text-primary-dark">Resume</h4>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span>Subtotal:</span>
                        <span class="text-lg">${{ number_format($sub_total, 2) }}</span>
                    </div>

                    @if($credits > 0)
                        <div class="flex justify-between items-center">
                            <span>Apply credits:</span>
                            <span class="text-lg text-primary-dark">-${{ number_format($credits, 2) }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <span>Processing Fee/Delivery:</span>
                        <span class="text-lg">${{ number_format($processing_fee, 2) }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold">Total:</span>
                        <span class="text-2xl font-bold">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-data="stripeCheckoutModal('{{ config('services.stripe.key') }}')"
        x-on:open-stripe-modal.window="open($event.detail)"
    >
        <template x-if="isOpen">
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6" @click.stop>
                    <div class="flex items-center justify-between mb-4">
                        <h4>Pay with card</h4>
                        <button type="button" class="text-gray-500 hover:text-gray-700" @click="close()" x-bind:disabled="loading">✕</button>
                    </div>

                    {{-- Mensaje de error --}}
                    <template x-if="error">
                        <div class="mb-3 text-sm text-red-600" x-text="error"></div>
                    </template>

                    {{-- Elementos de tarjeta de Stripe --}}
                    <div class="space-y-3 mb-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Card number</label>
                            <div id="card-number-element" class="border rounded-md p-3"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium mb-1">Expiry date</label>
                                <div id="card-expiry-element" class="border rounded-md p-3"></div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">CVC</label>
                                <div id="card-cvc-element" class="border rounded-md p-3"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Botón de pagar --}}
                    <button type="button" class="w-full py-2 rounded-md bg-primary text-white font-semibold disabled:opacity-60" @click="submit()" x-bind:disabled="loading">
                        <span x-show="!loading">Confirm payment</span>
                        <span x-show="loading">Processing...</span>
                    </button>
                </div>
            </div>
        </template>
    </div>
</div>
