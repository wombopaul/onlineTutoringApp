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
                                <h2>Students</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All student</li>
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
                            <h2>All Students</h2>
                        </div>
                        <div class="customers__table">
                            <table id="customers-table" class="row-border data-table-filter table-style">
                                <thead>
                                <tr>
                                    <th>{{__('app.image')}}</th>
                                    <th>{{__('app.name')}}</th>
                                    <th>{{__('app.country')}}</th>
                                    <th>{{__('app.address')}}</th>
                                    <th>Total Course Enroll</th>
                                    <th>{{__('app.status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr class="removable-item">
                                        <td>
                                             <img src="{{getImageFile($student->user ? $student->user->image_path : '')}}" width="80">
                                        </td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$student->country ? $student->country->country_name : '' }}</td>
                                        <td>{{$student->address}}</td>
                                        <td>{{ @$student->user->orderItems->Count() }}</td>
                                        <td>
                                            @if($student->status == 1)
                                                <span class="status active">Approved</span>
                                            @else
                                                <span class="status bg-yellow">Pending</span>
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
