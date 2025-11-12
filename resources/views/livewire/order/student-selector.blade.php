<div class="space-y-6">
    @if($students->count() > 0)
        <h4 class="text-primary text-center">Select an Student</h4>
        <div class="grid md:grid-cols-3 grid-cols-2 gap-6">
            @foreach($students as $student)
                <a href="{{route('customer.start-shopping', ['code' => $student['code']])}}" wire:navigate class="flex flex-col space-x-2 space-y-3">
                    @if($student['avatar'])
                        <img src="{{$student['avatar']}}" alt="" class="w-full h-full object-cover rounded-full" />
                    @endif
                    <h6 class="text-secondary text-center">{{$student['first_name']}} {{$student['last_name']}}</h6>
                </a>
            @endforeach
        </div>
    @endif
</div>
