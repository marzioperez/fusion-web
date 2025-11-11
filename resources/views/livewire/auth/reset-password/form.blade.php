<div>
    <h5 class="text-center text-primary">Reset password</h5>
    <form wire:submit.prevent="process" class="md:grid grid-cols-2 gap-3 md:space-y-0 space-y-6">
        <div class="col-span-full">
            <label for="email">Email address</label>
            <div>
                <input id="email" type="text" name="email" wire:model.live="email" />
                @error('email') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full pt-6">
            <button type="submit" class="btn btn-lg btn-primary !w-full">Send</button>
        </div>
    </form>
</div>
