<div class="space-y-4">
    <h5 class="text-center text-primary">Students information</h5>
    <div class="border-t border-gray-300 pt-6 space-y-6">
        <div class="flex items-center justify-end mb-3">
            <button type="button" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-add-student'});" class="btn btn-md btn-secondary">+ Add student</button>
        </div>

        @if (count($students))
            <ul class="space-y-2">
                @foreach ($students as $i => $student)
                    <li class="flex items-center justify-between border border-primary rounded p-3 gap-2">
                        <div class="text-sm">
                            <p class="font-medium text-secondary">{{ $student['first_name'] ?? '—' }} {{ $student['last_name'] ?? '' }}</p>
                            <p class="text-gray-500">{{ $student['school_name'] ?? $student['school_id'] }}</p>
                            <p class="text-gray-500">{{ $student['grade_name'] ?? $student['grade_id'] }}</p>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" class="btn btn-md btn-primary" wire:click="editStudent({{ $i }})">
                                Edit
                            </button>
                            <button type="button" class="btn btn-md btn-red" wire:click.prevent="removeStudent({{ $i }})">
                                Remove
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm text-gray-500 text-center">You have not added any students yet.</p>
        @endif

        @error('students')
            <p class="text-sm text-red-600 mb-2">{{ $message }}</p>
        @enderror

        <div class="md:grid grid-cols-2 gap-4">
            <button type="button" class="btn btn-lg btn-white-outline !w-full" x-on:click.prevent="$dispatch('update-step', {step: 1});">Back</button>
            <button type="button" x-on:click.prevent="$dispatch('finished');" class="btn btn-lg btn-primary !w-full">
                ¡Finish register!
            </button>
        </div>
    </div>

    <x-common.modal name="modal-add-student">
        <x-slot:body>
            <button x-on:click="$dispatch('close-modal')" class="absolute top-3 right-3">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" class="stroke-gray-400" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <livewire:auth.register.children.add />
        </x-slot:body>
    </x-common.modal>

    <x-common.modal name="modal-edit-student">
        <x-slot:body>
            <button x-on:click="$dispatch('close-modal')" class="absolute top-3 right-3">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" class="stroke-gray-400" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <livewire:auth.register.children.edit />
        </x-slot:body>
    </x-common.modal>
</div>
