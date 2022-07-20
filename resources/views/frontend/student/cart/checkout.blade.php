@extends('frontend.layouts.app')

@section('content')
<div class="bg-page">
<!-- Page Header Start -->
<header class="page-banner-header blank-page-banner-header gradient-bg position-relative">
    <div class="section-overlay">
        <div class="blank-page-banner-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="page-banner-content text-center">
                            <h3 class="page-banner-heading color-heading pb-15">{{ __('app.checkout') }}</h3>

                            <!-- Breadcrumb Start-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item font-14"><a href="{{ url('/') }}">Home</a></li>
                                    <li class="breadcrumb-item font-14 active" aria-current="page">{{ __('app.checkout') }}</li>
                                </ol>
                            </nav>
                            <!-- Breadcrumb End-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Page Header End -->

<!-- Cart Page Area Start -->
<section class="checkout-page">
    <div class="container">
        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Error!</strong> {{ $message }}
            </div>
        @endif

        <form method="post" action="{{route('student.pay')}}"  data-cc-on-file="false"
              data-stripe-publishable-key="{{get_option('STRIPE_PUBLIC_KEY')}}"
              id="payment-form" class="require-validation">
            @csrf
            <div class="stripeToken"></div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-page-left-part">
                        <div class="billing-address-box bg-white">

                            <h6 class="font-16 font-medium color-heading mb-30">{{__('app.billing_address')}}</h6>

                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.first_name')}}</label>
                                    <input type="text" name="first_name" value="{{$student->first_name}}" required class="form-control" placeholder="{{__('app.first_name')}}">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-30">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.last_name')}}</label>
                                    <input type="text"  name="last_name" value="{{$student->last_name}}" required class="form-control" placeholder="{{__('app.last_name')}}">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.email_address')}}</label>
                                    <input type="email" name="email" value="{{$student->user->email}}" required class="form-control" placeholder="{{__('app.email_address')}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.street')}}</label>
                                    <input type="text" name="address" value="{{$student->address}}" class="form-control" required placeholder="{{__('app.street')}}">
                                    @if ($errors->has('street_address'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('street_address') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">{{__('app.country')}}</label>

                                    @if($student->country_id && $student->country)
                                        <input type="text"  value="{{$student->country->country_name}}" class="form-control" readonly>
                                        <input type="hidden" name="country_id" value="{{$student->country_id}}">
                                    @else
                                        <select name="country_id" id="country_id" class="form-select">
                                            <option value="">{{__('app.select_country')}}</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" @if(old('country_id'))  {{old('country_id') == $country->id ? 'selected' : '' }} @else  {{$student->country_id == $country->id ? 'selected' : '' }}  @endif >{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @if ($errors->has('country_id'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('country_id') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.state')}}</label>

                                    @if($student->state_id && $student->state)
                                        <input type="text"  value="{{$student->state->name}}" class="form-control" readonly>
                                        <input type="hidden" name="state_id" value="{{$student->state_id}}">
                                    @else
                                        <select name="state_id" id="state_id" class="form-select">
                                            <option value="">{{__('app.select_state')}}</option>
                                            @if(old('country_id'))
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" {{old('state_id') == $state->id ? 'selected' : '' }} >{{$state->name}}</option>
                                                @endforeach
                                            @else
                                                @if($student->country)
                                                    @foreach($student->country->states as $selected_state)
                                                        <option value="{{$selected_state->id}}" {{$student->state_id == $selected_state->id ? 'selected' : '' }} >{{$selected_state->name}}</option>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </select>
                                    @endif
                                    @if ($errors->has('state_id'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('state_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-30">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.city')}}</label>

                                    @if($student->city_id && $student->city)
                                        <input type="text"  value="{{$student->city->name}}" class="form-control" readonly>
                                        <input type="hidden" name="city_id" value="{{$student->city_id}}">
                                    @else
                                        <select name="city_id" id="city_id" class="form-select">
                                            <option value="">{{__('app.select_city')}}</option>
                                            @if(old('state_id'))
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' : '' }} >{{$city->name}}</option>
                                                @endforeach
                                            @else
                                                @if($student->state)
                                                    @foreach($student->state->cities as $selected_city)
                                                        <option value="{{$selected_city->id}}" {{$student->city_id == $selected_city->id ? 'selected' : '' }} >{{$selected_city->name}}</option>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </select>
                                    @endif
                                    @if ($errors->has('city_id'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('city_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.zip_code')}}</label>
                                    <input type="text" name="postal_code" value="{{$student->postal_code}}" class="form-control" placeholder="Zip code">
                                </div>
                                <div class="col-md-6 mb-30">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.phone')}}</label>
                                    <input type="text" name="phone_number" value="{{$student->phone_number}}" required class="form-control" placeholder="Type your phone number">
                                </div>
                            </div>

                        </div>
                        <div class="payment-method-box bg-white">
                            <h6 class="font-16 font-medium color-heading mb-30">{{__('app.payment_method')}}</h6>

                            @if(get_option('paypal_status') == 1)
                                <div class="form-check payment-method-card-box paypal-box mb-15">
                                <input class="form-check-input" type="radio" name="payment_method" value="paypal" {{old('payment_method') == 'paypal' ? 'checked' : '' }} id="paypalPayment">
                                <label class="form-check-label" for="paypalPayment">
                                    <span>
                                        <span class="font-16 color-heading font-medium me-3">PayPal</span>
                                        <span class="font-14">You will be redirected to the PayPal website after submitting your order</span>
                                    </span>
                                    <span class="payment-card-list">
                                        <img src="{{ asset('frontend/assets/img/student-profile-img/payment-paypal.png') }}" alt="paypal">
                                    </span>
                                </label>
                            </div>
                            @endif
                            @if(get_option('stripe_status') == 1)
                            <div class="form-check payment-method-card-box other-payment-box pb-0">
                                <input class="form-check-input" type="radio" name="payment_method" value="stripe" {{old('payment_method') == 'stripe' ? 'checked' : '' }} id="stripePayment">
                                <label class="form-check-label" for="stripePayment">
                                    <span class="font-16 color-heading font-medium">Pay with Credit Card</span>
                                    <span class="payment-card-list">
                                        <img src="{{ asset('frontend/assets/img/student-profile-img/payment-visa.png') }}" alt="payment">
                                        <img src="{{ asset('frontend/assets/img/student-profile-img/payment-discover.png') }}" alt="payment">
                                        <img src="{{ asset('frontend/assets/img/student-profile-img/payment-janina1.png') }}" alt="payment">
                                        <img src="{{ asset('frontend/assets/img/student-profile-img/payment-mastercard.png') }}" alt="payment">
                                    </span>
                                </label>
                                <div class="payment-method-card-info-box">
                                    <div class="row">
                                        <div class="col-md-6 mb-30">
                                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.card_number')}}</label>
                                            <input type="text" class="form-control card-number" placeholder="1234 5678 9101 3456">
                                        </div>
                                        <div class="col-md-6 mb-30">
                                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.card_security_code')}}</label>
                                            <input type="password" class="form-control card-cvc" placeholder="Type your security code">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-30">
                                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.expiration_month')}}</label>
                                            <input type="text" class="form-control card-expiry-month" placeholder="MM">
                                        </div>
                                        <div class="col-md-6 mb-30">
                                            <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.expiration_year')}}</label>
                                            <input type="text" class="form-control card-expiry-year" placeholder="YY">
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div
                                            class="col-md-12 d-none error form-group">
                                            <div
                                                class="alert-danger alert  stripe-error-message">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endif

                            @if(get_option('razorpay_status') == 1)
                                <div class="form-check payment-method-card-box other-payment-box pb-0 mt-30">
                                    <input class="form-check-input" type="radio" name="payment_method" value="razorpay" {{old('payment_method') == 'razorpay' ? 'checked' : '' }} id="razorpayPayment">
                                    <label class="form-check-label mb-0" for="razorpayPayment">
                                        <span class="font-16 color-heading font-medium">Razorpay</span>
                                    </label>
                                </div>
                            @endif

                            @if(get_option('sslcommerz_status') == 1)
                                <div class="form-check payment-method-card-box other-payment-box pb-0 mt-30">
                                    <input class="form-check-input" type="radio" name="payment_method" value="sslcommerz" {{old('razorpay_status') == 'sslcommerz' ? 'checked' : '' }} id="sslcommerzPayment">
                                    <label class="form-check-label mb-0" for="sslcommerzPayment">
                                        <span class="font-16 color-heading font-medium">SSLCOMMERZ</span>
                                    </label>
                                </div>
                            @endif


                            <div class="checkout-we-protect-content d-flex align-items-center mt-30">
                                <div class="flex-shrink-0">
                                    <span class="iconify color-hover font-24" data-icon="ant-design:lock-filled"></span>
                                </div>
                                <div class="flex-grow-1 ms-2 font-13">
                                    We protect your payment information using encryption to provide bank-level security.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="checkout-page-right-part sticky-top">
                        <div class="checkout-right-side-box checkout-order-review-box">
                            <div class="accordion" id="accordionExample1">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                           {{__('app.order_review')}}
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                                        <div class="accordion-body">
                                            <div class="checkout-items-count font-13 color-heading mb-2">{{$carts->count()}} {{__('app.items_in_card')}}</div>
                                            <div class="table-responsive mb-20">
                                                <table class="table bg-white checkout-table mb-0">
                                                    <tbody>
                                                    @foreach($carts as $cart)
                                                        <tr>
                                                        <td class="checkout-course-item">
                                                            <div class="card course-item wishlist-item border-0 d-flex align-items-center">
                                                                <div class="course-img-wrap overflow-hidden flex-shrink-0">
                                                                    <a href="{{ route('course-details', @$cart->course->slug) }}" target="_blank"><img src="{{ getImageFile(@$cart->course->image_path) }}" alt="course" class="img-fluid"></a>
                                                                </div>
                                                                <div class="card-body flex-grow-1">
                                                                    <h5 class="card-title course-title"><a href="{{ route('course-details', @$cart->course->slug) }}" target="_blank">{{ @$cart->course->title }}</a></h5>

                                                                    @if($cart->course && $cart->course->instructor)
                                                                    <p class="card-text instructor-name-certificate font-medium text-uppercase">{{$cart->course->instructor->name}}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="wishlist-price font-13 color-heading text-end">
                                                            <div class="wishlist-remove font-13">
                                                                @if(get_currency_placement() == 'after')
                                                                    {{get_number_format(@$cart->price, 2)}} {{ get_currency_symbol() }}
                                                                @else
                                                                    {{ get_currency_symbol() }} {{get_number_format(@$cart->price, 2)}}
                                                                @endif
                                                            </div>
                                                            <div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="checkout-right-side-box checkout-billing-summary-box">

                            <div class="accordion" id="accordionExample3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                            {{__('app.billing_summary')}}
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
                                        <div class="accordion-body">
                                            <table class="table billing-summary-table">
                                                <tbody>
                                                <tr>
                                                    <td>{{__('app.subtotal')}}</td>
                                                    <td>
                                                        @if(get_currency_placement() == 'after')
                                                            {{get_number_format($carts->sum('price'))}} {{ get_currency_symbol() }}
                                                        @else
                                                            {{ get_currency_symbol() }} {{get_number_format($carts->sum('price'))}}
                                                        @endif

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{__('app.discount')}}</td>
                                                    <td>-

                                                        @if(get_currency_placement() == 'after')
                                                            {{get_number_format($carts->sum('discount'))}} {{ get_currency_symbol() }}
                                                        @else
                                                            {{ get_currency_symbol() }} {{get_number_format($carts->sum('discount'))}}
                                                        @endif

                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td>{{__('app.platform_charge')}} </td>
                                                    <td>
                                                        @if(get_currency_placement() == 'after')
                                                            {{get_platform_charge($carts->sum('price'))}} {{ get_currency_symbol() }}
                                                        @else
                                                            {{ get_currency_symbol() }} {{get_platform_charge($carts->sum('price'))}}
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="col">{{__('app.grand_total')}}</th>
                                                    <th scope="col">
                                                        @if(get_currency_placement() == 'after')
                                                            <span class="grand_total">{{ get_number_format($carts->sum('price') + get_platform_charge($carts->sum('price'))) }}</span> {{ get_currency_symbol() }}
                                                        @else
                                                            {{ get_currency_symbol() }} <span class="grand_total">{{ get_number_format($carts->sum('price') + get_platform_charge($carts->sum('price'))) }}</span>
                                                        @endif
                                                    </th>
                                                </tr>

                                                </tbody>
                                            </table>
                                            <table class="table billing-summary-table">
                                                <tbody>
                                                <tr>
                                                    <td>{{__('app.conversion_rate')}} </td>
                                                    <td>
                                                        1 {{ get_currency_symbol() }} =
                                                        <span class="selected_conversation_rate">?</span> <span class="selected_currency"></span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" >In<span class="ms-1 gateway_calculated_rate_currency"></span></th>
                                                    <th scope="col" class="gateway_calculated_rate_price"></th>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <div class="row mb-30">
                                                <div class="col-md-12">
                                                    <div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                            <label class="form-check-label mb-0" for="flexCheckChecked">
                                                                Please check to acknowledge our <a href="{{ route('privacy-policy') }}" class="color-hover text-decoration-underline">Privacy
                                                                    & Terms Policy</a>
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row mb-30">
                                                <div class="col-md-12">

                                                    <div class="sslcz-btn d-none">
                                                        <button class="your-button-class theme-btn theme-button1 theme-button3 font-15 fw-bold w-100" id="sslczPayBtn"
                                                                token="if you have any token validation"
                                                                postdata="your javascript arrays or objects which requires in backend"
                                                                order="If you already have the transaction generated for current order"
                                                                endpoint="/student/pay-via-ajax"> Pay {{ @$sslcommerz_grand_total_with_conversion_rate }} {{ get_option('sslcommerz_currency') }}
                                                        </button>
                                                    </div>

                                                   <div class="regular-btn">
                                                       <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">
                                                           Pay
                                                           <span class="ms-1  gateway_calculated_rate_price"></span><span class="ms-1 gateway_calculated_rate_currency"></span>
                                                       </button>
                                                   </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

            @php
                $razorpay_pay_amount =  $razorpay_grand_total_with_conversion_rate * 100;
            @endphp


        <div class="d-none">
            <form action="{{ route('student.razorpay_payment') }}" method="POST" id="razorpay_payment">
                @csrf
                <script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZORPAY_KEY') }}"
                        data-amount="{{$razorpay_pay_amount}}"
                        data-buttontext="Pay"
                        data-name="{{get_option('app_name')}}"
                        data-description="Buy Course"
                        data-prefill.name="name"
                        data-prefill.email="email"
                        data-theme.color="#0000FF">
                </script>
            </form>
        </div>

    </div>
</section>
<!-- Cart Page Area End -->
</div>

<input type="hidden" class="paypal_currency" value="{{ get_option('paypal_currency') }}">
<input type="hidden" class="paypal_conversion_rate" value="{{ get_option('paypal_conversion_rate') }}">

<input type="hidden" class="stripe_currency" value="{{ get_option('stripe_currency') }}">
<input type="hidden" class="stripe_conversion_rate" value="{{ get_option('stripe_conversion_rate') }}">

<input type="hidden" class="razorpay_currency" value="{{ get_option('razorpay_currency') }}">
<input type="hidden" class="razorpay_conversion_rate" value="{{ get_option('razorpay_conversion_rate') }}">

<input type="hidden" class="sslcommerz_currency" value="{{ get_option('sslcommerz_currency') }}">
<input type="hidden" class="sslcommerz_conversion_rate" value="{{ get_option('sslcommerz_conversion_rate') }}">
@endsection


@push('script')

    @if(get_option('sslcommerz_mode') == 'sandbox')
    <script>
        var obj = {};
        $('#sslczPayBtn').prop('postdata', obj);
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };
            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
    @endif

    @if(get_option('sslcommerz_mode') == 'live')
        <script>
            var obj = {};
            $('#sslczPayBtn').prop('postdata', obj);
            (function (window, document) {
                var loader = function () {
                    var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                     script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                    tag.parentNode.insertBefore(script, tag);
                };
                window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
            })(window, document);
        </script>
    @endif

    <script src="{{asset('frontend/assets/js/custom/student-profile.js')}}"></script>
    <script src="https://js.stripe.com/v2/"></script>
    <script src="{{asset('frontend/assets/js/custom/checkout.js')}}"></script>
@endpush

