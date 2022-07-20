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
                                <h2>{{__('app.withdraw_request')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.withdraw_request')}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="customers__area bg-style mb-30">
                        <div class="item-title d-flex justify-content-between">
                            <h2>{{__('app.withdraw_request')}}</h2>
                        </div>
                        <div class="customers__table">
                            <table id="customers-table" class="row-border data-table-filter table-style">
                                <thead>
                                <tr>
                                    <th>#{{__('app.id')}}</th>
                                    <th>{{__('app.instructor')}}</th>
                                    <th >{{__('app.payment_method')}}</th>
                                    <th>{{__('app.request_date')}}</th>
                                    <th>{{__('app.amount')}}</th>
                                    <th>{{__('app.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdraws as $withdraw)
                                    @if($withdraw->user && $withdraw->user->instructor)
                                        <tr class="removable-item">
                                        <td>{{$withdraw->transection_id}}</td>
                                        <td>
                                            <div class="finance-table-inner-item my-2">
                                                <span class="fw-bold mr-1">{{__('app.name')}}</span>: {{$withdraw->user->instructor->name}}
                                            </div>
                                            <div class="finance-table-inner-item my-2">
                                                <span class="fw-bold mr-1">{{__('app.phone')}}</span>: {{$withdraw->user->instructor->phone_number}}
                                            </div>
                                        </td>
                                        <td>
                                            @if($withdraw->payment_method == 'paypal')
                                                <div class="finance-table-inner-item my-2">
                                                    <span class="fw-bold mr-1">{{__('app.payment_method')}}</span>: PayPal
                                                </div>
                                                <div class="finance-table-inner-item my-2">
                                                    <span class="fw-bold mr-1">{{__('app.email')}}</span>: {{$withdraw->user->paypal ? $withdraw->user->paypal->email : '' }}
                                                </div>
                                            @endif

                                                @if($withdraw->payment_method == 'card')
                                                <div class="finance-table-inner-item my-2">
                                                        <span class="fw-bold mr-1">{{__('app.payment_method')}}</span>: Card
                                                    </div>
                                                    @if($withdraw->user->card)
                                                    <div class="finance-table-inner-item my-2">
                                                            <span class="fw-bold mr-1">{{__('app.card_number')}}</span>: {{$withdraw->user->card->card_number }}
                                                        </div>
                                                        <div class="finance-table-inner-item my-2">
                                                            <span class="fw-bold mr-1">{{__('app.car_holder')}}</span>: {{$withdraw->user->card->card_holder_name }}
                                                        </div>
                                                        <div class="finance-table-inner-item my-2">
                                                            <span class="fw-bold mr-1">{{__('app.date')}}</span>: {{$withdraw->user->card->month }}/{{$withdraw->user->card->year }}
                                                        </div>
                                                    @endif
                                                @endif

                                        </td>
                                        <td>
                                            {{$withdraw->created_at->format(get_option('app_date_format'))}}
                                        </td>
                                        <td>
                                            @if(get_currency_placement() == 'after')
                                                {{$withdraw->amount}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }} {{$withdraw->amount}}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="javascript:void(0);" data-uuid="{{$withdraw->uuid}}" data-status="2" class="btn-action hold-btn mr-30 note" title="Make as Reject">
                                                    {{__('app.reject')}}</span>
                                                </a>
                                                <a href="javascript:void(0);" data-uuid="{{$withdraw->uuid}}" data-status="1" class="btn-action approve-btn note" title="Make as Complete">
                                                    {{__('app.complete')}}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        {{$withdraws->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Page content area end -->

    <!--Withdrawal Modal Start-->
    <div class="modal fade" id="withdrawalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h4>Write Note</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('payout.change-withdraw-status')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid" id="uuid">
                        <input type="hidden" name="status" id="status">
                        <div class="custom-form-group mb-3 row">
                            <div class="col-lg-12">
                                <textarea name="note" id="note" required class="form-control" placeholder="{{__('app.note')}}"></textarea>
                            </div>
                        </div>

                        <div class="custom-form-group mb-3 row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-blue mr-30">{{__('app.save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Withdrawal Modal End-->

@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/jquery.dataTables.min.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/custom/data-table-page.js')}}"></script>
    <script src="{{asset('admin/js/custom/withdraw.js')}}"></script>
@endpush
