<div class="header-top bg-white">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="tel:{{ str_replace(' ', '', $config->hotline)}}" class="d-flex align-items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14.6467 12.22C14.6467 12.46 14.5933 12.7067 14.48 12.9467C14.3667 13.1867 14.22 13.4133 14.0267 13.6267C13.7 13.9867 13.34 14.2467 12.9333 14.4133C12.5333 14.58 12.1 14.6667 11.6333 14.6667C10.9533 14.6667 10.2267 14.5067 9.46 14.18C8.69334 13.8533 7.92667 13.4133 7.16667 12.86C6.4 12.3 5.67334 11.68 4.98 10.9933C4.29334 10.3 3.67334 9.57333 3.12 8.81333C2.57334 8.05333 2.13334 7.29333 1.81334 6.54C1.49334 5.78 1.33334 5.05333 1.33334 4.36C1.33334 3.90667 1.41334 3.47333 1.57334 3.07333C1.73334 2.66667 1.98667 2.29333 2.34 1.96C2.76667 1.54 3.23334 1.33333 3.72667 1.33333C3.91334 1.33333 4.1 1.37333 4.26667 1.45333C4.44 1.53333 4.59334 1.65333 4.71334 1.82667L6.26 4.00667C6.38 4.17333 6.46667 4.32667 6.52667 4.47333C6.58667 4.61333 6.62 4.75333 6.62 4.88C6.62 5.04 6.57334 5.2 6.48 5.35333C6.39334 5.50667 6.26667 5.66667 6.10667 5.82667L5.6 6.35333C5.52667 6.42667 5.49334 6.51333 5.49334 6.62C5.49334 6.67333 5.5 6.72 5.51334 6.77333C5.53334 6.82667 5.55334 6.86667 5.56667 6.90667C5.68667 7.12667 5.89334 7.41333 6.18667 7.76C6.48667 8.10667 6.80667 8.46 7.15334 8.81333C7.51334 9.16667 7.86 9.49333 8.21334 9.79333C8.56 10.0867 8.84667 10.2867 9.07334 10.4067C9.10667 10.42 9.14667 10.44 9.19334 10.46C9.24667 10.48 9.3 10.4867 9.36 10.4867C9.47334 10.4867 9.56 10.4467 9.63334 10.3733L10.14 9.87333C10.3067 9.70667 10.4667 9.58 10.62 9.5C10.7733 9.40667 10.9267 9.36 11.0933 9.36C11.22 9.36 11.3533 9.38667 11.5 9.44667C11.6467 9.50667 11.8 9.59333 11.9667 9.70667L14.1733 11.2733C14.3467 11.3933 14.4667 11.5333 14.54 11.7C14.6067 11.8667 14.6467 12.0333 14.6467 12.22Z"
                    stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
            </svg>
            <div>
                Hotline: <b>{{ $config->hotline}}</b>
            </div>
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('front.client-account') }}" class="btn-login" ng-if="!isAdminClient"><i class="fas fa-user"></i> Đăng nhập</a>
            <a href="{{ route('front.logout-client') }}" class="btn-login" ng-if="isAdminClient"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            <span></span>
            <a href="{{ route('front.about-us') }}">Giới thiệu</a>
            <span></span>
            <a href="{{ route('front.index-blog') }}">Tin tức</a>
            <span></span>
            <div>Kết nối</div>
            <a href="{{ $config->facebook }}" title="Facebook">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.2464 3.72483H11.4496V1.68963C10.8671 1.62905 10.2817 1.59915 9.69604 1.60003C7.95524 1.60003 6.76485 2.66243 6.76485 4.60803V6.28482H4.80005V8.56322H6.76485V14.4H9.12004V8.56322H11.0784L11.3728 6.28482H9.12004V4.83203C9.12004 4.16003 9.29924 3.72483 10.2464 3.72483Z"
                        fill="currentColor" />
                </svg>
            </a>
            <a href="{{ $config->shopee }}" title="Shopee">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.54698 5.17217H2.9581C2.65211 5.17217 2.3805 5.42659 2.40113 5.73258L2.92372 12.9732C2.97873 13.7571 3.46694 14.4 4.38834 14.4H11.794C12.6226 14.4 13.1933 13.8808 13.2586 12.9732L13.7778 5.72914C13.8018 5.42315 13.5268 5.17217 13.2208 5.17217H10.6353C10.5563 4.29546 10.3122 3.5047 9.96148 2.8996C9.4939 2.09852 8.83723 1.6 8.09116 1.6C7.3451 1.6 6.68499 2.09508 6.22084 2.8996C5.87016 3.50814 5.62605 4.29546 5.54698 5.17217ZM9.98211 5.17217H6.19334C6.27241 4.41579 6.4787 3.73849 6.77781 3.22622C7.1285 2.62111 7.59264 2.24636 8.09116 2.24636C8.58625 2.24636 9.05383 2.62111 9.39764 3.22278C9.69675 3.73849 9.90647 4.41236 9.98211 5.17217ZM6.14177 11.4948C6.05925 11.6151 6.09019 11.7767 6.21053 11.8593C6.30336 11.9246 6.39275 11.9796 6.4787 12.0277C7.16632 12.4472 7.81955 12.6535 8.37996 12.6535C8.97819 12.65 9.46983 12.4162 9.78958 11.9452C9.7915 11.942 9.79354 11.9386 9.79572 11.9349C9.80525 11.9188 9.81748 11.8982 9.83427 11.873C9.92366 11.7286 9.98899 11.5808 10.0302 11.4329C10.1231 11.1029 10.1059 10.7659 9.96836 10.4462C9.83427 10.1368 9.58329 9.85141 9.20854 9.6245C8.98163 9.48697 8.70658 9.37008 8.3834 9.27725C7.78517 9.10878 7.35541 8.89218 7.14913 8.6137C6.97034 8.37303 6.96691 8.05673 7.18694 7.65447C7.31759 7.41381 7.61327 7.26253 8.00177 7.23159C8.40746 7.20064 8.89567 7.30035 9.40795 7.56164C9.5386 7.6304 9.69331 7.57883 9.76207 7.44819C9.83083 7.31754 9.77926 7.15939 9.64862 7.09406C9.04695 6.78807 8.4556 6.67118 7.96395 6.709C7.39323 6.75369 6.94284 7.00467 6.7228 7.40693C6.39275 8.01547 6.41681 8.51743 6.72624 8.93344C7.00816 9.31163 7.53075 9.59355 8.239 9.79296C8.51748 9.8686 8.74784 9.9683 8.93349 10.0818C9.21198 10.2502 9.39076 10.4531 9.48359 10.6628C9.56954 10.8622 9.57985 11.0822 9.51797 11.2954C9.48702 11.3985 9.44233 11.5051 9.38044 11.6048C9.37868 11.6101 9.37421 11.6163 9.36842 11.6243C9.36291 11.632 9.35621 11.6412 9.3495 11.653C9.1329 11.9727 8.79253 12.1309 8.37308 12.1309C7.90894 12.1309 7.35197 11.9486 6.74687 11.5808C6.66092 11.5292 6.58184 11.4776 6.5062 11.4261C6.38587 11.3435 6.22428 11.3745 6.14177 11.4948Z"
                        fill="currentColor" />
                </svg>
            </a>
            <a href="{{ $config->tiktok }}" title="Tiktok">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.7289 7.08739V4.8531C12.6825 4.8531 11.884 4.57381 11.3687 4.03097C10.8398 3.41145 10.5435 2.62689 10.5308 1.81241V1.65113L8.41846 1.59999V10.6749C8.346 11.0708 8.1538 11.435 7.86781 11.7182C7.58182 12.0015 7.21581 12.1902 6.81919 12.2588C6.42256 12.3274 6.01443 12.2727 5.64988 12.1021C5.28533 11.9314 4.98193 11.653 4.78062 11.3044C4.57931 10.9559 4.48979 10.5539 4.52416 10.1529C4.55852 9.75185 4.7151 9.371 4.97277 9.06176C5.23044 8.75252 5.57678 8.52979 5.96505 8.42362C6.35332 8.31746 6.76481 8.33298 7.14397 8.46809V6.3046C6.9229 6.26838 6.69928 6.24996 6.47526 6.24953C5.66925 6.24953 4.88135 6.48854 4.21118 6.93633C3.54101 7.38413 3.01868 8.02059 2.71023 8.76524C2.40179 9.50989 2.32109 10.3293 2.47833 11.1198C2.63557 11.9103 3.0237 12.6365 3.59363 13.2064C4.16356 13.7763 4.8897 14.1644 5.68022 14.3217C6.47074 14.4789 7.29013 14.3982 8.03478 14.0898C8.77943 13.7813 9.41589 13.259 9.86369 12.5888C10.3115 11.9187 10.5505 11.1308 10.5505 10.3248C10.55 10.1578 10.5395 9.99093 10.519 9.82519V6.22593C11.4795 6.82579 12.5971 7.12571 13.7289 7.08739Z"
                        fill="currentColor" />
                </svg>
            </a>
            <a href="{{ $config->youtube }}" title="Youtube">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.397 6.36989C14.4258 5.53763 14.2438 4.7116 13.8679 3.96849C13.6129 3.66358 13.259 3.45781 12.8678 3.38704C11.2499 3.24024 9.62537 3.18007 8.00106 3.20679C6.38268 3.17886 4.76396 3.23709 3.15176 3.38123C2.83302 3.43921 2.53805 3.58871 2.30284 3.8115C1.77954 4.29411 1.72139 5.11977 1.66325 5.81751C1.57889 7.07203 1.57889 8.33079 1.66325 9.58531C1.68007 9.97803 1.73854 10.3678 1.83768 10.7482C1.90779 11.0419 2.04963 11.3136 2.25051 11.539C2.48732 11.7736 2.78916 11.9316 3.11687 11.9925C4.37043 12.1473 5.63352 12.2114 6.89631 12.1844C8.93139 12.2135 10.7164 12.1844 12.8271 12.0216C13.1629 11.9644 13.4732 11.8062 13.7167 11.5681C13.8795 11.4052 14.0011 11.2059 14.0714 10.9866C14.2794 10.3485 14.3815 9.68073 14.3738 9.00968C14.397 8.68406 14.397 6.71876 14.397 6.36989ZM6.68698 9.35855V5.75936L10.1292 7.56768C9.16397 8.10261 7.89059 8.70732 6.68698 9.35855Z"
                        fill="currentColor" />
                </svg>
            </a>
        </div>
    </div>
