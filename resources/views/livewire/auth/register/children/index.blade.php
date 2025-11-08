<div class="space-y-4">
    <h5 class="text-center text-primary">Students data</h5>
    <div class="border-t border-gray-300 pt-6 space-y-6">
        <div class="flex items-center justify-end mb-3">
            <button type="button" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-add-student'});" class="btn btn-md btn-secondary">+ Add student</button>
        </div>

        @if (count($students))
            <ul class="space-y-2">
                @foreach ($students as $i => $student)
                    <li class="flex items-center justify-between border rounded p-3">
                        <div class="text-sm">
                            <p class="font-medium">
                                {{ $student['first_name'] ?? '—' }} {{ $student['last_name'] ?? '' }}
                            </p>
                            <p class="text-gray-500">School: {{ $stu['school_name'] ?? $stu['school_id'] }} • Grade: {{ $stu['grade_name'] ?? $stu['grade_id'] }}
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" class="px-3 py-1.5 border rounded" wire:click="editStudent({{ $i }})">
                                Edit
                            </button>
                            <button type="button" class="px-3 py-1.5 border rounded text-red-600" wire:click="removeStudent({{ $i }})">
                                Remove
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm text-gray-500 text-center">You haven't added any students yet.</p>
        @endif

        @error('students')
            <p class="text-sm text-red-600 mb-2">{{ $message }}</p>
        @enderror

        <div>
            <button type="button" wire:click.prevent="process" class="btn btn-lg btn-primary !w-full">
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
</div>
