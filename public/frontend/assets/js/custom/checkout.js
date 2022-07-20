'use strict'
$(function () {
    $('input[type=radio][name=payment_method]').change(function() {
        var payment_method =  $('input[name="payment_method"]:checked').val();
        var grand_total = $('.grand_total').html();

        if (payment_method === 'sslcommerz')
        {
            $(".sslcz-btn").removeClass('d-none');
            $(".regular-btn").addClass('d-none');
        } else {
            $(".sslcz-btn").addClass('d-none');
            $(".regular-btn").removeClass('d-none');
        }

        if (payment_method === 'paypal')
        {
            var rate = $('.paypal_conversion_rate').val();
            console.log(rate, grand_total)
            var gateway_calculated_rate_price = (parseFloat(grand_total) * parseFloat(rate)).toFixed(2);
            var currency = $('.paypal_currency').val();

            $('.selected_conversation_rate').html(rate)
            $('.selected_currency').html(currency)
            $('.gateway_calculated_rate_currency').html(currency)
            $('.gateway_calculated_rate_price').html(gateway_calculated_rate_price)
        }

        if (payment_method === 'stripe')
        {
            var rate = $('.stripe_conversion_rate').val();
            var gateway_calculated_rate_price = (parseFloat(grand_total) * parseFloat(rate)).toFixed(2);
            var currency = $('.stripe_currency').val();

            $('.selected_conversation_rate').html(rate)
            $('.selected_currency').html(currency)
            $('.gateway_calculated_rate_currency').html(currency)
            $('.gateway_calculated_rate_price').html(gateway_calculated_rate_price)
        }

        if (payment_method === 'razorpay')
        {
            var rate = $('.razorpay_conversion_rate').val();
            var gateway_calculated_rate_price = (parseFloat(grand_total) * parseFloat(rate)).toFixed(2);
            var currency = $('.razorpay_currency').val();

            $('.selected_conversation_rate').html(rate)
            $('.selected_currency').html(currency)
            $('.gateway_calculated_rate_currency').html(currency)
            $('.gateway_calculated_rate_price').html(gateway_calculated_rate_price)
        }

        if (payment_method === 'sslcommerz')
        {
            var rate = $('.sslcommerz_conversion_rate').val();
            var gateway_calculated_rate_price = (parseFloat(grand_total) * parseFloat(rate)).toFixed(2);
            var currency = $('.sslcommerz_currency').val();

            $('.selected_conversation_rate').html(rate)
            $('.selected_currency').html(currency)
            $('.gateway_calculated_rate_currency').html(currency)
            $('.gateway_calculated_rate_price').html(gateway_calculated_rate_price)
        }

    });

    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function (e) {

        var payment_method =  $('input[name="payment_method"]:checked').val();
        if (payment_method === 'razorpay')
        {
            $("#razorpay_payment").submit();
            return false;
        }

        if (payment_method === 'stripe')
        {

            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        } else {
            $('form.require-validation').submit();
        }
    });

    function stripeResponseHandler(status, response) {
        console.log(response.error);
        if (response.error) {
            $(".error").removeClass('d-none')
            $('.stripe-error-message')
                .removeClass('hide')
                .css("display", "block")
                .text(response.error.message).fadeOut(4000);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('.stripeToken').empty();
            $(".stripeToken").html("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
