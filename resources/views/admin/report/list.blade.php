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
                                <h2>Revenue Report</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Revenue report</li>
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
                            <img src="{{ asset('admin') }}/images/admin-dashboard-icons/test.png" alt="icon">
                        </div>
                        <div class="status__box__text">
                            <h2 class="color-green">{{ count(@$courses) }}</h2>
                            <h3>Total Courses</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="status__box status__box__v3 bg-style">
                        <div class="status__box__img">
                            <img src="{{ asset('admin') }}/images/admin-dashboard-icons/study.png" alt="icon">
                        </div>
                        <div class="status__box__text">
                            <h2 class="color-blue">{{ $total_enrolments }}</h2>
                            <h3>Total enrolled</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="status__box status__box__v3 bg-style">
                        <div class="status__box__img">
                            <img src="{{ asset('admin') }}/images/admin-dashboard-icons/save-money.png" alt="icon">
                        </div>
                        <div class="status__box__text">
                            <h2 class="color-green">
                                @if(get_currency_placement() == 'after')
                                    {{ $grand_admin_commission }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $grand_admin_commission }}
                                @endif

                            </h2>
                            <h3>Total Admin Commission</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="status__box status__box__v3 bg-style">
                        <div class="status__box__img">
                            <img src="{{ asset('admin') }}/images/admin-dashboard-icons/discount.png" alt="icon">
                        </div>
                        <div class="status__box__text">
                            <h2 class="color-purple">
                                @if(get_currency_placement() == 'after')
                                    {{ $grand_instructor_commission }} {{ get_currency_symbol() }}
                                @else
                                    {{ get_currency_symbol() }} {{ $grand_instructor_commission }}
                                @endif
                            </h2>
                            <h3>Total Instructor Commission</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="customers__area bg-style mb-30">
                        <div class="item-title d-flex justify-content-between">
                            <h2>Revenue Report</h2>
                        </div>
                        <div class="customers__table">
                            <table id="customers-table" class="row-border data-table-filter table-style">
                                <thead>
                                <tr>
                                    <th>{{__('app.image')}}</th>
                                    <th>{{__('app.title')}}</th>
                                    <th>{{__('app.instructor')}}</th>
                                    <th>Total Admin Commission</th>
                                    <th>Total Instructor Commission</th>
                                    <th>Total Purchase Course</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($courses as $course)
                                    <tr class="removable-item">
                                        <td>
                                            <a href="#"> <img src="{{getImageFile($course->image_path)}}" width="80"> </a>
                                        </td>
                                        <td>{{$course->title}}</td>
                                        <td>{{@$course->instructor->name}}</td>
                                        <td>
                                            @if(get_currency_placement() == 'after')
                                                {{$course->total_admin_commission}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }}  {{$course->total_admin_commission}}
                                            @endif
                                           </td>
                                        <td>
                                            @if(get_currency_placement() == 'after')
                                                {{$course->total_owner_balance}} {{ get_currency_symbol() }}
                                            @else
                                                {{ get_currency_symbol() }} {{$course->total_owner_balance}}
                                            @endif
                                            </td>
                                        <td> {{$course->total_purchase_course}}</td>
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
