<div class="layout-product-item">
    <a href="{{route('front.show-product-detail', $product->slug)}}"
        title="{{$product->name}}"
        class="layout-product" >
        <div class="layout-image position-relative">
            <img src="{{$product->image->path ?? ''}}"
                alt="" class="img-fluid layout-img" loading="lazy">
        </div>
        <div class="layout-content">
            <div class="layout-name">{{$product->name}}</div>
            <div class="layout-info">
                <div class="item-info item-gift">Quà tặng</div>
                @if ($product->base_price > 0)
                    <div class="item-info item-percent">Giảm {{number_format(($product->base_price - $product->price) * 100 / $product->base_price, 0, ',', '.')}}%</div>
                @endif
                @foreach ($vouchers as $voucher)
                    {{-- @if ($voucher->id == $product->voucher_id) --}}
                        <div class="item-info item-voucher" data-id="{{$voucher->id}}">
                            {{$voucher->name}}
                        </div>
                    {{-- @endif --}}
                @endforeach
                <div class="item-info item-freeship">Freeship</div>
            </div>
            @if ($product->base_price > 0)
                <div class="layout-origin-price">
                    {{formatCurrency($product->base_price)}}<sup>₫</sup>
                </div>
            @endif
            <div class="layout-public-price flex-wrap gap-1">
                <div class="price">
                    {{formatCurrency($product->price)}}<sup>₫</sup>
                </div>
                <div class="sold-out">Đã bán {{$product->sold_quantity ?? 0}}</div>
            </div>
        </div>
    </a>
</div>