
// const debounce = (mainFunction, delay) => {
//     let timer;
//     return function (...args) {
//         clearTimeout(timer);
//         timer = setTimeout(() => {
//             mainFunction(...args);
//         }, delay);
//     };
// };

$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    asNavFor: '.slider-nav'
}).on('afterChange', function(event, slick, currentSlide){
    if (screen.width > 1024) {
        let element = $('.slider-for .slick-slide.slick-current.slick-active img');
        let ez = $('#ez-image').data('ezPlus');

        if (element.length) {
            let src = element.attr('src')
            let zoom = element.attr('data-zoom-image')

            // $('#ez-image').attr('src', src).attr('data-zoom-image', zoom).ezPlus();
            ez.changeState('enable')
            ez.showHideZoomContainer('show')
            ez.showHideWindow('show')
            ez.showHideLens('show')
            ez.showHideTint('show')
            ez.swaptheimage(src, zoom);
        } else {
            ez.changeState('disable')
            ez.showHideZoomContainer('hide')
            ez.showHideWindow('hide')
            ez.showHideLens('hide')
            ez.showHideTint('hide')
        }
    }
});

$('.slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    margin: 1,
    dots: false,
    arrows: true,
    centerMode: false,
    focusOnSelect: true,
    vertical: true,
    verticalSwiping: true,
    prevArrow: '<button class="slick-prev"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 7.5L10 12.5L5 7.5" stroke="white" stroke-linecap="round" stroke-linejoin="round"/></svg></button>',
    nextArrow: '<button class="slick-next"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 12.5L10 7.5L5 12.5" stroke="white" stroke-linecap="round" stroke-linejoin="round"/></svg></button>',
    responsive: [
        {
            breakpoint: 500,
            settings: {
                vertical: false,
                verticalSwiping: false,
            }
        }
    ]
});

$('.slider-related').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    arrows: true,
    infinite: false,
    prevArrow: '<button class="slick-prev"><svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 21L1 11L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>',
    nextArrow: '<button class="slick-next"><svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 21L11 11L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>'
})

if (screen.width > 1024) {
    $('#ez-image').ezPlus()
}

$(document).ready(function(){
    if (screen.width > 1024) {
        let element = $('.slider-for .slick-slide.slick-current.slick-active video')
        if (element.length) {
            setTimeout(function(){
                let ez = $('#ez-image').data('ezPlus');
                ez.changeState('disable')
                ez.showHideZoomContainer('hide')
                ez.showHideWindow('hide')
                ez.showHideLens('hide')
                ez.showHideTint('hide')
            }, 1000)

        }
    }
})

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
            <span>${days}</span>
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

$('.p-type').click(function (e) {
    e.preventDefault();
    let data = $(this).attr('data');
    let price = $(this).attr('price-format');
    let priceOld = $(this).attr('price-old-format');
    let priceDiscount = $(this).attr('price-discount-format');
    let quantity = $(this).attr('quantity');

    if (data && data != '0') {
        $('.slider-nav').slick('slickGoTo', data);
    }

    $('#order-quantity').attr('max', quantity)

    $('.p-type').removeClass('active');
    $(this).addClass('active');

    $('.p-price-public').html(price);
    $('.p-price-origin').html(priceOld);
    $('.p-price-discount').html(priceDiscount);
})

$(document).ready(function(){
    if ($('.p-type').length) {
        $('.p-type.active').click()
    }
})

$('.btn-more-less').click(function() {
    $(this).toggleClass('less');
    $('.description-main').toggleClass('less');
})

$('.comment-filter').click(function (e) {
    e.preventDefault();
    let data = $(this).attr('data-filter');

    $('.comment-filter').removeClass('active');
    $(this).addClass('active');

    if (data != 0) {
        $('.item-comment').hide();
        $('.item-comment.filter-' + data).show();
    } else {
        $('.item-comment').show();
    }
})

$('.more-comment').click(function (e) {
    e.preventDefault();
})

// $('.add-cart.available').click(function (e) {
//     e.preventDefault();

//     addCart();
// })

// $('.buy-now.available').click(async function (e) {
//     e.preventDefault();
//     let url = $(this).attr('href');

//     await addCart(url);

