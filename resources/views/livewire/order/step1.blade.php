<div class="space-y-4">
    <h5>Verify your products</h5>
    <div class="space-y-3">
        <div class="grid grid-cols-12 border-b-2 border-gray-200 pb-2 px-2 gap-6">
            <div class="col-span-2">
                <p class="font-bold text-primary text-sm">Product</p>
            </div>
            <div class="sm:col-span-10 col-span-8 grid grid-cols-12 gap-6">
                <div class="col-span-5 sm:block hidden"></div>
                <div class="col-span-2 sm:block hidden text-center">
                    <p class="font-bold text-primary text-sm">Price</p>
                </div>
                <div class="col-span-2 sm:block hidden text-center">
                    <p class="font-bold text-primary text-sm">Quantity</p>
                </div>
                <div class="sm:col-span-2 col-span-10 text-end">
                    <p class="font-bold text-primary text-sm">Subtotal</p>
                </div>
                <div class="sm:hidden block"></div>
            </div>
        </div>

        @forelse ($items as $i => $item)
            <livewire:order.checkout.item :item="$item" :index="$i" :token="$token" wire:key="{{$i . time()}}" />
        @empty
            <p class="text-gray-500 text-center">Your cart is empty.</p>
        @endforelse
    </div>

    <div class="mt-6 flex justify-end">
        <button type="button" wire:click="goToStep2" class="btn btn-lg btn-primary">
            Continuar con el pago
        </button>
    </div>
</div>
