<div class="space-y-4">
    <h5 class="text-xl font-semibold">Forma de pago</h5>

    <div class="bg-white shadow rounded-lg p-4 space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <div class="font-medium">Créditos disponibles</div>
                <div class="text-gray-500 text-sm">
                    Puedes usarlos para reducir el total de tu compra.
                </div>
            </div>
            <div class="text-right">
                <div class="font-semibold">
                    ${{ number_format($useCredits, 2) }}
                </div>
                <label class="inline-flex items-center mt-1 gap-2 text-sm">
                    <input type="checkbox" wire:model.live="useCredits" class="rounded">
                    <span>Usar mis créditos</span>
                </label>
            </div>
        </div>

        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span>Subtotal carrito</span>
                <span>${{ number_format($sub_total, 2) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Créditos aplicados</span>
                <span class="text-green-600">
                    - ${{ number_format($credits_to_apply, 2) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Subtotal después de créditos</span>
                <span>S/ {{ number_format(max($subtotal_after_credits, 0), 2) }}</span>
            </div>

            @if ($amount_to_charge > 0)
                <div class="flex justify-between">
                    <span>Fee (4.8%)</span>
                    <span>${{ number_format($fee / 100, 2) }}</span>
                </div>

                <div class="flex justify-between font-semibold text-lg pt-2 border-t">
                    <span>Total a pagar con tarjeta (Stripe)</span>
                    <span>${{ number_format($amount_to_charge / 100, 2) }}</span>
                </div>
            @else
                <div class="mt-2 text-green-700 font-semibold">
                    El total se cubre completamente con tus créditos. No se realizará pago con tarjeta.
                </div>
            @endif
        </div>

        <div class="mt-6 flex justify-between">
            <button type="button" wire:click="$dispatch('checkout-go-to-step', { step: 1 })" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 text-sm">
                Volver al resumen
            </button>

            <button type="button" wire:click="pay" class="px-6 py-2 rounded-md bg-green-600 text-white font-semibold hover:bg-green-700">
                @if ($amount_to_charge > 0)
                    Pagar ahora con Stripe
                @else
                    Confirmar pago con créditos
                @endif
            </button>
        </div>
    </div>
</div>
