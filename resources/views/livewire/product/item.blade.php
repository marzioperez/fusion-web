<div class="product-item">
    <div class="calendar-first-detail">
        <div class="item"></div>
        <div class="item"></div>
    </div>
    <div class="calendar-second-detail">
        <div class="item"></div>
        <div class="item"></div>
    </div>
    <div class="header">
        <p>{{$product['label']}}</p>
    </div>
    <div class="body">
        <img src="{{$product['image_url']}}" class="w-full" alt="{{$product['name']}}" />
        <div class="content">
            <p class="font-semibold text-center">{{$product['name']}}</p>
            <p class="font-semibold text-center">${{$product['price']}}</p>
            <div class="flex justify-center">
                <button type="button" class="btn btn-md btn-secondary !min-w-[150px]" wire:loading.attr="disabled" wire:click.prevent="add_to_cart">
                    <span wire:loading.remove wire:target="add_to_cart">Add to cart</span>
                    <svg x="0px" y="0px" viewBox="0 0 30 30" class="fill-white mx-auto h-5 w-5 animate-spin" wire:loading wire:target="add_to_cart">
                        <path d="M 15 3 C 8.9134751 3 3.87999 7.5533546 3.1132812 13.439453 A 1.0001 1.0001 0 1 0 5.0957031 13.697266 C 5.7349943 8.7893639 9.9085249 5 15 5 C 17.766872 5 20.250574 6.1285473 22.058594 7.9414062 L 20 10 L 26 11 L 25 5 L 23.470703 6.5292969 C 21.300701 4.3575454 18.309289 3 15 3 z M 25.912109 15.417969 A 1.0001 1.0001 0 0 0 24.904297 16.302734 C 24.265006 21.210636 20.091475 25 15 25 C 11.977904 25 9.2987537 23.65024 7.4648438 21.535156 L 9 20 L 3 19 L 4 25 L 6.0488281 22.951172 C 8.2452659 25.422716 11.436061 27 15 27 C 21.086525 27 26.12001 22.446646 26.886719 16.560547 A 1.0001 1.0001 0 0 0 25.912109 15.417969 z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
