@extends('layouts.admin')

@section('content')
    <!-- Page content area start -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb__content">
                        <div class="breadcrumb__content__left">
                            <div class="breadcrumb__title">
                                <h2>Application Settings</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ @$title }}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('admin.application_settings.sidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="email-inbox__area bg-style admin-dashboard-payment-method">
                        <div class="item-top mb-30"><h2>{{ @$title }}</h2></div>
                        <form action="{{route('settings.save.setting')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="row justify-content-center p-3 pb-0">
                                <div class="admin-dashboard-payment-title-left col-6 border border-bottom-0 pr-4 text-center">
                                    <h5 class="p-2">PayPal</h5>
                                </div>
                                <div class="admin-dashboard-payment-title-right col-6 border border-bottom-0 pl-4 text-center">
                                    <h5 class="p-2">Stripe</h5>
                                </div>
                            </div>

                            <div class="row justify-content-center px-3 pb-0 mb-3">

                                <div class="admin-dashboard-payment-content-box-left col-md-6 border p-3">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="alert alert-warning" role="alert">
                                                Make sure to enter valid currency ISO code.
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label>{{__('app.currency_iso_code')}} </label>
                                                <input type="text" name="paypal_currency" value="{{get_option('paypal_currency')}}" class="form-control paypal_currency">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label>{{__('app.conversion_rate')}} </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">{{"1 ".get_currency_symbol().' = '}}</span>
                                                <input type="number" step="any" min="0" name="paypal_conversion_rate" value="{{get_option('paypal_conversion_rate') ? get_option('paypal_conversion_rate') : 1}}" class="form-control">
                                                <span class="input-group-text paypal_append_currency" ></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label>{{__('app.status')}} </label>
                                                <select name="paypal_status" class="form-control">
                                                    <option value="1" {{get_option('paypal_status') == 1 ? 'selected' : ''}}> {{__('app.enable')}} </option>
                                                    <option value="0" {{get_option('paypal_status') == '0' ? 'selected' : ''}}> {{__('app.disable')}} </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label>{{__('app.PAYPAL_MODE')}}   </label>
                                                <select name="PAYPAL_MODE" class="form-control">
                                                    <option value="sandbox" {{get_option('PAYPAL_MODE') == 'sandbox' ? 'selected' : ''}}> {{__('app.sandbox')}} </option>
                                                    <option value="live"  {{get_option('PAYPAL_MODE') == 'live' ? 'selected' : ''}}> {{__('app.live')}} </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">

                                            <div class="form-group text-black">
                                                <label>{{__('app.PAYPAL_CLIENT_ID')}} </label>
                                                <input type="text" name="PAYPAL_CLIENT_ID" value="{{get_option('PAYPAL_CLIENT_ID')}}" class="form-control">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">

                                            <div class="form-group text-black">
                                                <label>{{__('app.PAYPAL_SECRET')}} </label>
                                                <input type="text" name="PAYPAL_SECRET" value="{{get_option('PAYPAL_SECRET')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="admin-dashboard-payment-content-box-right col-md-6 border p-3">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="alert alert-warning" role="alert">
                                                Make sure to enter valid currency ISO code.
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label>{{__('app.currency_iso_code')}} </label>
                                                <input type="text" name="stripe_currency" value="{{get_option('stripe_currency')}}" class="form-control stripe_currency">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label>{{__('app.conversion_rate')}} </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">{{"1 ".get_currency_symbol().' = '}}</span>
                                                <input type="number" step="any" min="0" name="stripe_conversion_rate" value="{{get_option('stripe_conversion_rate') ? get_option('stripe_conversion_rate') : 1 }}" class="form-control">
                                                <span class="input-group-text stripe_append_currency" ></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group text-black">
                                                <label>{{__('app.status')}} </label>
                                                <select name="stripe_status" class="form-control">
                                                    <option value="1" {{get_option('stripe_status') == 1 ? 'selected' : ''}}> {{__('app.enable')}} </option>
                                                    <option value="0" {{get_option('stripe_status') == '0' ? 'selected' : ''}}> {{__('app.disable')}} </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group text-black">
                                                <label>{{__('app.STRIPE_MODE')}} </label>
                                                <select name="STRIPE_MODE" class="form-control">
                                                    <option value="sandbox" {{get_option('stripe_mode') == 'sandbox' ? 'selected' : ''}}> {{__('app.sandbox')}} </option>
                                                    <option value="live"  {{get_option('stripe_mode') == 'live' ? 'selected' : ''}}> {{__('app.live')}} </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">

                                            <div class="form-group text-black">
                                                <label>{{__('app.STRIPE_SECRET_KEY')}}</label>
                                                <input type="text" name="STRIPE_SECRET_KEY" value="{{get_option('STRIPE_SECRET_KEY')}}" class="form-control">
                                            </div>


                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group text-black">
                                                <label>{{__('app.STRIPE_PUBLIC_KEY')}}</label>
                                                <input type="text" name="STRIPE_PUBLIC_KEY" value="{{get_option('STRIPE_PUBLIC_KEY')}}" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row justify-content-center p-3 pb-0">
                                <div class="admin-dashboard-payment-title-left col-6 border border-bottom-0 pr-4 text-center">
                                    <h5 class="p-2">RAZORPAY</h5>
                                </div>
                                <div class="admin-dashboard-payment-title-right col-6 border border-bottom-0 pl-4 text-center">
                                    <h5 class="p-2">SSLCOMMERZ</h5>
                                </div>
                            </div>

                            <div class="row justify-content-center px-3 pb-0 mb-3">

                                <div class="admin-dashboard-payment-content-box-left col-md-6 border p-3">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="alert alert-warning" role="alert">
                                                Make sure to enter valid currency ISO code.
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label>{{__('app.currency_iso_code')}} </label>
                                                <input type="text" name="razorpay_currency" value="{{get_option('razorpay_currency')}}" class="form-control razorpay_currency">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label>{{__('app.conversion_rate')}} </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">{{"1 ".get_currency_symbol().' = '}}</span>
                                                <input type="number" step="any" min="0" name="razorpay_conversion_rate" value="{{get_option('razorpay_conversion_rate') ? get_option('razorpay_conversion_rate') : 1}}" class="form-control">
                                                <span class="input-group-text razorpay_append_currency" ></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label>{{__('app.status')}} </label>
                                                <select name="razorpay_status" class="form-control">
                                                    <option value=""> Select Option </option>
                                                    <option value="1" {{get_option('razorpay_status') == 1 ? 'selected' : ''}}> {{__('app.enable')}} </option>
                                                    <option value="0" {{get_option('razorpay_status') == '0' ? 'selected' : ''}}> {{__('app.disable')}} </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label> RAZORPAY KEY </label>
                                                <input type="text" name="RAZORPAY_KEY" value="{{get_option('RAZORPAY_KEY')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">

                                            <div class="form-group text-black">
                                                <label> RAZORPAY SECRET </label>
                                                <input type="text" name="RAZORPAY_SECRET" value="{{get_option('RAZORPAY_SECRET')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="admin-dashboard-payment-content-box-right col-md-6 border p-3">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="alert alert-warning" role="alert">
                                                Make sure to enter valid currency ISO code.
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label>{{__('app.currency_iso_code')}} </label>
                                                <input type="text" name="sslcommerz_currency" value="{{get_option('sslcommerz_currency')}}" class="form-control sslcommerz_currency">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label>{{__('app.conversion_rate')}} </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">{{"1 ".get_currency_symbol().' = '}}</span>
                                                <input type="number" step="any" min="0" name="sslcommerz_conversion_rate" value="{{get_option('sslcommerz_conversion_rate') ? get_option('sslcommerz_conversion_rate') : 1}}" class="form-control">
                                                <span class="input-group-text sslcommerz_append_currency" ></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label>{{__('app.status')}} </label>
                                                <select name="sslcommerz_status" class="form-control">
                                                    <option value=""> Select Option </option>
                                                    <option value="1" {{get_option('sslcommerz_status') == 1 ? 'selected' : ''}}> {{__('app.enable')}} </option>
                                                    <option value="0" {{get_option('sslcommerz_status') == '0' ? 'selected' : ''}}> {{__('app.disable')}} </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label> Sslcommerz Mode   </label>
                                                <select name="sslcommerz_mode" class="form-control">
                                                    <option value=""> Select Option </option>
                                                    <option value="sandbox" {{get_option('sslcommerz_mode') == 'sandbox' ? 'selected' : ''}}> {{__('app.sandbox')}} </option>
                                                    <option value="live"  {{get_option('sslcommerz_mode') == 'live' ? 'selected' : ''}}> {{__('app.live')}} </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group text-black">
                                                <label> Sslcz Store Id </label>
                                                <input type="text" name="SSLCZ_STORE_ID" value="{{get_option('SSLCZ_STORE_ID')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">

                                            <div class="form-group text-black">
                                                <label> Sslcz store password </label>
                                                <input type="text" name="SSLCZ_STORE_PASSWD" value="{{get_option('SSLCZ_STORE_PASSWD')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="input__group general-settings-btn">
                                        <button type="submit" class="btn btn-blue float-right">{{__('app.save')}}</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content area end -->
@endsection

@push('script')
    <script src="{{ asset('admin/js/custom/payment-method.js') }}"></script>
@endpush
