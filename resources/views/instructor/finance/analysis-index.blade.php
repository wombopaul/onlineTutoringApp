@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15">{{__('app.analysis')}}</h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.analysis')}}</li>
            </ol>
        </nav>
        <!-- Breadcrumb End-->
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-dashboard-box">

            <div class="row instructor-dashboard-top-part">

                <div class="col-md-4">
                    <div class="instructor-dashboard-top-part-item d-flex align-items-center radius-8 mb-30">
                        <div class="instructor-dashboard-top-part-icon flex-shrink-0">
                            <span class="iconify" data-icon="akar-icons:book"></span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="para-color font-11 font-semi-bold text-uppercase">Number of courses</h6>
                            <h5>{{ $total_courses }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="instructor-dashboard-top-part-item d-flex align-items-center radius-8 mb-30">
                        <div class="instructor-dashboard-top-part-icon flex-shrink-0">
                            <span class="iconify" data-icon="carbon:user-multiple"></span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="para-color font-11 font-semi-bold text-uppercase">Total enroll</h6>
                            <h5>{{ $total_enroll }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="instructor-dashboard-top-part-item d-flex align-items-center radius-8 mb-30">
                        <div class="instructor-dashboard-top-part-icon flex-shrink-0">
                            <span class="iconify" data-icon="clarity:dollar-line"></span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="para-color font-11 font-semi-bold text-uppercase">Total earning</h6>
                            <h5>
                                @if(get_currency_placement() == 'after')
                                    {{ $total_earning }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $total_earning }}
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="instructor-dashboard-top-part-item d-flex align-items-center radius-8 mb-30">
                        <div class="instructor-dashboard-top-part-icon flex-shrink-0">
                            <span class="iconify" data-icon="bx:bx-wallet"></span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="para-color font-11 font-semi-bold text-uppercase">Available balance</h6>
                            <h5>
                                @if(get_currency_placement() == 'after')
                                    {{instructor_available_balance()}} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{instructor_available_balance()}}
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="instructor-dashboard-top-part-item d-flex align-items-center radius-8 mb-30">
                        <div class="instructor-dashboard-top-part-icon flex-shrink-0">
                            <span class="iconify" data-icon="akar-icons:calendar"></span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="para-color font-11 font-semi-bold text-uppercase">Total withdraw amount</h6>
                            <h5>
                                @if(get_currency_placement() == 'after')
                                    {{ $total_withdraw_amount }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $total_withdraw_amount }}
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="instructor-dashboard-top-part-item d-flex align-items-center radius-8 mb-30">
                        <div class="instructor-dashboard-top-part-icon flex-shrink-0">
                            <span class="iconify" data-icon="akar-icons:calendar"></span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="para-color font-11 font-semi-bold text-uppercase">Pending withdraw amount</h6>
                            <h5>
                                @if(get_currency_placement() == 'after')
                                    {{ $total_pending_withdraw_amount }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $total_pending_withdraw_amount }}
                                @endif

                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="instructor-withdrawal-money-box instructor-dashboard-top-part-item d-flex align-items-center radius-8 mb-30">
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-white font-11 font-semi-bold text-uppercase mb-2">withdrawal money</h6>
                            <!-- Button trigger modal -->
                            <button type="button" class="upload-your-course-today-btn bg-hover text-white font-12 font-medium text-capitalize"
                                    data-bs-toggle="modal" data-bs-target="#withdrawalModal">
                                withdrawal
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row upload-your-course-today mb-30 mb-lg-0">
                <div class="col-lg-12">
                    <div class="instructor-dashboard-chart-box radius-8">
                        <div class="chart-title d-flex justify-content-between align-items-center">
                            <h6 class="font-18">Sale statistics</h6>
                        </div>
                        <!-- Chart -->
                        <div class="chart-wrap">
                            <div id="chart" class="w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection


