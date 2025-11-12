<div class="space-y-4">
    <form wire:submit.prevent="process">
        <div class="md:grid grid-cols-2 gap-6 md:space-y-0 space-y-6">
            <div>
                <label for="password">Password</label>
                <x-inputs.password wire:model.live="data.password" id="password" />
                @error('data.password') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="confirm_password">Confirm Password</label>
                <x-inputs.password wire:model.live="data.confirm_password" id="confirm_password" />
                @error('data.confirm_password') <span class="validation-error">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-full">
                <button type="submit" class="btn btn-lg btn-primary" wire:loading.attr="disabled">Update password</button>
            </div>
        </div>
    </form>
</div>
