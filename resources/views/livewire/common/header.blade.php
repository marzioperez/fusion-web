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
                        <img src="{{$logo}}" alt="{{config('app.name')}}" class="w-full" />
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
                                <div x-data="Components.menu({ open: false })" x-init="init()" @keydown.escape.stop="open = false; focusButton()" @click.away="onClickAway($event)" class="relative cursor-pointer">
                                    <div x-on:click.prevent="onButtonClick()" @keyup.space.prevent="onButtonEnter()" @keydown.enter.prevent="onButtonEnter()" aria-expanded="false" aria-haspopup="true" x-bind:aria-expanded="open.toString()" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 4C13.0609 4 14.0783 4.42143 14.8284 5.17157C15.5786 5.92172 16 6.93913 16 8C16 9.06087 15.5786 10.0783 14.8284 10.8284C14.0783 11.5786 13.0609 12 12 12C10.9391 12 9.92172 11.5786 9.17157 10.8284C8.42143 10.0783 8 9.06087 8 8C8 6.93913 8.42143 5.92172 9.17157 5.17157C9.92172 4.42143 10.9391 4 12 4ZM12 14C16.42 14 20 15.79 20 18V20H4V18C4 15.79 7.58 14 12 14Z" fill="#63C800"/>
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
                                        <a href="#" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Mi cuenta</a>
                                        <a href="#" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Mis compras</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" wire:click.prevent="logout">Salir</a>
                                    </div>
                                </div>
                                <div>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 18C15.89 18 15 18.89 15 20C15 20.5304 15.2107 21.0391 15.5858 21.4142C15.9609 21.7893 16.4696 22 17 22C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20C19 19.4696 18.7893 18.9609 18.4142 18.5858C18.0391 18.2107 17.5304 18 17 18ZM1 2V4H3L6.6 11.59L5.24 14.04C5.09 14.32 5 14.65 5 15C5 15.5304 5.21071 16.0391 5.58579 16.4142C5.96086 16.7893 6.46957 17 7 17H19V15H7.42C7.3537 15 7.29011 14.9737 7.24322 14.9268C7.19634 14.8799 7.17 14.8163 7.17 14.75C7.17 14.7 7.18 14.66 7.2 14.63L8.1 13H15.55C16.3 13 16.96 12.58 17.3 11.97L20.88 5.5C20.95 5.34 21 5.17 21 5C21 4.73478 20.8946 4.48043 20.7071 4.29289C20.5196 4.10536 20.2652 4 20 4H5.21L4.27 2M7 18C5.89 18 5 18.89 5 20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22C7.53043 22 8.03914 21.7893 8.41421 21.4142C8.78929 21.0391 9 20.5304 9 20C9 19.4696 8.78929 18.9609 8.41421 18.5858C8.03914 18.2107 7.53043 18 7 18Z" fill="#63C800"/>
                                    </svg>
                                </div>
                                <div>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21L10.55 19.7248C8.86667 18.2371 7.475 16.9537 6.375 15.8747C5.275 14.7956 4.4 13.827 3.75 12.9687C3.1 12.1104 2.64583 11.3215 2.3875 10.6022C2.12917 9.88283 2 9.14714 2 8.3951C2 6.85831 2.525 5.57493 3.575 4.54496C4.625 3.51499 5.93333 3 7.5 3C8.36667 3 9.19167 3.17984 9.975 3.53951C10.7583 3.89918 11.4333 4.40599 12 5.05995C12.5667 4.40599 13.2417 3.89918 14.025 3.53951C14.8083 3.17984 15.6333 3 16.5 3C18.0667 3 19.375 3.51499 20.425 4.54496C21.475 5.57493 22 6.85831 22 8.3951C22 9.14714 21.8708 9.88283 21.6125 10.6022C21.3542 11.3215 20.9 12.1104 20.25 12.9687C19.6 13.827 18.725 14.7956 17.625 15.8747C16.525 16.9537 15.1333 18.2371 13.45 19.7248L12 21Z" fill="#63C800"/>
                                    </svg>
                                </div>
                            </div>
                        @else
                            <a href="{{route('page', ['slug' => 'login'])}}" class="btn btn-lg btn-primary" wire:navigate>Login</a>
                            <div class="md:block hidden">or</div>
                            <a href="{{route('page', ['slug' => 'register'])}}" class="btn btn-lg btn-secondary md:block hidden" wire:navigate>Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
