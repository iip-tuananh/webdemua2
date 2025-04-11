@extends('site.layouts.master')
@section('title')
    {{ $config->meta_title ?? $config->web_title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection
@section('css')
<style>
    .gradient-icon {
        display: inline-block;
        width: 24px;
        height: 24px;
        font-size: 24px;
        border-radius: 6px;
        background: linear-gradient(270deg, #d53c00 0%, #dd6333 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection
@section('content')
<div class="app-main-content pt-3 pb-3">
    <div class="page-home">
        <div class="container">
            <div class="d-flex gap-3 section-top mb-3">
                <div class="bg-white section-top-left">
                    <p class="mb-0 pe-3 ps-3 pt-2 pb-2 fs-6 fw-bold">Danh mục</p>
                    <div class="section-menu">
                        @foreach ($productCategories as $category)
                        <a href="{{ route('front.show-product-category', $category->slug) }}" title="{{ $category->name }}"
                            class="ps-3 pe-3 d-flex align-items-center w-100 gap-2 position-relative">
                            @if (isset($category->image))
                            <img width="24" height="24"
                                src="{{ $category->image->path ?? '' }}"
                                alt="{{ $category->name }}" class="img-fluid object-fit-contain img-icon" loading="lazy">
                            <img width="24" height="24"
                                src="{{ $category->image->path ?? '' }}"
                                alt="{{ $category->name }}" class="img-fluid object-fit-contain img-hover" loading="lazy">
                            @else
                                <i class="fa-solid fa-square-minus gradient-icon"></i>
                            @endif
                            {{ $category->name }} </a>
                        @endforeach
                    </div>
                </div>
                <div class="section-top-center">
                    <div class="banner-carousel banner-slide owl-carousel owl-theme">
                        @foreach ($banners as $banner)
                            <div class="item">
                                <a href="{{ $banner->link ?? '' }}"
                                    title="{{ $banner->name }}">
                                    <img class="img-fluid" alt="{{ $banner->name }}"
                                        src="{{ $banner->image->path ?? '' }}" loading="lazy">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="section-icon mt-3 p-3 bg-white d-flex justify-content-between text-center">
                        <div>
                            <img src="/site/images/chiet-khau-san-pham.svg"
                                alt="Chiết khấu sản phẩm" class="img-fluid mb-2" loading="lazy">
                            <div>
                                Chiết khấu <br>
                                sản phẩm
                            </div>
                        </div>
                        <div>
                            <img src="/site/images/mua-si-gia-hoi.svg" alt="Mua sỉ giá hời"
                                class="img-fluid mb-2" loading="lazy">
                            <div>
                                Mua sỉ <br>
                                giá hời
                            </div>
                        </div>
                        <div>
                            <img src="/site/images/voucher-giam.svg"
                                alt="Voucher giảm đến 200k" class="img-fluid mb-2" loading="lazy">
                            <div>
                                Voucher giảm <br>
                                đến 200k
                            </div>
                        </div>
                        <div>
                            <img src="/site/images/qua-tang-hap-dan.svg"
                                alt="Quà tặng hấp dẫn" class="img-fluid mb-2" loading="lazy">
                            <div>
                                Quà tặng <br>
                                hấp dẫn
                            </div>
                        </div>
                        <div>
                            <img src="/site/images/chiet-khau-phi-van-chuyen.svg"
                                alt="Chiết khấu phí vẫn chuyển" class="img-fluid mb-2" loading="lazy">
                            <div>
                                Chiết khẩu <br>
                                phí vẫn chuyển
                            </div>
                        </div>
                        <div>
                            <img src="/site/images/flash-sale-gia-soc.svg"
                                alt="Flash sale giá sốc" class="img-fluid mb-2" loading="lazy">
                            <div>
                                Flash sale <br>
                                giá sốc
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-top-right">
                    <div class="section-user mb-3">
                        <div class="section-user-top">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <img src="/site/images/user-icon.jpg" alt="user"
                                    class="img-fluid" ng-if="!isAdminClient">
                                <img src="{{$user ? $user->image_avatar : ''}}" alt="admin"
                                    class="img-fluid" ng-if="isAdminClient">
                                <div>
                                    <p class="fw-medium">Xin chào quý khách!</p>
                                    <p ng-if="!isAdminClient">Đăng nhập và mua sắm ngay thôi</p>
                                    <p ng-if="isAdminClient"><b><% currentUser.name %></b></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2" ng-if="!isAdminClient">
                                <a href="{{ route('front.login-client') }}" class="text-center p-2 btn-guest btn-login"
                                    title="Đăng nhập">Đăng nhập</a>
                                <a href="{{ route('front.login-client') }}?register=true" class="text-center p-2 btn-guest btn-register"
                                    title="Đăng ký">Đăng ký</a>
                            </div>
                            <div class="d-flex align-items-center gap-2" ng-if="isAdminClient">
                                <a href="{{ route('front.logout-client') }}" class="text-center p-2 btn-guest btn-login"
                                    title="Đăng xuất">Đăng xuất</a>
                            </div>
                        </div>
                        <div class="section-user-center bg-white text-center">
                            <div>
                                <a href="{{route('front.user-order')}}?status=new">
                                    <p class="mb-1 fw-semibold">{{$new_orders}}</p>
                                    Đơn hàng <br> mới
                                </a>
                            </div>
                            <div>
                                <a href="{{route('front.user-order')}}?status=pending">
                                    <p class="mb-1 fw-semibold">{{$pending_orders}}</p>
                                    Đang xử lý
                                </a>
                            </div>
                            <div>
                                <a href="{{route('front.user-order')}}?status=success">
                                    <p class="mb-1 fw-semibold">{{$success_orders}}</p>
                                    Hoàn <br> thành
                                </a>
                            </div>
                            <div>
                                <p class="mb-1 fw-semibold"><% currentUser.point || 0 %></p>
                                Điểm <br> của bạn
                            </div>
                        </div>
                        <div class="section-user-bottom bg-white">
                            <div class="d-flex align-items-center gap-3">
                                <a class="text-center position-relative section-user-btn active"
                                    data-hover="section-user-tab-0">
                                    Khuyến mãi dành cho bạn </a>
                                <a class="text-center position-relative section-user-btn"
                                    data-hover="section-user-tab-1">
                                    Thông tin bảo hành </a>
                            </div>
                            <div class="position-relative">
                                <div class="position-absolute section-user-tab" id="section-user-tab-0">
                                    Quý khách vui lòng đăng nhập để xem ưu đãi!
                                </div>
                                <div class="position-absolute section-user-tab" id="section-user-tab-1"
                                    style="display: none;">
                                    Quý khách vui lòng đăng nhập để kiểm tra bảo hành!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-user-banner">
                        <a href="{{$smallBanner->link ?? ''}}" title="{{$smallBanner->name}}">
                            <img class="img-fluid" alt="{{$smallBanner->name}}"
                                src="{{$smallBanner->image->path ?? ''}}" loading="lazy">
                        </a>
                    </div>
                </div>
            </div>
            <div class="section-sale-tiktok mb-3 d-flex gap-3">
                @if ($categorySpecialFlashsale)
                <div class="bg-white section-item section-sale"
                    style="background-image: url({{getBanner($categorySpecialFlashsale)}}); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    <div class="section-title d-flex align-items-center justify-content-between">
                        <div onclick="window.location.href='{{route('front.show-product-category', $categorySpecialFlashsale->slug)}}'">
                            {{ $categorySpecialFlashsale->name }}
                        </div>
                        <a href="{{route('front.show-product-category', $categorySpecialFlashsale->slug)}}">
                            Xem thêm </a>
                    </div>
                    @php
                        $products = $categorySpecialFlashsale->products ?? collect([]);
                        $productChunks = $products->chunk(9);
                    @endphp
                    <div class="section-sale-list">
                        <div class="owl-flashsale owl-carousel owl-theme">
                            @foreach ($productChunks as $productChunk)
                            <div class="section-sale-owl section-sale-owl-9 d-flex flex-wrap">
                                @foreach($productChunk as $product)
                                <a href="{{route('front.show-product-detail', $product->slug)}}"
                                    title="{{ $product->name }}" class="sale-item">
                                    <div class="position-relative item-image">
                                        <img src="{{$product->image->path ?? ''}}"
                                            alt="{{ $product->name }}" class="img-fluid item-img" loading="lazy">
                                        <img src="{{$product->image->path ?? ''}}" alt="{{ $product->name }}"
                                            class="img-fluid img-gift" loading="lazy">
                                    </div>
                                    <div class="item-name text-center">
                                        @if ($product->base_price > 0)
                                        <del>{{ formatCurrency($product->base_price) }}<sup>₫</sup></del>
                                        @endif
                                        <div>{{ formatCurrency($product->price) }}<sup>₫</sup></div>
                                    </div>
                                    <div class="position-relative ps-2 pe-2 item-progress">
                                        <div class="progress position-relative" role="progressbar"
                                            aria-label="Sold out" aria-valuenow="100" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                            <div class="position-absolute text-white progress-text">
                                                Kèm quà tặng
                                            </div>
                                            <img src="https://muagimuadi.vn/modules/home/assets/images/gift.svg" width="21" height="24" alt="gift" class="img-fluid position-absolute img-hot" style="bottom: 0">
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                <div class="bg-white section-item section-tiktok">
                    <div class="section-title d-flex align-items-center justify-content-between">
                        <div>Video review về sản phẩm</div>
                        <a href="">Xem thêm</a>
                    </div>
                    <div class="owl-carousel owl-theme" id="owl-tiktok">
                        @foreach ($reviews as $review)
                        @php
                            $data_id = basename($review->message);
                        @endphp
                            <div class="item-tiktok item-tiktok-134">
                                <blockquote class="tiktok-embed"
                                    cite="{{$review->message}}"
                                    data-video-id="{{$data_id}}"
                                    style="max-width: 605px; min-width: 325px;">
                                <section>Loading...</section>
                                </blockquote>
                                <div class="item-main">
                                    <a href="{{$review->message}}"
                                        target="_blank" class="item-more">
                                        <i class="fa-solid fa-comment-dots"></i>
                                        <marquee>{{$review->name}}</marquee>
                                        <span>Mua ngay</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @foreach ($categorySpecial as $category)
                <div class="section-banner d-flex align-items-center gap-3 mb-3">
                    <a href="{{route('front.show-product-category', $category->slug)}}" title="banner 1">
                        <img class="img-fluid" alt="banner 1"
                            src="{{$category->image->path ?? ''}}" loading="lazy">
                    </a>
                </div>
                <div class="section-product bg-white mb-3">
                    <div class="mb-2 section-title">{{$category->name}}</div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-0" role="tabpanel"
                            aria-labelledby="nav-0-tab" tabindex="0">
                            <div class="products d-flex flex-wrap product-gap">
                                @foreach ($category->products as $product)
                                    @include('site.products.product_item', ['product' => $product, 'vouchers' => $vouchers])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach ($categorySpecialPost as $category)
                <div class="section-news bg-white mb-3">
                    <div class="mb-2 section-title fs-5">{{$category->name}}</div>
                    <div class="grid-news">
                        @foreach ($category->posts as $post)
                            <a href="{{route('front.detail-blog', $post->slug)}}"
                                title="{{$post->name}}">
                                <div class="item-image">
                                    <img src="{{$post->image->path ?? ''}}"
                                        alt="{{$post->name}}"
                                        class="img-fluid" loading="lazy">
                                </div>
                                <div class="item-name">
                                    {{$post->name}}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="section-slogan d-flex gap-3 align-items-center">
                <div class="section-item bg-white d-flex align-items-center justify-content-center gap-3">
                    <img src="/site/images/san-pham-chinh-hang.svg"
                        alt="Sản phẩm chính hãng" class="img-fluid">
                    <div class="text-uppercase">Sản phẩm <b>chính hãng</b></div>
                </div>
                <div class="section-item bg-white d-flex align-items-center justify-content-center gap-3">
                    <img src="/site/images/bao-hanh-1-1-toan-quoc.svg"
                        alt="Bảo hành 1 đổi 1 toàn quốc" class="img-fluid">
                    <div class="text-uppercase">Bảo hành 1 đổi 1 <b>toàn quốc</b></div>
                </div>
                <div class="section-item bg-white d-flex align-items-center justify-content-center gap-3">
                    <img src="/site/images/hotline-ho-tro.svg"
                        alt="Hotline hỗ trợ {{$config->hotline}}" class="img-fluid">
                    <div class="text-uppercase">Hotline hỗ trợ <b>{{$config->hotline}}</b></div>
                </div>
                <div class="section-item bg-white d-flex align-items-center justify-content-center gap-3">
                    <img src="/site/images/thu-tuc-doi-tra-de-dang.svg"
                        alt="Thủ tục đổi trả dễ dàng" class="img-fluid">
                    <div class="text-uppercase">Thủ tục đổi trả <b>dễ dàng</b></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script async src="https://www.tiktok.com/embed.js"></script>
@endpush
