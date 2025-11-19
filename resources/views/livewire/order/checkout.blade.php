<div class="max-w-5xl mx-auto py-8">
    <div class="mb-6 flex items-center gap-4">
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full flex items-center justify-center
                {{ $current_step >= 1 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-600' }}">
                1
            </span>
            <span class="{{ $current_step >= 1 ? 'font-semibold' : 'text-gray-500' }}">Resumen</span>
        </div>

        <div class="flex-1 h-px bg-gray-200"></div>

        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full flex items-center justify-center
                {{ $current_step >= 2 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-600' }}">
                2
            </span>
            <span class="{{ $current_step >= 2 ? 'font-semibold' : 'text-gray-500' }}">Forma de pago</span>
        </div>
    </div>

    @if ($current_step === 1)
        @livewire('order.step1')
    @elseif ($current_step === 2)
        @livewire('order.step2')
    @endif
</div>
