<div class="space-y-4">
    <h5 class="text-xl font-semibold">Resumen de tu pedido</h5>

    <div class="bg-white shadow rounded-lg p-4 space-y-3">
        @forelse ($items as $item)
            <div class="flex justify-between text-sm border-b border-b-gray-300 last:border-0 pb-2">
                <div>
                    <div class="font-medium">{{ $item['name'] ?? 'Producto' }}</div>
                    <div class="text-gray-500">x{{ $item['quantity'] ?? 1 }}</div>
                </div>
                <div class="font-semibold">
                    ${{ number_format(($item['price'] ?? 0), 2) }}
                </div>
            </div>
        @empty
            <p class="text-gray-500">Tu carrito está vacío.</p>
        @endforelse
    </div>

    <div class="space-y-2">
        <div class="flex justify-between items-center">
            <span>Subtotal:</span>
            <span class="text-lg">${{ number_format($sub_total, 2) }}</span>
        </div>

        <div class="flex justify-between items-center">
            <span>Fee:</span>
            <span class="text-lg">${{ number_format($processing_fee, 2) }}</span>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-lg font-semibold">Total:</span>
            <span class="text-2xl font-bold">${{ number_format($total, 2) }}</span>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button
            type="button"
            wire:click="goToStep2"
            class="px-6 py-2 rounded-md bg-green-600 text-white font-semibold hover:bg-green-700"
        >
            Continuar con el pago
        </button>
    </div>
</div>
