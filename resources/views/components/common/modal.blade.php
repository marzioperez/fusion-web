@props(['name', 'type' => 'default', 'bg' => 'white', 'classes' => '', 'body_classes' => ''])
<div class="relative z-50"
    x-data="{show : false, name : '{{$name}}'}"
    x-show="show"
    x-on:open-modal.window="show = ($event.detail.name === name); $dispatch('disable-scroll');"
    x-on:close-modal.window="show = false; $dispatch('enable-scroll');"
    x-on:keydown.escape.window="show = false; $dispatch('enable-scroll');"
    style="display:none;">

    <div class="modal-overlay"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <div class="modal {{$classes}}">
        <div class="modal-wrapper relative">
            @if($type === 'default')
                <div x-show="show" class="modal-body bg-{{$bg}} relative {{$body_classes}}" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    {{$body}}
                </div>
            @endif
            @if($type === 'video')
                <div x-show="show"  class="max-w-4xl w-full relative"  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <button @click="show = false; $dispatch('enable-scroll')" class="absolute top-0 right-0 mt-4 mr-4 text-white hover:text-gray-200 z-10">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    {{$body}}
                </div>
            @endif
        </div>
    </div>
</div>

