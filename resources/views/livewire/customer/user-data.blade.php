<div class="space-y-4">
    <form wire:submit.prevent="process">
        <div class="md:grid grid-cols-2 gap-6 md:space-y-0 space-y-6">
            <div>
                <label for="first_name">First name</label>
                <input type="text" wire:model="data.first_name" id="first_name" />
                @error('data.first_name') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="last_name">Last name</label>
                <input type="text" wire:model="data.last_name" id="last_name" />
                @error('data.last_name') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="text" wire:model="data.phone" id="phone" />
                @error('data.phone') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" wire:model="data.email" id="email" />
                @error('data.email') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-full">
                <button type="submit" class="btn btn-lg btn-primary" wire:loading.attr="disabled">Update data</button>
            </div>
        </div>
    </form>
</div>