//     // location.href = url;
// })

// async function addCart(url = null) {
//     let image = $('.slider-for .slick-active img').attr('src');
//     let product = parseInt($('#product').val());

//     let price = parseInt($('.p-type.active').attr('data-price'));
//     let price_origin = parseInt($('.p-type.active').attr('data-price-origin'));
//     let price_old = parseInt($('.p-type.active').attr('data-price-old'));
//     let sub = parseInt($('.p-type.active').attr('data-sub'));

//     let quantity = $('#order-quantity').val();
//     let quantityMax = $('#order-quantity').attr('max');

//     if (!parseInt(quantity)) {
//         flashMessage(true, "Vui lòng nhập số!");
//         $('#order-quantity').focus()
//         return false;
//     }

//     if (parseInt(quantity) <= 0) {
//         flashMessage(true, "Số lượng đặt sản phẩm tối thiểu là 1!");
//         $('#order-quantity').focus()
//         return false;
//     }

//     if (parseInt(quantity) > parseInt(quantityMax)) {
//         flashMessage(true, "Số lượng đặt sản phẩm tối đa là " + quantityMax + "!");
//         $('#order-quantity').focus()
//         return false;
//     }

//     quantity = quantity ? parseInt(quantity) : 1;

//     $.ajax({
//         url: "index.php?module=products&view=cart&task=addCart&raw=1",
//         type: 'POST',
//         data: { product, sub, quantity, price, image, price_old, price_origin, token },
//         dataType: 'JSON',
//         success: function (result) {
//             console.log(result)
//             flashMessage(result.error, result.message);
//             $('header .cart-text-quantity').text(result.total);
//             if (result.newItem) {
//                 let image = $('.slick-slide.slick-current.slick-active img').attr('src');
//                 let name = $('h1.p-name').text();
//                 let sub_name = $('.p-choose.p-type.active').text();
//                 let price = $('.p-price-public').html();

//                 // $('.cart-hover-body').append(`
//                 //     <a href="${result.newItem.url}" class="cart-hover-item">
//                 //         <img src="${result.newItem.image}" alt="${result.newItem.product_name}" class="img-fluid">
//                 //         <div>
//                 //             <div class="mb-1">${result.newItem.product_name}</div>
//                 //             <div class="sub-name">${result.newItem.sub_name}</div>
//                 //         </div>
//                 //         <div class="item-price">
//                 //             <span>₫</span>${result.newItem.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}
//                 //         </div>
//                 //     </a>
//                 // `)

//                 $('.cart-hover-body').append(`
//                     <a href="${window.location.href}" class="cart-hover-item">
//                         <img src="${image}" alt="${name}" class="img-fluid">
//                         <div>
//                             <div class="mb-1">${name}</div>
//                             <div class="sub-name">${sub_name}</div>
//                         </div>
//                         <div class="item-price">
//                             ${price}
//                         </div>
//                     </a>
//                 `)
//             }

//             if (url) {
//                 location.href = url
//             }
//         },
//         error: function (XMLHttpRequest, textStatus, errorThrown) {
//             console.log('Có lỗi trong quá trình đưa lên máy chủ. Xin bạn vui lòng kiểm tra lỗi kết nối.');
//             return false;
//         }
//     });
// }

// $('.add-like.no-add').click(function (e) {
//     e.preventDefault()
//     let product_id = $('#product').val();

//     $.ajax({
//         url: "index.php?module=members&view=favorite&task=addFavorite&raw=1",
//         type: 'POST',
//         data: { product_id, token },
//         dataType: 'JSON',
//         success: function (result) {
//             console.log(result)
//             flashMessage(result.error, result.message);

//             if (!result.error) {
//                 $('.add-like.no-add').addClass('added').removeClass('no-add');
//             }
//         },
//         error: function (XMLHttpRequest, textStatus, errorThrown) {
//             console.log('Có lỗi trong quá trình đưa lên máy chủ. Xin bạn vui lòng kiểm tra lỗi kết nối.');
//         }
//     });
// })

