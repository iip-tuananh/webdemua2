@extends('site.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $short_des }}
@endsection
@section('css')
<link rel="stylesheet" type="text/css" media="screen" href="/site/css/category.css?v=1.74" />
@endsection

@section('content')
    <div class="app-main-content pt-3 pb-3">
        <div class="container">
            <nav aria-label="breadcrumb"
                style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.19751 11.62L9.00084 7.81666C9.45001 7.3675 9.45001 6.6325 9.00084 6.18333L5.19751 2.38' stroke='%23757575' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E&quot;)">
                <ol class="breadcrumb mb-3" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li class="breadcrumb-item" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" title="{{ $config->web_title }}" href="{{ route('front.home-page') }}">
                            <span itemprop="name">Trang chủ</span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" title="{{ $title }}"
                            href="{{ isset($category) ? route('front.show-product-category', $category->slug) : route('front.search') }}">
                            <span itemprop="name">
                                {{ $title }} </span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>
                </ol>
            </nav>
            <form
                class="page-products-category d-flex flex-wrap">
                <div class="section-filter">
                    <a class="button_filter">
                        <span>Bộ lọc</span>
                        <i class="fa-solid fa-filter"></i>
                    </a>
                    <div class="section-item bg-white ">
                        <div class="filter-group">
                            <div class="filter-title">{{ $title }}</div>
                            @if (isset($category))
                                @foreach ($category->childs as $child)
                                    <div class="filter-item pt-1 pb-1">
                                        <a class="filter-action d-inline-block "
                                            href="{{ route('front.show-product-category', $child->slug) }}" title="{{ $child->name }}">
                                            {{ $child->name }} </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="filter-group">
                            <div class="filter-title">Giá</div>
                            <div class="form-check filter-item pt-1 pb-1 mb-0 ">
                                <input class="form-check-input filter-check" filter="price" type="checkbox" value="0:200000"
                                    id="price13">
                                <label class="form-check-label" for="price13">
                                    Dưới 200k </label>
                            </div>
                            <div class="form-check filter-item pt-1 pb-1 mb-0 ">
                                <input class="form-check-input filter-check" filter="price" type="checkbox"
                                    value="200000:350000" id="price14">
                                <label class="form-check-label" for="price14">
                                    Từ 200k đến 350k </label>
                            </div>
                            <div class="form-check filter-item pt-1 pb-1 mb-0 ">
                                <input class="form-check-input filter-check" filter="price" type="checkbox"
                                    value="350000:500000" id="price15">
                                <label class="form-check-label" for="price15">
                                    Từ 350k đến 500k </label>
                            </div>
                            <div class="form-check filter-item pt-1 pb-1 mb-0 ">
                                <input class="form-check-input filter-check" filter="price" type="checkbox"
                                    value="500000:800000" id="price16">
                                <label class="form-check-label" for="price16">
                                    Từ 500k đến 800k </label>
                            </div>
                            <div class="form-check filter-item pt-1 pb-1 mb-0 ">
                                <input class="form-check-input filter-check" filter="price" type="checkbox"
                                    value="800000:1000000" id="price17">
                                <label class="form-check-label" for="price17">
                                    Từ 800k đến 1 triệu </label>
                            </div>
                            <div class="form-check filter-item pt-1 pb-1 mb-0">
                                <input class="form-check-input filter-check" filter="price" type="checkbox"
                                    value="1000000:100000000" id="price18">
                                <label class="form-check-label" for="price18">
                                    Trên 1 triệu </label>
                            </div>
                        </div>
                        <div class="filter-group">
                            <div class="filter-title">Loại sản phẩm</div>
                            @foreach ($categories as $cate)
                            <div class="form-check filter-item pt-1 pb-1 mb-0 ">
                                <input class="form-check-input filter-check" filter="filter" type="checkbox"
                                    value="{{ $cate->id }}" id="filter{{ $cate->id }}">
                                <label class="form-check-label" for="filter{{ $cate->id }}">
                                    {{ $cate->name }} </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="section-main">
                    <div class="section-item section-padding bg-white">
                        <h1 class="cat-h1">{{ $title }}</h1>
                        <div class="section-banner">
                        </div>
                    </div>
                    <div class="section-item section-padding bg-white section-filter-sort d-flex align-items-center gap-4">
                        <a class="filter-sort position-relative active" data="0">
                            Phổ biến </a>
                        <a class="filter-sort position-relative " data="1">
                            Hàng mới </a>
                        <a class="filter-sort position-relative " data="2">
                            Giá từ thấp đến cao </a>
                        <a class="filter-sort position-relative " data="3">
                            Giá từ cao đến thấp </a>
                    </div>
                    <div class="section-item section-products d-flex flex-wrap">
                        @foreach ($products as $product)
                            @include('site.products.product_item', ['product' => $product, 'vouchers' => $vouchers])
                        @endforeach
                        <div class="w-100 d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
@endpush
