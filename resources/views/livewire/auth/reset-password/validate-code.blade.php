<div>
    <h5 class="text-center text-primary">Update password</h5>
    <form wire:submit.prevent="process" class="md:grid grid-cols-2 gap-3 md:space-y-0 space-y-6">
        <div class="col-span-full">
            <label for="email">Email address</label>
            <div>
                <input id="email" type="text" name="email" value="{{$email}}" disabled />
            </div>
        </div>

        <div class="col-span-full">
            <label for="code">Verification code</label>
            <div>
                <input id="code" type="text" name="code" wire:model.live="user_data.code" />
                @error('user_data.code') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="password">New password</label>
            <div>
                <x-inputs.password name="password" id="password" wire:model.live="user_data.password" />
                @error('user_data.password') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full pt-6">
            <button type="submit" class="btn btn-lg btn-primary !w-full">Send</button>
        </div>
    </form>
</div>
