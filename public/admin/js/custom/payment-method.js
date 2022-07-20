(function ($) {
    "use strict";
    $('.paypal_currency').on('keyup',function(){
        $('.paypal_append_currency').text($(this).val())
    })
    $('.paypal_append_currency').text($('.paypal_currency').val())

    $('.stripe_currency').on('keyup',function(){
        $('.stripe_append_currency').text($(this).val())
    })
    $('.stripe_append_currency').text($('.stripe_currency').val())

    $('.razorpay_currency').on('keyup',function(){
        $('.razorpay_append_currency').text($(this).val())
    })
    $('.razorpay_append_currency').text($('.razorpay_currency').val())

    $('.sslcommerz_currency').on('keyup',function(){
        $('.sslcommerz_append_currency').text($(this).val())
    })
    $('.sslcommerz_append_currency').text($('.sslcommerz_currency').val())
})(jQuery)
