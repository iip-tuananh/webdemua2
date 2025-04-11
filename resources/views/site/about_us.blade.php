@extends('site.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection

@section('css')
<link rel="stylesheet" type="text/css" media="screen" href="/site/css/detail.css?v=1.74" />
@endsection

@section('content')
    <div class="app-main-content pt-3 pb-3">
        <main>
            <div class="container">
                <div class="main-content" id="main_content">
                    <div class="menu-left">
                        <h2 class="h2_c" id="h2_c">Về chúng tôi</h2>
                        <ul class="list ul-grid">
                            <li class="item {{ Route::is('front.about-us') ? 'active' : '' }}">
                                <a href="{{route('front.about-us')}}">
                                    Giới thiệu về chúng tôi </a>
                            </li>
                        </ul>
                        <h2 class="h2_c" id="h2_c">Hỗ trợ khách hàng</h2>
                        <ul class="list ul-grid">
                            @foreach ($policies as $policy)
                                <li class="item {{ Route::is('front.policy-detail', $policy->slug) ? 'active' : '' }}">
                                    <a href="{{route('front.policy-detail', $policy->slug)}}">
                                        {{$policy->title}} </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="content-right">
                        <div class="top">
                            <h2>{{ $title }}</h2>
                            <a class="see_more" href="#footer-top">Xem thêm</a>
                        </div>
                        <div class="content__">
                            {!! $content !!}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('script')
@endpush
