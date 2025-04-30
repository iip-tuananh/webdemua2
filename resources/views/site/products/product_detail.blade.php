@extends('site.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('description')
    {{ strip_tags($product->intro) }}
@endsection
@section('image')
    {{ $product->image ? $product->image->path : $product->galleries[0]->image->path }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/slick.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/select2.min.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/product.css?v=1.74" />
    <style>
        .text-limit-3-line {
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .hidden {
            display: none;
        }

        .product-attributes {
            margin-bottom: 0 !important;
        }

        .product-attributes label {
            font-weight: 600;
            margin-bottom: 0 !important;
        }

        .product-attribute-values {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .product-attribute-values .badge,
        .product-attribute-values .badge+.badge {
            width: auto;
            border: 1px solid #0974ba;
            padding: 2px 10px;
            border-radius: 5px;
            font-size: 14px;
            color: #0974ba;
            height: 30px;
            cursor: pointer;
            pointer-events: auto;
        }

        .product-attribute-values .badge:hover {
            background-color: #0974ba;
            color: #fff;
        }

        .product-attribute-values .badge.active {
            background-color: #0974ba;
            color: #fff;
        }

        .countdown {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin-top: 20px;
        }

        .countdown .countdown-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .countdown-item {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 6px 10px;
            border-radius: 2px;
            background: linear-gradient(to bottom, #ff5e00, #f4955e);
        }

        .countdown-item-number {
            font-size: 24px;
            font-weight: 600;
            color: #fff;
        }

        .countdown-item-label {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .countdown-item-separator {
            font-size: 14px;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <div class="app-main-content pt-3 pb-3" ng-controller="ProductDetailController" ng-cloak>
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
                    <li class="breadcrumb-item " itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" title="Điện thoại - Sim"
                            href="{{ route('front.show-product-category', $product->category->slug) }}">
                            <span itemprop="name">
                                {{ $product->category->name }} </span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" title="{{ $product->name }}"
                            href="{{ route('front.show-product-detail', $product->slug) }}">
                            <span itemprop="name">
                                {{ $product->name }} </span>
                        </a>
                        <meta itemprop="position" content="3" />
                    </li>
                </ol>
            </nav>
        </div>
        <div class="section-product-detail bg-white mb-3 pt-3 pb-3">
            <div class="container d-flex">
                <div class="section-image d-flex">
                    <div class="image" id="ez-image" data-zoom-image="{{ $product->image->path }}"
                        src="{{ $product->image->path }}">
                        <div class="slider-for">
                            @foreach ($product->galleries as $gallery)
                                <div>
                                    <img data-zoom-image="{{ $gallery->image->path }}" src="{{ $gallery->image->path }}"
                                        alt="{{ $product->name }}" class="img-fluid img-ez-zoom" loading="lazy">
                                </div>
                            @endforeach
                            <div>
                                <img data-zoom-image="{{ $product->image->path }}" src="{{ $product->image->path }}"
                                    alt="{{ $product->name }}" class="img-fluid img-ez-zoom" loading="lazy">
                            </div>
                        </div>
                    </div>
                    <div class="thumbnail">
                        <div class="slider-nav">
                            @foreach ($product->galleries as $gallery)
                                <div>
                                    <img src="{{ $gallery->image->path }}" alt="{{ $product->name }}" class="img-fluid"
                                        loading="lazy">
                                </div>
                            @endforeach
                            <div>
                                <img src="{{ $product->image->path }}" alt="{{ $product->name }}" class="img-fluid"
                                    loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-main">
                    <h1 class="p-name">{{ $product->name }}</h1>
                    <p class="p-sub-title"></p>
                    <div class="p-trademark d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <span>Thương hiệu:</span>
                                <b></b>
                            </div>
                            <div class="wrap"></div>
                            <div>
                                <b>{{ random_int(100, 999) }}</b>
                                <span>Đã bán</span>
                            </div>
                            <div class="wrap"></div>
                            <div class="fw-medium p-status-in">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 4.5L6.75 12.75L3 9" stroke="#3BA500" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Còn hàng
                            </div>
                        </div>
                        <div class="p-share">
                            <a href="{{ route('front.show-product-detail', $product->slug) }}"
                                class="d-flex align-items-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.1335 5.14166C15.8002 6.29999 16.9502 8.14166 17.1835 10.2667M2.9085 10.3083C3.12516 8.19166 4.2585 6.34999 5.9085 5.18333M6.82516 17.45C7.79183 17.9417 8.89183 18.2167 10.0502 18.2167C11.1668 18.2167 12.2168 17.9667 13.1585 17.5083M12.3668 4.09999C12.3668 5.37945 11.3296 6.41666 10.0502 6.41666C8.7707 6.41666 7.7335 5.37945 7.7335 4.09999C7.7335 2.82053 8.7707 1.78333 10.0502 1.78333C11.3296 1.78333 12.3668 2.82053 12.3668 4.09999ZM6.34183 14.2833C6.34183 15.5628 5.30462 16.6 4.02516 16.6C2.7457 16.6 1.7085 15.5628 1.7085 14.2833C1.7085 13.0039 2.7457 11.9667 4.02516 11.9667C5.30462 11.9667 6.34183 13.0039 6.34183 14.2833ZM18.2918 14.2833C18.2918 15.5628 17.2546 16.6 15.9752 16.6C14.6957 16.6 13.6585 15.5628 13.6585 14.2833C13.6585 13.0039 14.6957 11.9667 15.9752 11.9667C17.2546 11.9667 18.2918 13.0039 18.2918 14.2833Z"
                                        stroke="#757575" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Chia sẻ
                            </a>
                        </div>
                    </div>
                    <div class="p-price-promotion">
                        <div class="p-price">
                            <div class="p-line align-items-end">
                                <div class="p-line-title">Giá</div>
                                <div class="p-line-content">
                                    <div class="p-price-public d-inline-block">
                                        {{ formatCurrency($product->price) }}<sup>₫</sup>
                                    </div>
                                    @if ($product->base_price > 0)
                                        <div class="p-price-origin d-inline-block ms-3">
                                            {{ formatCurrency($product->base_price) }}<sup>₫</sup>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-line p-sale-brief mt-3">
                                <div class="p-line-title">Khuyến mại</div>
                                <div class="p-line-content">
                                    <div class="promo">
                                        @foreach ($vouchers as $voucher)
                                            <div class="item-info item-voucher" data-id="{{ $voucher->id }}">
                                                <img src="/site/images/voucher.svg" alt="voucher" />
                                                {{ $voucher->name }}
                                            </div>
                                        @endforeach
                                        <div class="item-info item-freeship">Freeship</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-form">
                        @if (isset($product->attributes) && count($product->attributes) > 0)
                            @foreach ($product->attributes as $index => $attribute)
                                <div class="p-line product-attributes">
                                    <div class="p-line-title">{{ $attribute['name'] }}</div>
                                    <div class="p-line-content d-flex flex-wrap gap-2">
                                        @foreach ($attribute['values'] as $value)
                                            <a href="" data-value="{{ $value }}"
                                                data-name="{{ $attribute['name'] }}" data-index="{{ $index }}"
                                                class="p-choose p-type  active">
                                                {{ $value }} </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="p-line">
                            <div class="p-line-title">Số lượng</div>
                            <div class="p-line-content d-flex align-items-center gap-4">
                                <div class="p-quantity d-flex align-items-center">
                                    <button class="subtract btn">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect y="5" width="12" height="2" rx="1" fill="#3B3B3B" />
                                        </svg>
                                    </button>
                                    <input class="form-control" id="order-quantity" type="number" value="1"
                                        min="1" max="100" name="quantity">
                                    <button class="plus btn">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect y="5" width="12" height="2" rx="1" fill="#3B3B3B" />
                                            <rect x="5" width="2" height="12" rx="1" fill="#3B3B3B" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-submit d-flex align-items-center justify-content-between gap-3 mt-4">
                            <a href="javascript:void(0)" class="btn-submit add-cart available"
                                ng-click="addToCartFromProductDetail()">
                                {{-- <img src="/site/images/cart.svg" alt="Thêm vào giỏ hàng" /> --}}
                                Thêm vào giỏ hàng </a>
                            <a href="javascript:void(0)" class="btn-submit buy-now available"
                                ng-click="addToCartCheckoutFromProductDetail()">
                                Mua ngay </a>
                        </div>
                        <div class="countdown">
                            <div class="countdown-title">
                                <span>Giảm giá sẽ kết thúc sau:</span>
                            </div>
                            <div class="countdown-content" data-time="00:14:59">
                                <div class="countdown-item">
                                    <span class="countdown-item-number">00</span>
                                </div>
                                <div class="countdown-item-separator">
                                    <span>:</span>
                                </div>
                                <div class="countdown-item">
                                    <span class="countdown-item-number">00</span>
                                </div>
                                <div class="countdown-item-separator">
                                    <span>:</span>
                                </div>
                                <div class="countdown-item">
                                    <span class="countdown-item-number">00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="section-grid">
                <div class="section-grid-left">
                    <div class="section-item section-description bg-white mb-3">
                        <h2 class="section-title fw-bold position-relative">Mô tả sản phẩm</h2>
                        <div class="description-main less">
                            {!! $product->body !!}
                            <p> </p>
                            <p> </p>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <button class="btn-more-less d-flex align-items-center gap-2 fw-bold">
                                <span>Xem thêm</span>
                                <span>Thu gọn</span>
                                <i class="fa-solid fa-angle-down"></i>
                            </button>
                        </div>
                    </div>
                    <div class="section-more-products">
                        <h2 class="fw-bold">Có thể bạn cũng thích</h2>
                        <div class="section-more d-flex flex-wrap">
                            @foreach ($productsRelated as $item)
                                @include('site.products.product_item', [
                                    'product' => $item,
                                    'vouchers' => $vouchers,
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="section-grid-right">
                    <div class="section-item section-hot-selling bg-white">
                        <h2 class="section-title fw-bold position-relative">Sản phẩm bán chạy</h2>
                        @foreach ($bestSellerProducts as $bestSellerProduct)
                            @include('site.products.product_item', [
                                'product' => $bestSellerProduct,
                                'vouchers' => $vouchers,
                            ])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="javascript" type="text/javascript" src="/site/js/slick.min.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/jquery.ez-plus.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/select2.min.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/product.js?v=1.74"></script>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.countdown-content').each(function() {
                const $container = $(this);
                const key = 'countdown_end_time'; // localStorage key
                const timeStr = $container.data('time'); // "HH:MM:SS"
                const timeParts = timeStr.split(':').map(Number);
                const cycleSeconds = timeParts[0] * 3600 + timeParts[1] * 60 + timeParts[2];

                function setNewEndTime() {
                    const newEnd = Date.now() + cycleSeconds * 1000;
                    localStorage.setItem(key, newEnd);
                    return newEnd;
                }

                // Lấy endTime từ localStorage hoặc khởi tạo mới
                let endTime = parseInt(localStorage.getItem(key), 10);
                if (!endTime || isNaN(endTime) || endTime <= Date.now()) {
                    endTime = setNewEndTime();
                }

                function updateDisplay(secondsLeft) {
                    const hrs = String(Math.floor(secondsLeft / 3600)).padStart(2, '0');
                    const mins = String(Math.floor((secondsLeft % 3600) / 60)).padStart(2, '0');
                    const secs = String(secondsLeft % 60).padStart(2, '0');

                    const $numbers = $container.find('.countdown-item-number');
                    $numbers.eq(0).text(hrs);
                    $numbers.eq(1).text(mins);
                    $numbers.eq(2).text(secs);
                }

                updateDisplay(Math.floor((endTime - Date.now()) / 1000)); // Hiển thị ban đầu

                setInterval(function() {
                    const now = Date.now();
                    let remainingSeconds = Math.floor((endTime - now) / 1000);

                    if (remainingSeconds <= 0) {
                        endTime = setNewEndTime(); // Reset lại thời gian mới
                        remainingSeconds = cycleSeconds;
                    }

                    updateDisplay(remainingSeconds);
                }, 1000);
            });
        });

        // Plus number quantiy product detail
        var plusQuantity = function() {
            if (jQuery('input[name="quantity"]').val() != undefined) {
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                if (!isNaN(currentVal)) {
                    jQuery('input[name="quantity"]').val(currentVal + 1);
                } else {
                    jQuery('input[name="quantity"]').val(1);
                }
            } else {
                console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());
            }
        }
        // Minus number quantiy product detail
        var minusQuantity = function() {
            if (jQuery('input[name="quantity"]').val() != undefined) {
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    jQuery('input[name="quantity"]').val(currentVal - 1);
                }
            } else {
                console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());
            }
        }
        app.controller('ProductDetailController', function($scope, $http, $interval, cartItemSync, $rootScope, $compile) {
            $scope.product = @json($product);
            $scope.form = {
                quantity: 1
            };

            $scope.selectedAttributes = [];
            jQuery('.product-attribute-values .badge').click(function() {
                if (!jQuery(this).hasClass('active')) {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).addClass('active');
                    if ($scope.selectedAttributes.length > 0 && $scope.selectedAttributes.find(item => item
                            .index == jQuery(this).data('index'))) {
                        $scope.selectedAttributes.find(item => item.index == jQuery(this).data('index'))
                            .value = jQuery(this).data('value');
                    } else {
                        let index = jQuery(this).data('index');
                        $scope.selectedAttributes.push({
                            index: index,
                            name: jQuery(this).data('name'),
                            value: jQuery(this).data('value'),
                        });
                    }
                } else {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).removeClass('active');
                    $scope.selectedAttributes = $scope.selectedAttributes.filter(item => item.index !=
                        jQuery(this).data('index'));
                }
                $scope.$apply();
            });

            $scope.addToCartFromProductDetail = function() {
                let quantity = $('.section-product-detail input[name="quantity"]').val();

                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            toastr.success('Thao tác thành công !')
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.addToCartCheckoutFromProductDetail = function() {
                let quantity = $('.section-product-detail input[name="quantity"]').val();
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            toastr.success('Thao tác thành công !')
                            window.location.href = "{{ route('cart.checkout') }}";
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script>
@endpush
