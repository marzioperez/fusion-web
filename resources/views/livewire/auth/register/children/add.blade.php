<div class="space-y-4">
    <h5>Add Student</h5>
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

        <div>
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
                @error('data.phone') <span class="validation-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-full pt-6">
            <button type="submit" class="btn btn-lg btn-primary !w-full">
                Add Student
            </button>
        </div>
    </form>
</div>
