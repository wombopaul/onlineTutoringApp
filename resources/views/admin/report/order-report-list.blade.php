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
                                <h2>Order Report</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order Report</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="status__box status__box__v3 bg-style">
                        <div class="status__box__img">
                            <img src="{{ asset('admin') }}/images/admin-dashboard-icons/paying.png" alt="icon">
                        </div>
                        <div class="status__box__text">
                            <h2 class="color-red">@if(get_currency_placement() == 'after')
                                    {{ $grand_total }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $grand_total }}
                                @endif</h2>
                            <h3>Grand Total</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="status__box status__box__v3 bg-style">
                        <div class="status__box__img">
                            <img src="{{ asset('admin') }}/images/admin-dashboard-icons/commission-1.png" alt="icon">
                        </div>
                        <div class="status__box__text">
                            <h2 class="color-purple">
                                @if(get_currency_placement() == 'after')
                                    {{ $total_platform_charge }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $total_platform_charge }}
                                @endif
                            </h2>
                            <h3>Total Platform Charge</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="status__box status__box__v3 bg-style">
                        <div class="status__box__img">
                            <img src="{{ asset('admin') }}/images/admin-dashboard-icons/discount.png" alt="icon">
                        </div>
                        <div class="status__box__text">
                            <h2 class="color-purple">@if(get_currency_placement() == 'after')
                                    {{ $total_admin_commission }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $total_admin_commission }}
                                @endif</h2>
                            <h3>Total Sell Commission</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="status__box status__box__v3 bg-style">
                        <div class="status__box__img">
                            <img src="{{ asset('admin') }}/images/admin-dashboard-icons/money.png" alt="icon">
                        </div>
                        <div class="status__box__text">
                            <h2 class="color-blue">
                                @if(get_currency_placement() == 'after')
                                    {{ $total_revenue }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $total_revenue }}
                                @endif
                            </h2>
                            <h3>Total Revenue</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="customers__area bg-style mb-30">
                        <div class="item-title d-flex justify-content-between">
                            <h2>Order Report</h2>
                        </div>
                        <div class="customers__table">
                            <table id="customers-table" class="row-border data-table-filter table-style admin-order-report-table">
                                <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Order Number</th>
                                    <th>Sub total</th>
                                    <th>Discount</th>
                                    <th>Platform Charge</th>
                                    <th>Grand Total</th>
                                    <th class="admin-order-payment-method">Payment Method & Details</th>
                                    <th>Total Admin Commission</th>
                                    <th>Total Instructor Commission</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr class="removable-item">
                                        <td>{{@$order->user->student->name}}</td>
                                        <td>{{@$order->order_number}}</td>
                                        <td> @if(get_currency_placement() == 'after')
                                                {{@$order->sub_total}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }} {{@$order->sub_total}}
                                            @endif</td>
                                        <td> @if(get_currency_placement() == 'after')
                                                {{@$order->discount}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }} {{@$order->discount}}
                                            @endif</td>
                                        <td> @if(get_currency_placement() == 'after')
                                                {{@$order->platform_charge}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }} {{@$order->platform_charge}}
                                            @endif</td>
                                        <td> @if(get_currency_placement() == 'after')
                                                {{@$order->grand_total}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }} {{@$order->grand_total}}
                                            @endif</td>
                                        <td class="admin-order-payment-method">
                                            {{ucfirst(@$order->payment_method)}}
                                            @if(@$order->payment_method)
                                                <p class=" mb-0"><span class="fw-bold">Payment Currency</span>: {{ $order->payment_currency }}</p>
                                                <p class="font-bold mb-0"><span class="fw-bold">Conversion Rate</span> : {{ number_format($order->conversion_rate, 2) }}</p>
                                                <p class="font-bold mb-0"><span class="fw-bold">Payment</span>: {{ number_format($order->grand_total_with_conversation_rate, 2) }}</p>
                                            @endif

                                        </td>
                                        <td>
                                            @if(get_currency_placement() == 'after')
                                                {{$order->total_admin_commission}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }} {{$order->total_admin_commission}}
                                            @endif</td>
                                        <td>
                                            @if(get_currency_placement() == 'after')
                                                {{$order->total_owner_balance}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }} {{$order->total_owner_balance}}
                                            @endif

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
    <!-- Page content area end -->
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/jquery.dataTables.min.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/custom/data-table-page.js')}}"></script>
@endpush
