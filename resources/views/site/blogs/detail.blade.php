@extends('site.layouts.master')
@section('title')
    {{ $blog_title }}
@endsection
@section('description')
    {{ strip_tags($blog->intro) }}
@endsection
@section('image')
    {{ $blog->image->path }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" media="screen" href="/site/css/blog-detail.css?v=1.74" />
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
        <div class="page-news-detail pt-5">
            <div class="container">
                <div class="w-50 mx-auto mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="fs-5 fw-semibold">{{ $blog->category->name }}</span>
                        <svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="4" cy="4" r="4" fill="black" />
                        </svg>
                        <span class="text-body-tertiary">
                            {{ $blog->created_at->format('d/m/Y') }} </span>
                    </div>
                    <h1 class="mb-4 fw-bold fs-1 mb-3">{{ $blog->name }}</h1>
                    <div class="fw-semibold fs-5 mb-3">
                        {{ $blog->intro }}
                    </div>
                    <div class="share d-flex align-items-center gap-3">
                    </div>
                </div>
                <div class="section-content">
                    {!! $blog->body !!}
                </div>
                <hr class="my-4 w-50 mx-auto">
                <h2 class="fs-2 mb-3 fw-bold w-50 mx-auto text-black">Tin Tức Mới Nhất</h2>
                @foreach ($other_blogs as $other_blog)
                    <a href="{{ route('front.detail-blog', $other_blog->slug) }}"
                        title="{{ $other_blog->name }}"
                        class="item-news align-items-center mb-3 w-50 mx-auto">
                        <img src="{{ $other_blog->image->path }}"
                            alt="" class="img-fluid"
                            title="{{ $other_blog->name }}" loading="lazy">
                        <div>
                            <div class="fw-semibold mb-2">{{ $other_blog->category->name }}</div>
                            <div class="title fs-5 fw-bold mb-2">{{ $other_blog->name }}</div>
                            <div class="fw-semibold text-body-tertiary">
                                {{ $other_blog->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
