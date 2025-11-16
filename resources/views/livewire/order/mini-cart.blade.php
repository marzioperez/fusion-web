<div x-data="{ open: false }" x-cloak>
    <div x-show="open" x-transition.opacity @click="open = false; $dispatch('toggle-scroll');" class="fixed inset-0 z-40 bg-black/40"></div>

    <aside x-show="open" class="mini-cart"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full">

        <div class="header">
            <h5>Tu carrito</h5>
            <button @click="open = false; $dispatch('toggle-scroll');" class="text-gray-500 hover:text-gray-700 cursor-pointer">✕</button>
        </div>

        <div class="body">
            @if(count($items) > 0)
                @foreach($items as $i => $item)
                    <div class="flex space-x-3">
                        <div class="grid grid-cols-12 gap-3">
                            <div class="col-span-5">
                                <img src="{{$item['image_url']}}" alt="" class="w-full h-32 object-cover object-center" />
                            </div>
                            <div class="col-span-7 flex items-center">
                                <div class="space-y-1">
                                    <p class="font-semibold">{{$item['name']}}</p>
                                    <p class="text-sm">{{$item['student']['first_name']}} {{$item['student']['last_name']}}</p>
                                    <p class="text-sm">{{$item['label']}}</p>
                                    <p class="font-medium">${{$item['price']}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <button type="button" class="cursor-pointer" wire:click.prevent="removeItem({{ $i }});">
                                <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M22 5a1 1 0 0 1-1 1H3a1 1 0 0 1 0-2h5V3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h5a1 1 0 0 1 1 1zM4.934 21.071 4 8h16l-.934 13.071a1 1 0 0 1-1 .929H5.931a1 1 0 0 1-.997-.929zM15 18a1 1 0 0 0 2 0v-6a1 1 0 0 0-2 0zm-4 0a1 1 0 0 0 2 0v-6a1 1 0 0 0-2 0zm-4 0a1 1 0 0 0 2 0v-6a1 1 0 0 0-2 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-500">Your cart is empty</p>
            @endif
        </div>

        <div class="footer">
            <a href="{{route('order.check-out')}}" wire:navigate class="!w-full btn btn-lg btn-primary">Checkout</a>
        </div>
    </aside>

    <div class="cart-counter" :class="open ? 'active' : ''" @click="open = !open; $dispatch('toggle-scroll');">
        <span class="count">{{ $cart_count }}</span>
        <svg viewBox="0 0 128 128" xml:space="preserve">
            <g id="_x31_3_1_">
                <path class="st2" d="M125.1 43.6h-20.4V17.5H84.4v-2.9H46.5v2.9H26.2v26.2H2.9C1.3 43.7 0 45 0 46.6v8.7c0 1.6 1.3 2.9 2.9 2.9h122.2c1.6 0 2.9-1.3 2.9-2.9v-8.7c0-1.7-1.3-3-2.9-3zm-26.2 0H32V23.3h14.5v2.9h37.8v-2.9h14.5v20.3zm-78.5 64c0 3.2 2.6 5.8 5.8 5.8h72.7c3.2 0 5.8-2.6 5.8-5.8l14.5-46.5H8.7l11.7 46.5zm61.1-36.3c0-5 8.7-5 8.7 0v29.1c0 5-8.7 5-8.7 0V71.3zm-23.3 0c0-5 8.7-5 8.7 0v29.1c0 5-8.7 5-8.7 0V71.3zm-23.3 0c0-5 8.7-5 8.7 0v29.1c0 5-8.7 5-8.7 0V71.3z" id="icon_2_"/>
            </g>
        </svg>
    </div>
</div>
