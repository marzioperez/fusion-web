<div class="container py-12" x-data="{ current_step: 3}">
    <div class="md:grid grid-cols-12 gap-6 space-y-6">
        <div class="col-span-full">
            <nav class="flex items-center">
                <p class="text-sm font-medium">Step <span x-text="current_step"></span> of 3</p>
                <ol class="ml-8 flex items-center space-x-5">
                    <li>
                        <div class="relative flex items-center justify-center">
                            <span class="absolute flex size-5 p-px" x-show="current_step == 1">
                                <span class="size-full rounded-full bg-primary/30"></span>
                            </span>
                            <span class="relative block size-2.5 rounded-full" :class="current_step <= 3 ? 'bg-primary' : 'bg-gray-300'"></span>
                            <span class="sr-only">Step 1</span>
                        </div>
                    </li>
                    <li>
                        <div class="relative flex items-center justify-center">
                            <span class="absolute flex size-5 p-px" x-show="current_step == 2">
                                <span class="size-full rounded-full bg-primary/30"></span>
                            </span>
                            <span class="relative block size-2.5 rounded-full" :class="current_step >= 2 ? 'bg-primary' : 'bg-gray-300'"></span>
                            <span class="sr-only">Step 2</span>
                        </div>
                    </li>
                    <li>
                        <div class="relative flex items-center justify-center">
                            <span class="absolute flex size-5 p-px" x-show="current_step == 3">
                                <span class="size-full rounded-full bg-primary/30"></span>
                            </span>
                            <span class="relative block size-2.5 rounded-full" :class="current_step >= 3 ? 'bg-primary' : 'bg-gray-300'"></span>
                            <span class="sr-only">Step 3</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="col-span-full">
            <div>
                <div class="space-y-2">
                    <h6 class="text-sm font-medium text-primary">Payment successful</h6>
                    <h3>Thanks for ordering</h3>
                    <p>We appreciate your order, we’re currently processing it. So hang tight and we’ll send you confirmation very soon!</p>
                </div>

                <dl class="mt-16">
                    <dt>Order code</dt>
                    <dd class="font-medium text-primary-dark text-xl">#{{$model['code']}}</dd>
                </dl>

                <ul role="list" class="mt-6 divide-y divide-gray-200 border-t border-gray-200">
                    @foreach($model->items as $item)
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
                        <dd class="text-gray-900">${{$model['sub_total']}}</dd>
                    </div>

                    @if($model['credits'] > 0)
                        <div class="flex justify-between">
                            <dt>Credits applied</dt>
                            <dd class="text-gray-900">-${{$model['credits']}}</dd>
                        </div>
                    @endif

                    <div class="flex justify-between">
                        <dt>Processing fee / Delivery</dt>
                        <dd class="text-gray-900">${{$model['processing_fee']}}</dd>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <dt class="text-base">Total</dt>
                        <dd class="text-base">${{$model['total']}}</dd>
                    </div>
                </dl>

                <div class="mt-16 border-t border-gray-200 py-6 text-right">
                    <a href="{{route('customer.account', ['item' => 'orders'])}}" class="font-medium text-primary hover:text-primary-dark">
                        My orders
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
