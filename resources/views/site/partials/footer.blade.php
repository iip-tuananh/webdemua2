<footer>
    <div class="container bg-white">
        <div class="footer-top">
            <div class="item">
                <p class="fw-semibold fs-6 mb-2 title">Hỗ trợ khách hàng</p>
                @foreach ($policies as $policy)
                    <div class="mb-2">
                        <a href="{{ route('front.policy-detail', $policy->slug) }}" title="{{$policy->title}}">
                            {{$policy->title}} </a>
                    </div>
                @endforeach
            </div>
            <div class="item">
                <p class="fw-semibold fs-6 mb-2 title">Về chúng tôi</p>
                <div class="mb-2">
                    <a href="{{route('front.about-us')}}"
                        title="Giới thiệu về chúng tôi">
                        Giới thiệu về chúng tôi</a>
                </div>
                <div class="mb-2">
                    <a href="{{route('front.index-blog')}}" title="Tin tức mới nhất">
                        Tin tức mới nhất </a>
                </div>
                <p class="fw-semibold fs-6 mb-2 mt-4 title">Tổng đài hỗ trợ</p>
                <div>Hotline:
                    <a href="tel:{{str_replace(' ', '', $config->hotline)}}">
                        <b>{{$config->hotline}}</b>
                    </a>
                </div>
            </div>
            <div class="item">
                <p class="fw-semibold fs-6 mb-2 title">Phương thức thanh toán</p>
                <img src="/site/images/phuong-thuc-thanh-toan.svg"
                    alt="Phương thức thanh toán" class="img-responsive" loading="lazy">
            </div>
            <div class="item">
                <p class="fw-semibold fs-6 mb-2 title">Chứng nhận</p>
                <a target="_blank" href="javascript:void(0)">
                    <img width="120" src="/site/images/logoSaleNoti.png" alt="" class="img-fluid" loading="lazy">
                </a>
            </div>
            <div class="item">
                <p class="fw-semibold fs-6 mb-2 title">Kết nối với chúng tôi</p>
                <div class="mb-2">
                    <a href="{{$config->facebook}}" title="Facebook"
                        class="d-inline-flex align-items-center gap-2">
                        <img src="/site/images/facebook-circle-icon.svg" alt="Facebook"
                            class="img-fluid" loading="lazy">
                        Fanpage
                    </a>
                </div>
                <div class="mb-2">
                    <a href="{{$config->shopee}}" title="Shopee"
                        class="d-inline-flex align-items-center gap-2">
                        <img src="/site/images/shopee-circle-icon.svg" alt="Shopee"
                            class="img-fluid" loading="lazy">
                        Shopee
                    </a>
                </div>
                <div class="mb-2">
                    <a href="{{$config->tiktok}}" title="Tiktok"
                        class="d-inline-flex align-items-center gap-2">
                        <img src="/site/images/tiktok-circle-icon.svg" alt="Tiktok"
                            class="img-fluid" loading="lazy">
                        Tiktok
                    </a>
                </div>
                <div class="mb-2">
                    <a href="{{$config->youtube}}" title="Youtube" class="d-inline-flex align-items-center gap-2">
                        <img src="/site/images/youtube-circle-icon.svg" alt="Youtube"
                            class="img-fluid" loading="lazy">
                        Youtube
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-1">{{$config->short_name_company}}.</p>
            <p class="mb-1">Địa chỉ: {{$config->address_company}} - Số điện thoại: {{$config->hotline}}</p>
            <p class="mb-0">Copyright © 2025 {{$config->web_title}}</p>
        </div>
    </div>
</footer>