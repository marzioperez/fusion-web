<div class="space-y-4">
    <h5 class="text-xl font-semibold">Forma de pago</h5>

    <div class="bg-white shadow rounded-lg p-4 space-y-4">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <div class="font-medium">Available credits</div>
                <div class="text-gray-500">You can use them to reduce the total amount of your purchase.</div>
            </div>

            <div x-data="{
                enabled: @js($use_credits ?? false),
                user_credits: @js($user_credits ?? 0),
                init() {
                    this.$watch('enabled', value => {
                        $dispatch('toggle-use-credits', { enabled: value })
                    })
                }
            }" class="text-right">
                <div class="font-semibold mb-1">
                    ${{ number_format($user_credits, 2) }}
                </div>

                <div class="inline-flex items-center gap-2 text-sm">
                    <span class="text-gray-700">Use my credits</span>

                    <button :disabled="user_credits == 0" type="button" @click="enabled = !enabled"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-primary-500"
                        :class="enabled ? 'bg-primary' : 'bg-gray-200'">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="enabled ? 'translate-x-5' : 'translate-x-0'"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <button type="button" x-on:click.prevent="$dispatch('update-step', { step: 1 })" class="btn btn-md btn-white-outline">Back to resume</button>
            <button type="button" class="btn btn-md btn-primary">
                Finish order
            </button>
        </div>
    </div>
</div>