$('.pre-order-submit').click(function(e){
    e.preventDefault()

    let tel = $('#tel').val();
    let name = $('#name').val();
    let address = $('#address').val();

    $('.label_error').remove()

    if (!name.trim()){
        invalid('name', 'Vui lòng nhập họ tên của bạn!')
        return false;
    }

    if (!tel.trim()){
        invalid('tel', 'Vui lòng nhập số điện thoại của bạn!')
        return false;
    }

    if (!regexTelephone.test(tel)){
        invalid('tel', 'Số điện thoại chưa đúng định dạng!')
        return false;
    }

    if (!address.trim()){
        invalid('address', 'Vui lòng nhập địa chỉ của bạn!')
        return false;
    }

    $('.pre-order-form').submit()
})



/**
 * start pre order js
 */
addSelect2()

function addSelect2() {
    $('.form-select2').each(function(){
        let idModal = $(this).closest('.modal').attr('id');
        if (idModal == undefined) {
            idModal = $(this).closest('form').attr('id');
        }
        $(this).select2({
            dropdownParent: $('#' + idModal),
        })
    })
}

$(document).on('change', '.form-province', function(){
	let code = $(this).val();
    let idModal = $(this).closest('.modal').attr('id');
    if (idModal == undefined) {
        idModal = $(this).closest('form').attr('id');
    }
    if (code != 0 || code != '') {
        loadDistrict(code, idModal, $(this));
    }
})

$(document).on('change', '.form-district', function(){
	let code = $(this).val();
    let idModal = $(this).closest('.modal').attr('id');
    if (idModal == undefined) {
        idModal = $(this).closest('form').attr('id');
    }

    if (code != 0 || code != '') {
        loadWard(code, idModal, $(this));
    }
})

function loadDistrict(code, idModal, element){
	$.ajax({
        url: "index.php?module=products&view=cart&task=loadDistrict&raw=1",
        type: 'POST',
        data: {code},
        dataType: 'JSON',
        success: function (result) {
			let pills = [];
			result.forEach(function(item, index){
				pills.push({id: item.code, text: item.full_name});
			})
			element.closest('form').find('.form-district').empty().select2({
                dropdownParent: $('#' + idModal),
				data: pills
			});
            if (pills[0].id) {
                loadWard(pills[0].id, idModal, element)
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('Có lỗi trong quá trình đưa lên máy chủ. Xin bạn vui lòng kiểm tra lỗi kết nối.');
        }
    });
}

function loadWard(code, idModal, element){
	$.ajax({
        url: "index.php?module=products&view=cart&task=loadWard&raw=1",
        type: 'POST',
        data: {code},
        dataType: 'JSON',
        success: function (result) {
			let pills = [];
			result.forEach(function(item, index){
				pills.push({id: item.code, text: item.full_name});
			})
			element.closest('form').find('.form-ward').empty().select2({
                dropdownParent: $('#' + idModal),
				data: pills
			});
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('Có lỗi trong quá trình đưa lên máy chủ. Xin bạn vui lòng kiểm tra lỗi kết nối.');
        }
    });
}

$('.pre-quantity').change(async function(){
    await loadPreOrder()
})

$('.plus-pre-order').click(async function(){
    await loadPreOrder()
})

$('.subtract-pre-order').click(async function(){
    await loadPreOrder()
})

function formatMoney(amount = null) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
}

loadPreOrder()

async function preOrder(voucher = null){
    let quantity = $('.pre-quantity').val()
    let product_id = $('input[name="product_id"]').val()
    let sub_id = $('input[name="product_sub_id"]:checked').val()
    sub_id = sub_id ? sub_id : 0
    if (quantity && product_id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "index.php?module=products&view=product&task=ajaxPreOrder&raw=1",
                type: 'POST',
                data: {quantity, product_id, sub_id, voucher, token},
                dataType: 'JSON',
                success: function (result) {
                    resolve(result)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log('Có lỗi trong quá trình đưa lên máy chủ. Xin bạn vui lòng kiểm tra lỗi kết nối.')
                    reject(errorThrown)
                }
            })
        })
    } else {
        return null
    }
}

$('.add-voucher').click(async function(e){
    e.preventDefault()

    let voucher = $('input[name=voucher]').val().trim()

    if (!voucher) {
        flashMessage(true, "Vui lòng nhập mã voucher")
        $('input[name=voucher]').focus()

        return
    }

    let orderData = await preOrder(voucher)

    loadPreOrder(orderData)
})

