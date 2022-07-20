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
                    <div class="email-inbox__area  bg-style">
                        <div class="item-top mb-30"><h2>{{ @$title }}</h2></div>
                        <form action="{{route('settings.about.upgrade-skill.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-form-group mb-3 row">
                                <label class="col-lg-3 text-lg-right text-black"> Upgrade Skill Image </label>
                                <div class="col-lg-3">
                                    <div class="upload-img-box">
                                        @if(@$aboutUsGeneral->upgrade_skill_logo)
                                            <img src="{{ getImageFile(@$aboutUsGeneral->upgrade_skill_logo_path) }}">
                                        @else
                                            <img src="">
                                        @endif
                                        <input type="file" name="upgrade_skill_logo" id="upgrade_skill_logo" accept="image/*" onchange="preview505540DimensionFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                    </div>
                                    <p><span class="text-black">Accepted Files: </span>JPG, JPEG, PNG <br> <span class="text-black">Accepted Size:</span> 505 x 540 (1MB)</p>
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="upgrade_skill_title" class="col-lg-3 text-lg-right text-black">Title </label>
                                <div class="col-lg-9">
                                    <input type="text" name="upgrade_skill_title" id="upgrade_skill_title" value="{{ @$aboutUsGeneral->upgrade_skill_title }}"
                                           class="form-control" placeholder="Type upgrade skill title">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="upgrade_skill_title" class="col-lg-3 text-lg-right text-black">Subtitle </label>
                                <div class="col-lg-9">
                                    <textarea name="upgrade_skill_subtitle" class="form-control" rows="5" id="upgrade_skill_subtitle"
                                              required>{{ @$aboutUsGeneral->upgrade_skill_subtitle }}</textarea>
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="upgrade_skill_button_name" class="col-lg-3 text-lg-right text-black">Button Text </label>
                                <div class="col-lg-9">
                                    <input type="text" name="upgrade_skill_button_name" id="upgrade_skill_button_name" value="{{ @$aboutUsGeneral->upgrade_skill_button_name }}"
                                           class="form-control" placeholder="Type upgrade skill title">
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-md-2 text-right ">
                                    @updateButton
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
