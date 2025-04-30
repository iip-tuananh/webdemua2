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
            <form class="page-products-category d-flex flex-wrap" ng-controller="ProductCategoryController">
                <div class="section-filter">
                    <a class="button_filter">
                        <span>Bộ lọc</span>
                        <i class="fa-solid fa-filter"></i>
                    </a>
                    <div class="section-item bg-white ">
                        <div class="filter-group">
                            <div class="filter-title">{{ $title }}</div>
                            @if (isset($category) && isset($category->childs) && count($category->childs) > 0)
                                @foreach ($category->childs as $child)
                                    <div class="filter-item pt-1 pb-1">
                                        <a class="filter-action d-inline-block "
                                            href="{{ route('front.show-product-category', $child->slug) }}"
                                            title="{{ $child->name }}">
                                            {{ $child->name }} </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="filter-group">
                            <div class="filter-title">Giá</div>
                            <div class="form-check filter-item pt-1 pb-1 mb-0" ng-repeat="price in priceRanges">
                                <input class="form-check-input filter-check" type="checkbox" id="<% price.id %>"
                                    ng-model="price.checked" ng-change="onChangeFilterPrice()">
                                <label class="form-check-label" for="<% price.id %>">
                                    <% price.label %>
                                </label>
                            </div>
                        </div>
                        <div class="filter-group">
                            <div class="filter-title">Loại sản phẩm</div>
                            @foreach ($categories as $cate)
                                <div class="form-check filter-item pt-1 pb-1 mb-0 ">
                                    <input class="form-check-input filter-check" filter="filter" type="checkbox"
                                        value="{{ $cate->id }}" id="filter{{ $cate->id }}"
                                        ng-click="filterCategory('{{ $cate->slug }}')">
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
                        <a class="filter-sort position-relative " ng-class="{'active': filter_sort == 'asc'}"
                            ng-click="filterSort('asc')">
                            Phổ biến </a>
                        <a class="filter-sort position-relative " ng-class="{'active': filter_sort == 'desc'}"
                            ng-click="filterSort('desc')">
                            Hàng mới </a>
                        <a class="filter-sort position-relative " ng-class="{'active': filter_sort == 'priceAsc'}"
                            ng-click="filterSort('priceAsc')">
                            Giá từ thấp đến cao </a>
                        <a class="filter-sort position-relative " ng-class="{'active': filter_sort == 'priceDesc'}"
                            ng-click="filterSort('priceDesc')">
                            Giá từ cao đến thấp </a>
                    </div>
                    <div class="section-item section-products d-flex flex-wrap" id="product-list">
                        @foreach ($products as $product)
                            @include('site.products.product_item', [
                                'product' => $product,
                                'vouchers' => $vouchers,
                            ])
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
    <script>
        app.controller('ProductCategoryController', function($scope, $http) {
            $scope.category = @json($category ?? null);
            $scope.filter_sort = 'asc';
            $scope.filterSort = function(sort) {
                $scope.filter_sort = sort;
                $scope.filter();
            }

            $scope.filter_price = [];

            $scope.priceRanges = [{
                    id: 'price13',
                    value: '0:200000',
                    label: 'Dưới 200k',
                    checked: false
                },
                {
                    id: 'price14',
                    value: '200000:350000',
                    label: 'Từ 200k đến 350k',
                    checked: false
                },
                {
                    id: 'price15',
                    value: '350000:500000',
                    label: 'Từ 350k đến 500k',
                    checked: false
                },
                {
                    id: 'price16',
                    value: '500000:800000',
                    label: 'Từ 500k đến 800k',
                    checked: false
                },
                {
                    id: 'price17',
                    value: '800000:1000000',
                    label: 'Từ 800k đến 1 triệu',
                    checked: false
                },
                {
                    id: 'price18',
                    value: '1000000:100000000',
                    label: 'Trên 1 triệu',
                    checked: false
                }
            ];

            $scope.onChangeFilterPrice = function() {
                $scope.filter_price = $scope.priceRanges
                    .filter(function(item) {
                        return item.checked;
                    })
                    .map(function(item) {
                        return item.value;
                    });

                $scope.filter();
            };

            $scope.filter = function() {
                $.ajax({
                    url: '{{ route('front.filter-product') }}',
                    type: 'GET',
                    data: {
                        sort: $scope.filter_sort,
                        category: $scope.category.id,
                        cate_slug: $scope.category.slug,
                        price: $scope.filter_price
                    },
                    success: function(response) {
                        $('#product-list').html(response.html);
                    },
                    error: function(response) {
                        console.log(response);
                    },
                    complete: function() {}
                });
            }

            $scope.filterCategory = function(slug) {
                url = '{{ route('front.show-product-category', ['categorySlug' => ':categorySlug']) }}'.replace(':categorySlug', slug);
                window.location.href = url;
            }
        });
    </script>
@endpush
