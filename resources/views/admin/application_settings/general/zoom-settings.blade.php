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
                    <div class="email-inbox__area bg-style">
                        <div class="item-top mb-30"><h2>{{ @$title }}</h2></div>
                        <form action="{{route('settings.zoom-settings.update')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">ZOOM API URL <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="ZOOM_API_URL" value="{{ env('ZOOM_API_URL') }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">ZOOM API KEY <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="ZOOM_API_KEY" value="{{ env('ZOOM_API_KEY') }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">ZOOM API SECRET <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="ZOOM_API_SECRET" value="{{ env('ZOOM_API_SECRET') }}" class="form-control" required>
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
