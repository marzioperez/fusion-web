<div class="container py-12" x-data="{ current_step: 3}">
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

        <div class="col-span-full">
            @dump($model->toArray())
        </div>
    </div>
</div>
