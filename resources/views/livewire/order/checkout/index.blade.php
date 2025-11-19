<div class="container py-12" x-data="{ current_step: @entangle('current_step')}">
    <div class="md:grid grid-cols-12 gap-6 space-y-6">
        <div class="col-span-full">
            <nav class="flex items-center">
                <p class="text-sm font-medium">Step <span x-text="current_step"></span> of 2</p>
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
                </ol>
            </nav>
        </div>

        <div class="col-span-8 space-y-6">
            <div :class="current_step == 1 ? 'block' : 'hidden'">
                @livewire('order.step1')
            </div>
            <div :class="current_step == 2 ? 'block' : 'hidden'">
                @livewire('order.step2')
            </div>
        </div>
        <div class="col-span-4">
            <div class="rounded-xl shadow-md p-6 bg-white space-y-6">
                <div class="border-b border-gray-300 border-dashed pb-2">
                    <h4 class="text-primary-dark">Resume</h4>
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
            </div>
        </div>
    </div>
</div>