</div>
<header class="bg-white">
    <div class="container header-container d-flex align-items-center justify-content-between">
        <a href="{{ route('front.home-page') }}" title="muagimuadi.vn">
            <img src="{{$config->image->path ?? ''}}" width="145" height="48.5"
                alt="{{$config->web_title}}" class="img-fluid img-logo" loading="lazy">
        </a>
        <div class="heder-center">
            <form action="{{ route('front.search') }}" id="site-search" method="GET"
                class="position-relative d-flex align-items-center">
                <input type="text" class="form-control" name="keyword"
                    placeholder="Hôm nay bạn cần tìm gì?" required>
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.1777 18.3333L17.511 16.6667M18.3443 9.58333C18.3443 13.9556 14.7999 17.5 10.4277 17.5C6.0554 17.5 2.51099 13.9556 2.51099 9.58333C2.51099 5.21108 6.0554 1.66667 10.4277 1.66667C14.7999 1.66667 18.3443 5.21108 18.3443 9.58333Z"
                        stroke="#A3A3A3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <button class="btn fw-semibold" type="submit">Tìm kiếm</button>
            </form>
        </div>
        <div class="header-right d-flex align-items-center justify-content-end">
            <a href="{{ route('cart.index') }}" title="Giỏ hàng" class="header-cart position-relative">
                <div
                    class="cart-quantity cart-text-quantity position-absolute d-flex align-items-center justify-content-center fw-bold">
                    <% cart.count || 0 %></div>
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M32.1973 28.5021L35.7527 19.5697C36.1743 18.5099 36.054 17.4068 35.4136 16.4629C34.7731 15.5191 33.7924 15 32.6525 15H11.5627H9.92425H4.82031C4.36735 15 4 15.3674 4 15.8203C4 16.2744 4.36735 16.6406 4.82031 16.6406H10.5777L15.2991 28.501C15.8149 29.7971 17.0047 30.6033 18.3983 30.6033H29.097C30.4917 30.6033 31.6815 29.7971 32.1962 28.501L32.1973 28.5021ZM18.3994 33.2539C19.7312 33.2539 20.8105 34.3332 20.8105 35.6639C20.8105 36.9957 19.7312 38.075 18.3994 38.075C17.0687 38.075 15.9894 36.9957 15.9894 35.6639C15.9894 34.3332 17.0687 33.2539 18.3994 33.2539ZM29.0981 33.2539C30.4299 33.2539 31.5092 34.3332 31.5092 35.6639C31.5092 36.9957 30.4299 38.075 29.0981 38.075C27.7663 38.075 26.687 36.9957 26.687 35.6639C26.687 34.3332 27.7663 33.2539 29.0981 33.2539Z"
                        fill="#D53C00" />
                </svg>
            </a>
            <div class="cart-hover">
                <div class="cart-hover-header">Sản phẩm mới thêm</div>
                <div class="cart-hover-body">
                    <a ng-href="/san-pham/<% item.attributes.slug %>.html" class="cart-hover-item" ng-repeat="item in cart.items">
                        <img ng-src="<% item.attributes.image %>" alt="<% item.name %>" class="img-fluid">
                        <div>
                        <div class="mb-1"><% item.name %> <span class="cart-text-quantity text-danger"> x <% item.quantity %></span></div>
                        <div class="sub-name" ng-repeat="attribute in item.attributes.attributes">
                            <span class="cart_attribute_name" style="margin-left: 8px; font-weight: 600; font-size: 14px;"><% attribute.name %> :</span>
                            <span class="cart_attribute_value" style="font-size: 14px;"><% attribute.value %></span>
                        </div>
                        </div>
                        <div class="item-price">
                            <% item.price | number %><sup>₫</sup>
                        </div>
                    </a>
                </div>
                <div class="d-flex align-items-center justify-content-between cart-hover-footer">
                    <div>Có <b class="cart-text-quantity"><% cart.count || 0 %></b> sản phẩm</div>
                    <a href="{{ route('cart.checkout') }}">Xem giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="menu_mobile">
    <div class="menu_cat">
        @foreach ($productCategories as $item)
        <a href="{{ route('front.show-product-category', $item->slug) }}" title="{{ $item->name }}"
            class="ps-3 pe-3 d-flex align-items-center w-100 gap-2 position-relative">
            @if (isset($item->image))
            <img width="24" height="24"
                src="{{ $item->image->path ?? '' }}"
                alt="{{ $item->name }}" class="img-fluid object-fit-contain img-icon">
            <img width="24" height="24"
                src="{{ $item->image->path ?? '' }}"
                alt="{{ $item->name }}" class="img-fluid object-fit-contain img-hover">
            @else
            <i class="fa-solid fa-square-minus gradient-icon"></i>
            @endif
            {{ $item->name }} </a>
        @endforeach
    </div>
    <div class="member_menu">
        <a href="{{ route('front.client-account') }}">
            Tài khoản của tôi </a>
        {{-- <a href="{{ route('front.order-history') }}">
            Đơn hàng của tôi </a>
        <a href="{{ route('front.member-level') }}">
            Hạng thành viên </a> --}}
        <a href="{{ route('front.logout-client') }}">
            Đăng xuất </a>
    </div>
    <ul class="list_menu_mobile">
        <li>
            <a href="{{ route('front.home-page') }}">
                <i class="fa-solid fa-house"></i>
                <span>Trang chủ</span>
            </a>
        </li>
        <li>
            <a class="cat_prd" href="javascript:void(0)">
                <i class="fa-solid fa-list"></i>
                <span>Danh mục</span>
            </a>
        </li>
        <li>
            <a href="{{ route('front.index-blog') }}">
                <i class="fa-solid fa-newspaper"></i>
                <span>Tin tức</span>
            </a>
        </li>
    </ul>
</div>