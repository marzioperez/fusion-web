<div class="md:py-12 py-8">
    <div class="container space-y-6">
        <div class="space-y-1">
            <h3 class="text-primary">My account</h3>
            <p>On your dashboard, you can manage your personal information as well as that of your registered students.</p>
        </div>

        <div class="md:grid grid-cols-12 md:space-y-0 space-y-6 gap-3">
            <div class="col-span-3">
                <aside class="user-menu">
                    <nav>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{route('customer.account', ['item' => 'user-data'])}}" wire:navigate class="group btn-option {{($item === 'user-data' ? 'active' : '')}}">User data</a>
                            </li>
                            <li>
                                <a href="{{route('customer.account', ['item' => 'students'])}}" wire:navigate class="group btn-option {{($item === 'students' ? 'active' : '')}}">Students</a>
                            </li>
                            <li>
                                <a href="{{route('customer.account', ['item' => 'orders'])}}" wire:navigate class="group btn-option {{($item === 'orders' ? 'active' : '')}}">Orders</a>
                            </li>
                            <li>
                                <a href="{{route('customer.account', ['item' => 'update-password'])}}" wire:navigate class="group btn-option {{($item === 'update-password' ? 'active' : '')}}">Update password</a>
                            </li>
                        </ul>
                    </nav>
                </aside>
            </div>

            <div class="col-span-9">
                <dl>
                    <dt>Order code</dt>
                    <dd class="font-medium text-primary-dark text-xl">#{{$order['code']}}</dd>
                </dl>

                <ul role="list" class="mt-6 divide-y divide-gray-200 border-t border-gray-200">
                    @foreach($order->items as $item)
                        <li class="flex space-x-6 py-6">
                            <img src="{{$item['image_url']}}" alt="{{$item['name']}}" class="size-24 flex-none rounded-md bg-gray-100 object-cover" />
                            <div class="flex-auto space-y-1">
                                <h5>{{$item['name']}}</h5>
                                <p class="text-red-600">{{$item['label']}}</p>
                                <p>{{$item['student_name']}}</p>
                                <p class="text-sm">Qty: {{$item['quantity']}}</p>
                            </div>
                            <p>${{$item['price']}}</p>
                        </li>
                    @endforeach
                </ul>

                <dl class="space-y-6 border-t border-gray-200 pt-6 font-medium">
                    <div class="flex justify-between">
                        <dt>Subtotal</dt>
                        <dd class="text-gray-900">${{$order['sub_total']}}</dd>
                    </div>

                    @if($order['credits'] > 0)
                        <div class="flex justify-between">
                            <dt>Credits applied</dt>
                            <dd class="text-gray-900">-${{$order['credits']}}</dd>
                        </div>
                    @endif

                    <div class="flex justify-between">
                        <dt>Processing fee / Delivery</dt>
                        <dd class="text-gray-900">${{$order['processing_fee']}}</dd>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <dt class="text-base">Total</dt>
                        <dd class="text-base">${{$order['total']}}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
