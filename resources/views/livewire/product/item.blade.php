<div class="product-item">
    <div class="calendar-first-detail">
        <div class="item"></div>
        <div class="item"></div>
    </div>
    <div class="calendar-second-detail">
        <div class="item"></div>
        <div class="item"></div>
    </div>
    <div class="header">
        <p>{{$product['label']}}</p>
    </div>
    <div class="body">
        <img src="{{$product['image_url']}}" class="w-full" alt="{{$product['name']}}" />
        <div class="content">
            <p class="font-semibold text-center">{{$product['name']}}</p>
            <p class="font-semibold text-center">${{$product['price']}}</p>
            <div class="flex justify-center">
                <button type="button" class="btn btn-md btn-secondary">Add to cart</button>
            </div>
        </div>
    </div>
</div>
