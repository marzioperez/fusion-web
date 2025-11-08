<div class="relative space-y-6"
     x-data="{ current_step: @entangle('step')}"
     x-on:set-token-url.window="window.history.replaceState(null, null, '?token=' + $event.detail.token);">

    <nav class="flex items-center justify-center">
        <p class="text-sm font-medium">Step <span x-text="current_step"></span> of 2</p>
        <ol class="ml-8 flex items-center space-x-5">
            <li>
                <div class="relative flex items-center justify-center">
                    <span class="absolute flex size-5 p-px" x-show="current_step == 1">
                        <span class="size-full rounded-full bg-primary/30"></span>
                    </span>
                    <span class="relative block size-2.5 rounded-full" :class="current_step <= 2 ? 'bg-primary' : 'bg-gray-300'"></span>
                    <span class="sr-only">Step 1</span>
                </div>
            </li>
            <li>
                <div class="relative flex items-center justify-center">
                    <span class="absolute flex size-5 p-px" x-show="current_step == 2">
                        <span class="size-full rounded-full bg-primary/30"></span>
                    </span>
                    <span class="relative block size-2.5 rounded-full" :class="current_step == 2 ? 'bg-primary' : 'bg-gray-300'"></span>
                    <span class="sr-only">Step 3</span>
                </div>
            </li>
        </ol>
    </nav>

    <div :class="(current_step == 1 ? 'block' : 'hidden')">
        <livewire:auth.register.form />
    </div>

    <div :class="(current_step == 2 ? 'block' : 'hidden')">
        <livewire:auth.register.children.index />
    </div>
</div>
