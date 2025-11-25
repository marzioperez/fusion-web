<div class="space-y-4">
    <h5 class="text-center text-primary">Parent information</h5>
    <form wire:submit.prevent="process" class="md:grid grid-cols-2 gap-3 md:space-y-0 space-y-6">
        <div>
            <label for="first_name">First name</label>
            <div>
                <input id="first_name" type="text" name="first_name" wire:model.live="data.first_name" />
                @error('data.first_name') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="last_name">Last name</label>
            <div>
                <input id="last_name" type="text" name="last_name" wire:model.live="data.last_name" />
                @error('data.last_name') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="phone">Contact number</label>
            <div>
                <input id="phone" type="text" name="phone" wire:model.live="data.phone" />
                @error('data.phone') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="email">Email address</label>
            <div>
                <input id="email" type="text" name="email" wire:model.live="data.email" />
                @error('data.email') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="password">Password</label>
            <div>
                <x-inputs.password name="password" id="password" wire:model.live="data.password" />
                @error('data.password') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full pt-6">
            <button type="submit" class="btn btn-lg btn-primary !w-full">
                Next step
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="ml-3 size-5 text-white">
                    <path d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </button>
        </div>
    </form>
</div>