@section('modal')
    <!--Withdrawal Modal Start-->
    <div class="modal fade" id="withdrawalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="withdrawal-modal-title text-center">
                        <p class="font-13 font-medium text-uppercase">Available balance</p>
                        <h4>
                            @if(get_currency_placement() == 'after')
                                {{instructor_available_balance()}} {{ get_currency_symbol() }}
                            @else
                                {{ get_currency_symbol() }} {{instructor_available_balance()}}
                            @endif
                        </h4>
                    </div>
                    <form method="POST" action="{{route('finance.store-withdraw')}}">
                        @csrf
                        <div class="row">

                            <div class="col-md-12 mb-30">
                                <div class="label-text-title color-heading font-medium font-16 mb-3">Amount
                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"
                                          data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                   !
                                </span>
                                </div>
                                <input type="number" name="amount" min="1" class="form-control" placeholder="Type amount" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-30">
                                <div class="label-text-title color-heading font-medium font-16 mb-3">Amount
                                    <span class="cursor tooltip-show-btn share-referral-big-btn primary-btn get-referral-btn border-0 text-capitalize" data-toggle="popover"
                                          data-bs-placement="bottom" data-bs-content="Meridian sun strikes upper urface of the impenetrable foliage of my trees">
                                       !
                                </span>
                                </div>

                                <div class="withdrawal-radio-item-wrap form-control">
                                    <div class="form-check">
                                        <div class="withdrawal-radio-item">
                                            <input class="form-check-input" type="radio" name="payment_method" value="paypal" required id="flexRadioDefault3">
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                Withdraw with Paypal
                                            </label>
                                        </div>
                                        <div class="withdrawal-radio-img">
                                            <img src="{{ asset('frontend/assets/img/instructor-img/paypal-icon.png') }}" alt="visa">
                                        </div>
                                    </div>
                                </div>
                                <div class="withdrawal-radio-item-wrap form-control">
                                    <div class="form-check">
                                        <div class="withdrawal-radio-item">
                                            <input class="form-check-input" type="radio" name="payment_method" value="card" required id="flexRadioDefault4">
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                Withdraw with Card
                                            </label>
                                        </div>
                                        <div class="withdrawal-radio-img">
                                            <img src="{{ asset('frontend/assets/img/instructor-img/mastercard-icon.png') }}" alt="visa">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">Make Withdraw</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Withdrawal Modal End-->
@endsection

@push('script')
    <!--Apexcharts js-->
    <script src="{{ asset('common/js/apexcharts.min.js') }}"></script>

    <script>
        // Chart Start
        var options = {
            chart: {
                height: '100%',
                type: "area"
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                    name: "Sale",
                    data: @json(@$totalPrice)
                }
            ],
            fill: {
                type: "gradient",
                colors: ['#5e3fd7'],
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            markers: {
                size: 4,
                colors: ['#fff'],
                strokeColors: '#5e3fd7',
                strokeWidth: 2,
                strokeOpacity: 0.9,
                strokeDashArray: 0,
                fillOpacity: 1,
                discrete: [],
                shape: "circle",
                radius: 2,
                offsetX: 0,
                offsetY: 0,
                onClick: undefined,
                onDblClick: undefined,
                showNullDataPoints: true,
                hover: {
                    size: undefined,
                    sizeOffset: 3
                }
            },
            stroke: {
                show: true,
                curve: 'smooth',
                lineCap: 'butt',
                colors: undefined,
                width: 3,
                dashArray: 0,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        var result = val ;
                        if ("{{ get_currency_placement() }}" == 'after')
                        {
                            result = val + ' ' + "{{ get_currency_symbol() }}"
                        } else {
                            result = "{{ get_currency_symbol() }}" + ' ' + val
                        }
                        return result;
                    }
                }
            },
            xaxis: {
                categories: @json(@$months),
                axisBorder: {
                    show: false,
                    color: '#E7E3EB',
                    height: 1,
                    width: '100%',
                    offsetX: 0,
                    offsetY: 0
                },
                axisTicks: {
                    show: false,
                    borderType: 'solid',
                    color: '#E7E3EB',
                    height: 6,
                    offsetX: 0,
                    offsetY: 0
                },
            },
            yaxis: {
                show: true,
                showAlways: true,
                showForNullSeries: true,
                opposite: false,
                reversed: false,
                logarithmic: false,
                // logBase: 10,
                // tickAmount: 6,
                // min: 0.0,
                // max: 100.0,
                type: 'numeric',
                categories: [
                    '5','10', '15', '20', '25', '30', '35', '40'
                ],
                axisBorder: {
                    show: false,
                    color: '#E7E3EB',
                    offsetX: 0,
                    offsetY: 0
                },
                axisTicks: {
                    show: false,
                    borderType: 'solid',
                    color: '#E7E3EB',
                    width: 6,
                    offsetX: 0,
                    offsetY: 0
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        // Chart End
    </script>

@endpush

