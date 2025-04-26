@foreach ($products as $product)
    @include('site.products.product_item', ['product' => $product])
@endforeach
<div class="w-100 d-flex justify-content-center">
    {{ $products->links() }}
</div>
