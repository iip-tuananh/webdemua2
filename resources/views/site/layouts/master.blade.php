<!DOCTYPE html>
<html lang="vi-VN">

<head prefix="og: http://ogp.me/ns# fb:http://ogp.me/ns/fb# article:http://ogp.me/ns/article#">
    @include('site.partials.head')
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/all.min.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/jquery.lazyloadxt.fadein.min.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/bootstrap.min.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/main.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/owl.carousel.min.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/owl.theme.default.min.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/default.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/search.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/mobile-default.css?v=1.74" />
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/callbutton.css?v=1.74" />
    <script language="javascript" type="text/javascript" src="/site/js/jquery-3.6.0.min.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/jquery.lazyloadxt.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/bootstrap.bundle.min.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/form.js?v=1.74"></script>
    @yield('css')

    <!-- Angular Js -->
    <script src="{{ asset('libs/angularjs/angular.js?v=222222') }}"></script>
    <script src="{{ asset('libs/angularjs/angular-resource.js') }}"></script>
    <script src="{{ asset('libs/angularjs/sortable.js') }}"></script>
    <script src="{{ asset('libs/dnd/dnd.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular-sanitize.js"></script>
    <script src="{{ asset('libs/angularjs/select.js') }}"></script>
    <script src="{{ asset('js/angular.js') }}?version={{ env('APP_VERSION', '1') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    @stack('script')
    <script>
        app.controller('AppController', function($rootScope, $scope, cartItemSync, $interval, $compile){
            $scope.currentUser = @json(Auth::guard('client')->user());
            $scope.isAdminClient = @json(Auth::guard('client')->check());
            // $scope.showMenuAdminClient = localStorage.getItem('showMenuAdminClient') ? localStorage.getItem('showMenuAdminClient') : false;

            // const currentUrl = window.location.href;
            // if (currentUrl != "{{route('front.client-account')}}" && currentUrl != "{{route('front.user-order')}}" && currentUrl != "{{route('front.user-revenue')}}" && currentUrl != "{{route('front.user-level')}}") {
            //     $scope.showMenuAdminClient = false;
            //     localStorage.removeItem('showMenuAdminClient');
            // }

            // $scope.changeMenuClient = function($event, url){
            //     $event.preventDefault();
            //     $scope.showMenuAdminClient = !$scope.showMenuAdminClient;
            //     if(url == '{{route('front.user-order')}}' || url == '{{route('front.user-revenue')}}' || url == '{{route('front.user-level')}}') {
            //         $scope.showMenuAdminClient = true;
            //     }

            //     if($scope.showMenuAdminClient){
            //         localStorage.setItem('showMenuAdminClient', $scope.showMenuAdminClient);
            //         window.location.href = url;
            //     }else{
            //         localStorage.removeItem('showMenuAdminClient');
            //         window.location.href = '{{ route('front.home-page') }}';
            //     }
            // }

            // Biên dịch lại nội dung bên trong container
            var container = angular.element(document.getElementsByClassName('item_product_main'));
            $compile(container.contents())($scope);

            var popup = angular.element(document.getElementById('popup-cart-mobile'));
            $compile(popup.contents())($scope);

            var quickView = angular.element(document.getElementById('quick-view-product'));
            $compile(quickView.contents())($scope);

            // Đặt mua hàng
            $scope.hasItemInCart = false;
            $scope.cart = cartItemSync;
            $scope.item_qty = 1;
            $scope.quantity_quickview = 1;
            $scope.noti_product = {};

            $scope.addToCart = function (productId, quantity = 1) {
                url = "{{route('cart.add.item', ['productId' => 'productId'])}}";
                url = url.replace('productId', productId);
                let item_qty = quantity;

                if($scope.isAdminClient) {
                    jQuery.ajax({
                        type: 'POST',
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        data: {
                            'qty': parseInt(item_qty)
                        },
                        success: function (response) {
                            if (response.success) {
                                if (response.count > 0) {
                                    $scope.hasItemInCart = true;
                                }

                                $interval.cancel($rootScope.promise);

                                $rootScope.promise = $interval(function () {
                                    cartItemSync.items = response.items;
                                    cartItemSync.total = response.total;
                                    cartItemSync.count = response.count;
                                }, 1000);
                                // toastr.success('Thao tác thành công !')
                                $scope.noti_product = response.noti_product;
                                $scope.$applyAsync();
                                console.log($scope.noti_product);

                                $('#popup-cart-mobile').addClass('active');
                                $('.backdrop__body-backdrop___1rvky').addClass('active');
                                $('#quick-view-product.quickview-product').hide();
                            }
                        },
                        error: function () {
                            toastr.error('Thao tác thất bại !')
                        },
                        complete: function () {
                            $scope.$applyAsync();
                        }
                    });
                } else {
                    window.location.href = "{{route('front.login-client')}}";
                }
            }

            $scope.changeQty = function (qty, product_id) {
                updateCart(qty, product_id)
            }

            $scope.incrementQuantity = function (product) {
                product.quantity = Math.min(product.quantity + 1, 9999);
            };

            $scope.decrementQuantity = function (product) {
                product.quantity = Math.max(product.quantity - 1, 0);
            };

            function updateCart(qty, product_id) {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{route('cart.update.item')}}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        product_id: product_id,
                        qty: qty
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;
                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function(){
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.$applyAsync();
                        }
                    },
                    error: function (e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            // xóa item trong giỏ
            $scope.removeItem = function (product_id) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{route('cart.remove.item')}}",
                    data: {
                        product_id: product_id
                    },
                    success: function (response) {
                        if (response.success) {
                            $scope.cart.items = response.items;
                            $scope.cart.count = Object.keys($scope.cart.items).length;
                            $scope.cart.totalCost = response.total;

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function(){
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            if ($scope.cart.count == 0) {
                                $scope.hasItemInCart = false;
                            }
                            $scope.$applyAsync();
                        }
                    },
                    error: function (e) {
                        jQuery.toast.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            // Xem nhanh
            $scope.quickViewProduct = {};
            $scope.showQuickView = function (productId) {
                $.ajax({
                    url: "{{route('front.get-product-quick-view')}}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        product_id: productId
                    },
                    success: function (response) {
                        $('#quick-view-product .quick-view-product').html(response.html);
                        var quickView = angular.element(document.getElementById('quick-view-product'));
                        $compile(quickView.contents())($scope);
                        $scope.$applyAsync();
                    },
                    error: function (e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function () {
                        $scope.$applyAsync();
                    }
                });
            }

            // Search product
            jQuery('#live-search').keyup(function() {
                var keyword = jQuery(this).val();
                jQuery.ajax({
                    type: 'post',
                    url: '{{route("front.auto-search-complete")}}',
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                    data: {keyword: keyword},
                    success: function(data) {
                        jQuery('.live-search-results').html(data.html);
                    }
                })
            });
        })

        app.factory('cartItemSync', function ($interval) {
            var cart = {items: null, total: null};

            cart.items = @json($cartItems);
            cart.count = {{$cartItems->sum('quantity')}};
            cart.total = {{$totalPriceCart}};

            return cart;
        });

        @if(Session::has('token'))
        localStorage.setItem('{{ env("prefix") }}-token', "{{Session::get('token')}}")
        @endif
        @if(Session::has('logout'))
        localStorage.removeItem('{{ env("prefix") }}-token');
        @endif
        var CSRF_TOKEN = "{{ csrf_token() }}";
        @if (Auth::guard('client')->check())
        const DEFAULT_CLIENT_USER = {
            id: "{{ Auth::guard('client')->user()->id }}",
            fullname: "{{ Auth::guard('client')->user()->name }}"
        };
        @else
        const DEFAULT_CLIENT_USER = null;
        @endif
    </script>
</head>

<body ng-app="App" ng-controller="AppController" ng-cloak>
    <div id="app">
        @include('site.partials.header')
        @yield('content')
        @include('site.partials.footer')
    </div>
    {{-- <a href="https://www.facebook.com/muagimuadi.vn.bylovu/" target="_blank" id="messenger"
        style="right: 16px; bottom: 150px; width: 48px; height: 48px; position: fixed; z-index: 1;">
        <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <rect width="48" height="48" rx="24" fill="#1778F2"></rect>
            <g clip-path="url(#clip0_20_3015)">
                <path
                    d="M24 8C15.1773 8 8 14.8787 8 23.3333C8 27.692 9.94 31.8333 13.3333 34.7467V39.3333C13.334 39.5099 13.4045 39.6791 13.5294 39.804C13.6542 39.9288 13.8234 39.9993 14 40C14.125 40.0003 14.2475 39.9652 14.3533 39.8987L18.0693 37.5773C19.9573 38.3 21.9507 38.6667 24 38.6667C32.8227 38.6667 40 31.788 40 23.3333C40 14.8787 32.8227 8 24 8ZM25.5653 27.84L21.5973 24.4387C21.4951 24.3502 21.3683 24.2952 21.2339 24.2809C21.0995 24.2666 20.9639 24.2937 20.8453 24.3587L14.32 27.9187C14.1786 27.9933 14.0154 28.0154 13.8592 27.9813C13.7031 27.9471 13.564 27.8588 13.4667 27.732C13.3712 27.6034 13.325 27.4448 13.3365 27.285C13.348 27.1253 13.4164 26.975 13.5293 26.8613L21.5293 18.8613C21.7347 18.656 22.0347 18.4853 22.4347 18.8267L26.4027 22.228C26.505 22.3163 26.6318 22.3712 26.7662 22.3855C26.9005 22.3998 27.0361 22.3728 27.1547 22.308L33.68 18.7493C33.8215 18.6753 33.9846 18.6534 34.1406 18.6875C34.2966 18.7217 34.4357 18.8096 34.5333 18.936C34.6288 19.0646 34.675 19.2232 34.6635 19.383C34.652 19.5427 34.5836 19.693 34.4707 19.8067L26.4707 27.8067C26.2653 28.0093 25.9653 28.1813 25.5653 27.84Z"
                    fill="white"></path>
            </g>
            <defs>
                <clipPath id="clip0_20_3015">
                    <rect width="32" height="32" fill="white" transform="translate(8 8)"></rect>
                </clipPath>
            </defs>
        </svg>
    </a> --}}
    {{-- <div id="popup-overlay"></div> --}}
    {{-- <div id="popup">
        <div class="popup-content-wrapper">
            <div class="popup-content position-relative">
                <a href="https://muagimuadi.vn/gia-tot-hom-nay?show=discount">
                    <img src="https://muagimuadi.vn/images/banners/resized/banner-cover-4-4-02_1743737050-1_1743748602.webp"
                        alt="Popup 1" class="img-fluid">
                </a>
                <button id="close-popup" class="btn p-0 m-0 border-0">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div> --}}
    {{-- <div class="autocomplete-suggestions" style="position: absolute; max-height: 300px; z-index: 9999; top: 2925.4px; left: 375.4px; width: 668px;">
        <div class="autocomplete-suggestion" data-index="0">
            <a href="https://muagimuadi.vn/may-tia-long-mui-ae3803-p1081.html" class="d-flex gap-2">
                <img src="https://muagimuadi.vn/images/products/2023/12/14/resized/20230113_PxLeSKGdtKV8UBhG.webp" class="img-fluid">
                <div>
                    <div><b>Máy</b> tỉa lông mũi AE-3803 </div>
                    <div class="text-danger">89.000<sup>₫</sup></div>
                </div>
            </a>
        </div>
    </div> --}}
    <div id="call-to-action-pc">
        <div onclick="window.location.href= 'tel:{{ $config->hotline }}'" class="hotline-phone-ring-wrap">
            <div class="hotline-phone-ring">
                <div class="hotline-phone-ring-circle"></div>
                <div class="hotline-phone-ring-circle-fill"></div>
                <div class="hotline-phone-ring-img-circle">
                    <a href="tel:{{ $config->hotline }}" class="pps-btn-img">
                        <img src="/site/images/phone.png" alt="Gọi điện thoại" width="50" loading="lazy">
                    </a>
                </div>
            </div>
            <a href="tel:{{ $config->hotline }}">
            </a>
            <div class="hotline-bar"><a href="tel:{{ $config->hotline }}">
                </a><a href="tel:{{ $config->hotline }}" style="padding-left: 23px;">
                    <span class="text-hotline">{{ $config->hotline }}</span>
                </a>
            </div>

        </div>
        <div class="inner-fabs">
            @php
                $zalo_chat = json_decode($config->zalo_chat, true);
            @endphp
            @foreach ($zalo_chat as $item)
            <a target="blank" href="https://zalo.me/{{ $item['phone'] }}" class="fabs roundCool" id="chat-fab"
                data-tooltip="{{ $item['title'] }}">
                <img class="inner-fab-icon" src="/site/images/zalo.png" alt="chat-active-icon"
                    border="0" loading="lazy">
            </a>
            @endforeach
        </div>
        <div class="fabs roundCool call-animation" id="main-fab">
            <img class="img-circle" src="/site/images/lienhe.png" alt="" width="135" loading="lazy">
        </div>
    </div>
    <script src="/site/js/callbutton.js"></script>
    <script language="javascript" type="text/javascript" src="/site/js/main.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/owl.carousel.min.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/default.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/banner.js?v=1.74"></script>
    <!-- <script language="javascript" type="text/javascript" src="/js/no-user.js?v=1.74"></script> -->
    <script language="javascript" type="text/javascript" src="/site/js/jquery.autocomplete.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/search.js?v=1.74"></script>
    <script language="javascript" type="text/javascript" src="/site/js/mobile-default.js?v=1.74"></script>
</body>

</html>
