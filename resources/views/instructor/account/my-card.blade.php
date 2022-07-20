@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.my_cards')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.my_cards')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-my-cards-box instructor-payment-settings-page bg-white">
            <div class="row">
                <div class="col-12">
                    <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                        <h6>Add Account For Withdraw</h6>
                    </div>
                </div>

                <!-- instructor my-cards form item start -->
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="payment-settings-box">

                        <div class="add-payment-settings-title d-flex align-items-center justify-content-between">
                            <p class="font-medium color-heading">Add card</p>
                            <div class="add-card-img"><img src="{{asset('frontend/assets/img/instructor-img/add-visa-master-card.png')}}" alt="Paypal" class="img-fluid"></div>

                        </div>
                        <form method="POST" action="{{route('instructor.save.my-card')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">Card number</label>
                                    <input type="text" name="card_number" value="{{auth::user()->card ? auth::user()->card->card_number : ''}}" class="form-control" placeholder="1245   2154   2154 215">
                                    @if ($errors->has('card_number'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('card_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">Card holder name</label>
                                    <input type="text" class="form-control" name="card_holder_name" value="{{auth::user()->card ? auth::user()->card->card_holder_name : ''}}" placeholder="Your name">
                                    @if ($errors->has('card_holder_name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('card_holder_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <label class="font-medium font-15 color-heading">Month</label>
                                    <select name="month" class="form-select">
                                        <option value="">Select Month</option>
                                        <option value="1" @if(auth::user()->card && auth::user()->card->month == 1) selected @endif >January</option>
                                        <option value="2" @if(auth::user()->card && auth::user()->card->month == 2) selected @endif >February</option>
                                        <option value="3" @if(auth::user()->card && auth::user()->card->month == 3) selected @endif >March</option>
                                        <option value="4" @if(auth::user()->card && auth::user()->card->month == 4) selected @endif >April</option>
                                        <option value="5" @if(auth::user()->card && auth::user()->card->month == 5) selected @endif >May</option>
                                        <option value="6" @if(auth::user()->card && auth::user()->card->month == 6) selected @endif >June</option>
                                        <option value="7" @if(auth::user()->card && auth::user()->card->month == 7) selected @endif >July</option>
                                        <option value="8" @if(auth::user()->card && auth::user()->card->month == 8) selected @endif >August</option>
                                        <option value="9" @if(auth::user()->card && auth::user()->card->month == 9) selected @endif >September</option>
                                        <option value="10" @if(auth::user()->card && auth::user()->card->month == 10) selected @endif >October</option>
                                        <option value="11" @if(auth::user()->card && auth::user()->card->month == 11) selected @endif >November</option>
                                        <option value="12" @if(auth::user()->card && auth::user()->card->month == 12) selected @endif >December</option>
                                    </select>
                                    @if ($errors->has('month'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('month') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-30">
                                    <label class="font-medium font-15 color-heading">Year</label>
                                    <select name="year" class="form-select">
                                        <option value="">Select Year</option>
                                        @for($year = \Carbon\Carbon::now()->format('Y'); $year < \Carbon\Carbon::now()->addYear(20)->format('Y'); $year++)
                                            <option value="{{$year}}" @if(auth::user()->card && auth::user()->card->year == $year) selected @endif >{{$year}}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('year'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('year') }}</span>
                                    @endif
                                </div>

                            </div>

                            <div class="col-12">
                                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">Save Card</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- instructor my-cards form item end -->

                <!-- instructor my-cards form item start -->
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="payment-settings-box add-paypal-payment-box">

                        <div class="add-payment-settings-title d-flex align-items-center justify-content-between">
                            <p class="font-medium color-heading">Add card</p>
                            <div class="add-card-img"><img src="{{asset('frontend/assets/img/instructor-img/add-paypal.png')}}" alt="Paypal" class="img-fluid"></div>

                        </div>
                        <form method="POST" action="{{route('instructor.save.paypal')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">Paypal Email</label>
                                    <input type="email" class="form-control" name="email" value="{{auth::user()->paypal ? auth::user()->paypal->email : ''}}" placeholder="EX. example@email.com">
                                    @if ($errors->has('email'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">Save Paypal</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- instructor my-cards form item end -->

            </div>
        </div>
    </div>
@endsection


