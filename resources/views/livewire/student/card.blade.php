<div class="p-6 bg-white rounded-lg shadow-md border border-gray-200">
    <div class="flex items-center space-x-6">
        @if($student['avatar'])
            <div>
                <img src="{{$student['avatar']}}" alt="" class="w-32 object-center rounded-full" />
            </div>
        @endif
        <div class="space-y-3">
            <div>
                <h5 class="font-medium text-secondary">{{ $student['first_name'] ?? '—' }} {{ $student['last_name'] ?? '' }}</h5>
                <p class="text-sm">{{$student['birth_of_date']->format('d/m/Y')}}</p>
            </div>
            <div class="md:flex space-x-6">
                <div>
                    <h6 class="text-gray-500">{{ $student['school_name'] ?? $student['school_id'] }}</h6>
                    <p class="text-gray-500">{{ $student['grade_name'] ?? $student['grade_id'] }}</p>
                </div>
                <div>
                    <h6 class="text-gray-500 font-semibold">Allergies</h6>
                    <div class="flex space-x-2">
                        @foreach($student['allergies'] as $allergy)
                            <div class="px-2 py-1.5 bg-primary/20 rounded-2xl text-xs">{{$allergy}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
