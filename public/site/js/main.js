const regexTelephone = /^0[0-9]{9}$/;
const regexEmail = /^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/;
const token = $('#csrf-token').val();

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
const loadingio = '<div class="loadingio-spinner"><div class="ldio"><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div></div>';

const delayTime = 5000 // 5 seconds
const repeatTime = 3600000 * 2; // 2 hours

$(document).ready(function () {
    let lastClosed = localStorage.getItem("popupClosedAt")

    if (!lastClosed || (Date.now() - lastClosed) > repeatTime) {
        setTimeout(function () {
            $("#popup-overlay, #popup").fadeIn()
        }, delayTime)
    }
    
    $("#close-popup, #popup, #popup-overlay").click(function () {
        $("#popup-overlay, #popup").fadeOut()
        localStorage.setItem("popupClosedAt", Date.now())
    })
})

function flashMessage(error, message){
    error = error ? 'error' : 'success';
    let time = 800;

    $('#flash-message .message').html(message);
    $('#flash-message-container').fadeIn().delay(time).fadeOut();
    $('#flash-message').addClass(error);

    setTimeout(function(){
        $('#flash-message').removeClass(error);
    }, time + 800);
}

function loading(){
    if ($('.loadingio').length) {
        $('.loadingio').remove()
    } else {
        $('body').append(`<div class="loadingio position-fixed top-0 left-0 w-100 h-100 z-3 d-flex align-items-center justify-content-center">${loadingio}</div>`)
    }
}

$('.number-only').on('input', function(){
    let oldValue = $(this).val();
	let newValue = $(this).val().replace(/[^0-9]/g, oldValue);
	// newValue = newValue ? newValue : 1;
	newValue = newValue ? newValue : 1;
    $(this).val(newValue);
});

$(document).on("click", ".plus", function () {
    var oldValue = $(this).prev('input').val();
    oldValue = oldValue ? oldValue : 1;
    var newVal = parseFloat(oldValue) + 1;
    $(this).prev('input').val(newVal);
});

$(document).on("click", ".subtract", function () {
    var oldValue = $(this).next('input').val();
    oldValue = oldValue > 1 ? parseFloat(oldValue) : 2;
    var newVal = oldValue - 1;
    $(this).next('input').val(newVal);
});

$('.toggle-password').click(function(e) {
    e.preventDefault(); 

    if ($(this).prev('input').attr('type') === 'text') {
        $(this).prev('input').attr('type', 'password');
        $(this).find('svg:nth-child(2)').hide()
        $(this).find('svg:nth-child(1)').show()
    } else {
        $(this).prev('input').attr('type', 'text');
        $(this).find('svg:nth-child(2)').show()
        $(this).find('svg:nth-child(1)').hide()
    }
})

$('.btn-upload-image').click(function(e) {
    e.preventDefault();
    $(this).prev('.input-upload-image').click();
})

$(document).on('change', '.input-upload-image', function() {
    readURL(this);
})

function readURL(input) {
    if(input.nextElementSibling.nextElementSibling.nextElementSibling) {
        input.nextElementSibling.nextElementSibling.nextElementSibling.remove()
    }
    if (input.files && input.files[0]) {
        //Giới hạn file <= 1Mb
        if (input.files[0].size > 1048576) {
            invalid(input.id, 'Vui lòng nhập ảnh kích thước không quá 1 MB')
            return false;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            input.previousElementSibling.src = e.target.result
        };
        reader.readAsDataURL(input.files[0]);
    }
}

const debounce = (mainFunction, delay) => {
    let timer
    return function (...args) {
        clearTimeout(timer)
        timer = setTimeout(() => {
            mainFunction(...args)
        }, delay)
    }
}

$('.add-like.no-add').click(function (e) {
    e.preventDefault()
    const _this = $(this)
    let product_id = _this.attr('product-id') ? _this.attr('product-id') : $('#product').val()

    $.ajax({
        url: "index.php?module=members&view=favorite&task=addFavorite&raw=1",
        type: 'POST',
        data: { product_id, token },
        dataType: 'JSON',
        success: function (result) {
            // console.log(result)
            flashMessage(result.error, result.message)

            if (!result.error) {
                _this.addClass('added').removeClass('no-add')
                const tooltip = bootstrap.Tooltip.getInstance(_this)
                tooltip.setContent({ '.tooltip-inner': 'Đã thêm vào danh sách yêu thích' })
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('Có lỗi trong quá trình đưa lên máy chủ. Xin bạn vui lòng kiểm tra lỗi kết nối.')
        }
    })
})