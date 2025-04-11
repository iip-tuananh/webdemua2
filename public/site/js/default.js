
$('.section-user-btn').hover(function() {
    let id = $(this).attr('data-hover');
    if ($(`#${id}`).css('display') !== 'block') {
        $('.section-user-tab').fadeOut();
        $(`#${id}`).fadeIn();

        $('.section-user-btn').removeClass('active');
        $(this).addClass('active');
    }
})

$('.owl-flashsale').owlCarousel({
    center: true,
    items: 1,
    loop: false,
    margin: 15,
    nav: true,
    dots: false,
    autoplayHoverPause: true,
});

$('#owl-tiktok').owlCarousel({
    center: false,
    items: 1,
    loop: false,
    margin: 15,
    nav: true,
    dots: true,
    autoWidth: true,
    lazyLoad: true,
});

$('.owl-tiktok-products').owlCarousel({
    autoplay: true,
    center: false,
    items: 1,
    loop: true,
    margin: 12,
    nav: true,
    dots: false,
    lazyLoad: true,
    touchDrag: false,
    mouseDrag: false,
    pullDrag: false,
    freeDrag: false,
});

// const debounce = (mainFunction, delay) => {
//     let timer;
//     return function (...args) {
//         clearTimeout(timer);
//         timer = setTimeout(() => {
//             mainFunction(...args);
//         }, delay);
//     };
// };

// $(window).on('scroll', debounce(function () {
//     let load = $('.loading-scroll');
//     let page = parseInt(load.attr('page')) + 1;
//     let totalCurrent = parseInt(load.attr('total-current'));
//     let total = parseInt(load.attr('total'));
//     let limit = parseInt(load.attr('limit'));

//     if (isElementInViewport($('.loading-scroll')[0]) && totalCurrent < total) {
//         load.fadeIn().append(loadingHtml);
//         load.attr('page', page);
//         load.attr('total-current', totalCurrent + limit);

//         loadMoreContent(page, limit, load);
//     }
// }, 300));

// function isElementInViewport(el) {
//     var rect = el.getBoundingClientRect();
//     return (
//         rect.top >= 0 &&
//         rect.left >= 0 &&
//         rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
//         rect.right <= (window.innerWidth || document.documentElement.clientWidth)
//     );
// }

// function loadMoreContent(page, limit, load) {
//     $.ajax({
//         url: "index.php?module=home&view=home&task=loadMore&raw=1",
//         type: 'GET',
//         data: {page, limit},
//         dataType: 'html',
//         success: function (result) {
//             $(".section-product .products").append(result);
//             load.fadeOut().html('');
//         },
//         error: function (XMLHttpRequest, textStatus, errorThrown) {
//             console.log('Có lỗi trong quá trình đưa lên máy chủ. Xin bạn vui lòng kiểm tra lỗi kết nối.');
//             load.fadeOut().html('');
//         }
//     });
// }

$(".count-down").each(function (e) {
    countdowwn($(this));
});

function countdowwn(element) {
    let x = setInterval(function () {
        let end = new Date(element.attr('time-end')).getTime();
        let now = new Date().getTime();
        let distance = end - now;

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        element.html(`
            <span>${days}</span> Ngày
            :
            <span>${hours}</span>
            :
            <span>${minutes}</span>
            :
            <span>${seconds}</span>
        `);

        if (distance < 0) {
            clearInterval(x), element.html("Đã hết khuyến mại")
        };
    }, 1000);
}