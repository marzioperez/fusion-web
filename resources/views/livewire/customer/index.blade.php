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
                @if($item === 'user-data')
                    <livewire:customer.user-data />
                @endif
                @if($item === 'students')
                    <livewire:customer.students.index />
                @endif
                @if($item === 'orders')
                    <livewire:customer.orders />
                @endif
                @if($item === 'update-password')
                    <livewire:customer.update-password />
                @endif
            </div>
        </div>
    </div>
</div>
