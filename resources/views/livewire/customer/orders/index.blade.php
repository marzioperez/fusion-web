<div class="space-y-3">
    @foreach($orders as $order)
        <div class="p-2 border border-gray-300 rounded-md">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <p class="text-xl font-semibold text-primary">#{{$order['code']}}</p>
                    <p>{{$order['created_at']->format('d/m/Y')}}</p>
                </div>
                <div class="col-span-3 flex items-center space-x-2 justify-end">
                    @php
                        $class = match ($order['status']) {
                            \App\Enums\Status::FINISHED->value => 'success',
                            \App\Enums\Status::ERROR->value => 'danger',
                            default => 'gray'
                        }
                    @endphp
                    <div class="badge {{$class}}">{{$order['status']}}</div>
                    <a href="{{route('order.detail', ['code' => $order['code']])}}" wire:navigate class="btn btn-primary btn-md">Show</a>
                </div>
            </div>
        </div>
    @endforeach
    <div>
        {{$orders->links()}}
    </div>
</div>