async function loadPreOrder(data = null) {
    if (!data) {
        data = await preOrder()
    }

    if (data) {
        let order = data.data

        if (!data.code) {
            flashMessage(!data.code, data.message);
        }

        let html = ``
        let htmlAmount = `
            <div class="mb-2">
                <span class="text-secondary-emphasis">Tạm tính:</span>
                <span class="pre-price fw-bold">
                    ${formatMoney(order.amount_before)}
                </span>
            </div>

            ${order?.promotion_discount ? `
                <div class="mb-2">
                    <span class="text-secondary-emphasis">Chiết khấu/ Flashsale:</span>
                    <span class="pre-price fw-bold">
                        - ${formatMoney(order.promotion_discount)}
                    </span>
                </div>
            ` : `` }

            ${order?.promotion_wholesale ? `
                <div class="mb-2">
                    <span class="text-secondary-emphasis">Mua sỉ giá hời:</span>
                    <span class="pre-price fw-bold">
                        - ${formatMoney(order.promotion_wholesale)}
                    </span>
                </div>
            ` : `` }

            <div class="mb-2">
                <span class="text-secondary-emphasis">Mã giảm giá/ Thẻ quà tặng:</span>
                <span class="pre-price fw-bold">
                    - ${formatMoney(order.amount_voucher)}
                </span>
            </div>

            <div class="mb-2">
                <span class="text-secondary-emphasis">Phí ship:</span>
                <span class="pre-price mb-2 fw-bold">
                    ${formatMoney(order.amount_ship)}
                </span>
            </div>

            <div class="">
                <span class="text-secondary-emphasis">Tổng thanh toán:</span>
                <span class="pre-price fw-bold" style="color: #d53c00;font-size: 30px;">
                    ${formatMoney(order.amount)}
                </span>
            </div>
        `

        if (order?.gift && order?.gift.length) {
            order.gift.forEach(function(item){
                let option
                if (item?.sub && item?.sub.length) {
                    let optionSub = item.sub.map(function(itemSub){
                        return `<option value="${itemSub.id}">${itemSub.name}</option>`
                    })
                    option = `
                        <select name="product_gift_sub[]" id="" class="form-control select-gift">
                            ${optionSub}
                        </select>
                    `
                } else {
                    option = `<input type="hidden" name="product_gift_sub[]" value="0">`
                }
                html += `
                    <div class="cart-item cart-item-gift ps-3 pe-3 pt-1 pb-1 gap-3 mb-3">
                        <a href="${item.url}">
                            <img src="${item.image}" alt="${item.name}" class="img-fluid">
                        </a>
                        <div class="product-name">
                            <a href="${item.url}">
                                <span class="text-gift">Quà tặng</span> ${item.name}
                            </a>
                            <div class="mt-2">x1</div>
                        </div>
                        <div class="d-flex align-items-start justify-content-end">
                            ${option}
                        </div>
                    </div>
                `
            })
        }

        if (order?.giftNext && order?.giftNext.length) {
            html += `
                <div class="text-danger mb-2 fst-italic">
                    Mua thêm <b>${order.giftNext[0]}</b> sản phẩm để nhận quà tặng hấp dẫn
                </div>
            `
        }

        if (order?.wholesaleNext && order?.wholesaleNext.length) {
            html += `
                <div class="text-danger mb-2 fst-italic">
                    Mua thêm <b>${parseInt(order.wholesaleNext[0].quantity) - parseInt(order.quantity)}</b> sản phẩm được giảm <b>${order.wholesaleNext[0].percent}</b>% giá trị sản phẩm
                </div>
            `
        }

        $('.pre-promotion').html(html)
        $('.pre-amount').html(htmlAmount)
    }
}

$('#modalVoucher').on('hide.bs.modal', function (e) {
    $('#preOrderModal').modal('show')
})

$('.btn-select-voucher').click(function(e){
    e.preventDefault()

    let voucher = $(this).attr('data')

    $('#modalVoucher').modal('toggle')

    $('#voucher').val(voucher)

    $('.add-voucher').click()
})
/**
 * end pre order js
 */