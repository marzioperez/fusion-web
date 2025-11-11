<div>
    <h5 class="text-center text-primary">Login</h5>
    <form wire:submit.prevent="process" class="md:grid grid-cols-2 gap-3 md:space-y-0 space-y-6">
        <div class="col-span-full">
            <label for="email">Email address</label>
            <div>
                <input id="email" type="text" name="email" wire:model.live="user_data.email" />
                @error('user_data.email') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="password">Password</label>
            <div>
                <x-inputs.password name="password" id="password" wire:model.live="user_data.password" />
                @error('user_data.password') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        @if($data['reset_password_url'])
            <div class="col-span-full">
                <a href="{{ $data['reset_password_url'] }}" class="text-primary" wire:navigate>Forgot Password?</a>
            </div>
        @endif

        <div class="col-span-full pt-6">
            <button type="submit" class="btn btn-lg btn-primary !w-full">Login</button>
        </div>

        @if($data['register_url'])
            <div class="col-span-full flex justify-center">
                <a href="{{$data['register_url']}}" class="text-primary" wire:navigate>Register account</a>
            </div>
        @endif
    </form>
</div>
