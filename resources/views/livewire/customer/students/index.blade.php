<div class="space-y-6" x-data="{delete_student_id: @entangle('delete_student_id')}">
    @if($students->count() > 0)
        <ul class="space-y-2">
            @foreach ($students as $i => $student)
                <li class="flex items-center justify-between border border-primary rounded p-3 gap-2">
                    <div class="flex items-center space-x-3">
                        @if($student['avatar'])
                            <div>
                                <img src="{{$student['avatar']}}" alt="" class="w-14 h-14 object-center rounded-full" />
                            </div>
                        @endif
                        <div class="text-sm">
                            <p class="font-medium text-secondary">{{ $student['first_name'] ?? '—' }} {{ $student['last_name'] ?? '' }}</p>
                            <p class="text-gray-500">{{ $student['school_name'] ?? $student['school_id'] }}</p>
                            <p class="text-gray-500">{{ $student['grade_name'] ?? $student['grade_id'] }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="btn btn-md btn-primary" wire:click.prevent="editStudent({{ $student['id'] }})">
                            Edit
                        </button>
                        <button type="button" class="btn btn-md btn-red" x-on:click.prevent="delete_student_id = {{ $student['id'] }}; $dispatch('open-modal', {name: 'modal-delete-student'});">
                            Remove
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
        <div>
            <button type="button" class="btn btn-lg btn-primary" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-add-student'});">Add Student</button>
        </div>
    @else
        <p>You have no registered students. You can add students by clicking <a href="#" class="underline text-secondary font-bold" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-add-student'});">here</a>.</p>
    @endif

    <x-common.modal name="modal-add-student">
        <x-slot:body>
            <button x-on:click="$dispatch('close-modal')" class="absolute top-3 right-3">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" class="stroke-gray-400" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <livewire:customer.students.add />
        </x-slot:body>
    </x-common.modal>

    <x-common.modal name="modal-edit-student">
        <x-slot:body>
            <button x-on:click="$dispatch('close-modal')" class="absolute top-3 right-3">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" class="stroke-gray-400" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <livewire:customer.students.edit />
        </x-slot:body>
    </x-common.modal>

    <x-common.modal name="modal-delete-student">
        <x-slot:body>
            <button x-on:click="$dispatch('close-modal')" class="absolute top-3 right-3">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" class="stroke-gray-400" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="space-y-4">
                <h4 class="text-center">Delete student?</h4>
                <p class="text-center">Are you sure you want to delete this record?</p>
                <div class="flex justify-center space-x-6 pt-4">
                    <button type="button" class="btn btn-md btn-red" wire:click.prevent="deleteStudent">Yes, delete</button>
                    <button type="button" class="btn btn-md btn-white-outline" x-on:click.prevent="$dispatch('close-modal');">No, cancel</button>
                </div>
            </div>
        </x-slot:body>
    </x-common.modal>
</div>
