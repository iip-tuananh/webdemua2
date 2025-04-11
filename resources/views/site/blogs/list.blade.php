@extends('site.layouts.master')
@section('title')
    {{ $cate_title }}
@endsection
@section('description')
    {{ $cate_des ?? '' }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/home.css?v=1.74" />
    <style>
        .text-limit-3-line {
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="app-main-content pt-3 pb-3">
        <div class="page-news">
            <div class="container">
                <div class="section-banner d-flex align-items-center gap-3 mb-3">
                    <a href="javascript:void(0)" title="{{ $cate_title }}"
                        class="position-relative d-flex align-items-center justify-content-center">
                        <div class="position-absolute text-white fw-bold fs-1">
                            {{$cate_title}}
                        </div>
                        <img class="img-fluid" alt="{{ $cate_title }}"
                            src="https://muagimuadi.vn/images/banners/resized/banner-tintuc_1726217473_1728469955.webp" loading="lazy">
                    </a>
                </div>
                <div class="section-news">
                    @foreach ($blogs as $key => $blog)
                    @if ($key % 2 == 0)
                        <div class="item-news mb-4 bg-white p-3">
                            <a href="{{ route('front.detail-blog', $blog->slug) }}"
                                title="{{ $blog->title }}"
                                class="overflow-hidden w-100 img">
                                <img src="{{ $blog->image->path }}"
                                    alt="{{ $blog->title }}"
                                    class="img-fluid" loading="lazy">
                            </a>
                            <div class="p-5 w-100">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <span class="fs-5 fw-semibold">{{ $blog->category->name }}</span>
                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="black" />
                                    </svg>
                                    <span class="text-body-tertiary">
                                        {{ $blog->created_at->format('d/m/Y') }} </span>
                                </div>
                                <a href="{{ route('front.detail-blog', $blog->slug) }}"
                                    title="{{ $blog->name }}">
                                    <h3 class="fw-bold fs-2 mb-3">{{ $blog->name }}</h3>
                                    <div class="summary fw-medium text-body-tertiary">{{ $blog->intro }}</div>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="item-news mb-4 bg-white p-3">
                            <a href="{{ route('front.detail-blog', $blog->slug) }}"
                                title="{{ $blog->title }}"
                                class="overflow-hidden w-100 img">
                                <img src="{{ $blog->image->path }}"
                                    alt="{{ $blog->title }}"
                                    class="img-fluid" loading="lazy">
                            </a>
                            <div class="p-5 w-100">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <span class="fs-5 fw-semibold">{{ $blog->category->name }}</span>
                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="black" />
                                    </svg>
                                    <span class="text-body-tertiary">
                                        {{ $blog->created_at->format('d/m/Y') }} </span>
                                </div>
                                <a href="{{ route('front.detail-blog', $blog->slug) }}"
                                    title="{{ $blog->name }}">
                                    <h3 class="fw-bold fs-2 mb-3">{{ $blog->name }}</h3>
                                    <div class="summary fw-medium text-body-tertiary">{{ $blog->intro }}</div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
