<header class="{{$header_position}}"
        x-data="{scrolled: false}"
        x-init="window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 30;
        })" :class="(scrolled ? 'active-scroll' : '')">
    <div class="container">
        <div class="content-header">
            <div class="grid grid-cols-12 items-center gap-6">
                <div class="md:col-span-3 col-span-5">
                    <a href="{{config('app.url')}}" wire:navigate>
                        <img src="{{$logo}}" alt="{{config('app.name')}}" class="logo" />
                    </a>
                </div>
                <div class="md:col-span-6 col-span-5">
                    <div class="md:flex items-center justify-center lg:space-x-6 md:space-x-3 hidden">
                        @foreach($menu as $item)
                            <div>
                                <a href="{{$item['url']}}" class="font-medium" @if($item['open_in_new_window']) target="_blank" @else wire:navigate @endif>{{$item['name']}}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="md:col-span-3 col-span-2">
                    <div class="flex justify-end items-center space-x-3">
                        @if($logged_in)
                            <div class="space-x-3 flex items-center justify-end">
                                <a href="#" class="btn btn-md btn-secondary">¡Start shopping!</a>

                                <div x-data="Components.menu({ open: false })" x-init="init()" @keydown.escape.stop="open = false; focusButton()" @click.away="onClickAway($event)" class="relative cursor-pointer">
                                    <div x-on:click.prevent="onButtonClick()" @keyup.space.prevent="onButtonEnter()" @keydown.enter.prevent="onButtonEnter()" aria-expanded="false" aria-haspopup="true" x-bind:aria-expanded="open.toString()" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()">
                                        <svg class="h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-secondary" d="M12 4C13.0609 4 14.0783 4.42143 14.8284 5.17157C15.5786 5.92172 16 6.93913 16 8C16 9.06087 15.5786 10.0783 14.8284 10.8284C14.0783 11.5786 13.0609 12 12 12C10.9391 12 9.92172 11.5786 9.17157 10.8284C8.42143 10.0783 8 9.06087 8 8C8 6.93913 8.42143 5.92172 9.17157 5.17157C9.92172 4.42143 10.9391 4 12 4ZM12 14C16.42 14 20 15.79 20 18V20H4V18C4 15.79 7.58 14 12 14Z"/>
                                        </svg>
                                    </div>

                                    <div x-show="open" class="user-dropdown"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         x-ref="menu-items"
                                         x-description="Dropdown menu, show/hide based on menu state."
                                         x-bind:aria-activedescendant="activeDescendant" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()" @keydown.tab="open = false" @keydown.enter.prevent="open = false; focusButton()" @keyup.space.prevent="open = false; focusButton()" style="display: none;">
                                        <a href="{{route('customer.account')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">My account</a>
                                        <a href="#" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Students</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" wire:click.prevent="logout">Log out</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <button type="button" @click.prevent="$wire.storeIntendedUrl(window.location.href, '{{route('page', ['slug' => 'login'])}}')" class="btn btn-lg btn-primary">Login</button>
                            <div class="md:block hidden">or</div>
                            <button type="button" @click.prevent="$wire.storeIntendedUrl(window.location.href, '{{route('page', ['slug' => 'register'])}}')" class="btn btn-lg btn-secondary md:block hidden">Register</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
