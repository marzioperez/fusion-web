<div class="space-y-4" x-data="{avatar_id: @entangle('data.avatar_media_id')}">
    <h5>Add Student</h5>
    <div class="space-y-3">
        <div class="grid md:grid-cols-4 grid-cols-2 gap-3">
            @foreach($avatars as $avatar)
                <div class="relative rounded-full" x-on:click.prevent="avatar_id = {{$avatar['id']}}" :class="{'border-4 border-primary': avatar_id == {{$avatar['id']}}}">
                    <img src="{{$avatar['url']}}" class="w-full h-full object-cover cursor-pointer" alt="">
                </div>
            @endforeach
        </div>
        @error('data.avatar_id') <span class="validation-error">{{ $message }}</span> @enderror
    </div>
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
            <label for="school_id">School</label>
            <div>
                <select name="school_id" wire:model.live="data.school_id" id="school_id">
                    <option value="">Select School</option>
                    @foreach($schools as $school)
                        <option value="{{$school['id']}}">{{$school['name']}}</option>
                    @endforeach
                </select>
                @error('data.school_id') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="grade_id">Grade</label>
            <div>
                <select name="grade_id" wire:model.live="data.grade_id" id="grade_id">
                    <option value="">Select Grade</option>
                    @foreach($grades as $grade)
                        <option value="{{$grade['id']}}">{{$grade['name']}}</option>
                    @endforeach
                </select>
                @error('data.grade_id') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="birth_of_date">Day of birth</label>
            <div>
                <x-inputs.date wire:model.live="data.birth_of_date" id="birth_of_date" name="birth_of_date" />
                @error('data.birth_of_date') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="allergies">Allergies</label>
            <x-inputs.tags :options="$allergies" placeholder="Search and select allergies that apply" wire-model="data.allergies" />
            @error('data.allergies') <span class="validation-error">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-full pt-6">
            <button type="submit" class="btn btn-lg btn-primary !w-full">
                Add Student
            </button>
        </div>
    </form>
</div>
