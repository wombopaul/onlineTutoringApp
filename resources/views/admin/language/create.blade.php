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
                                <h2>{{__('app.add_language')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('language.index')}}">{{__('app.language_settings')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.add_language')}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-vertical__item bg-style">
                        <div class="item-top mb-30">
                            <h2>{{__('app.add_language')}}</h2>
                        </div>
                        <form action="{{route('language.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input__group mb-25">
                                <label for="language"> {{__('app.name')}} </label>
                                <div>
                                    <input type="text" name="language" id="language" value="{{old('language')}}" class="form-control flat-input" placeholder=" {{__('app.name')}} ">
                                    @if ($errors->has('language '))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('language') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="input__group mb-25">
                                <label for="iso_code"> {{__('app.iso_code')}} </label>
                                <div>
                                    <input type="text" name="iso_code" id="iso_code" value="{{old('iso_code')}}" class="form-control flat-input" placeholder=" {{__('app.iso_code')}} ">
                                    @if ($errors->has('iso_code'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('iso_code') }}</span>
                                    @endif

                                    <div class="mt-3">
                                        <a href="https://en.wikipedia.org/wiki/ISO_3166-1#Current_codes" target="_blank"><b><i class="fa fa-list mr-1"></i> ISO Code List </b></a>
                                    </div>

                                </div>
                            </div>


                            <div class="input__group mb-25">
                                <label for="flag" class="col-lg-3 text-lg-right text-black"> {{__('app.flag')}} </label>
                                <div class="col-lg-3">
                                    <div class="upload-img-box">
                                        <img src="{{ getImageFile('uploads/default/no-image-found.png') }}">
                                        <input type="file" name="flag" id="flag" accept="image/*" onchange="previewFile(this)">

                                    </div>
                                </div>
                            </div>

                            <div class="custom-form-group mb-3 row">
                                <label for="rtl" class="col-lg-1 text-lg-right text-black"> RTL Support</label>
                                <div class="col-lg-1">
                                    <input type="checkbox" name="rtl" value="1" id="rtl">
                                </div>
                            </div>


                            <div class="input__group">
                                <div class="input__button ">
                                    <button type="submit" class="btn btn-blue">{{__('app.save')}}</button>
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

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>
@endpush
