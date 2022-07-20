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
                <div class="col-lg-4 col-md-4">
                    @include('admin.application_settings.sidebar')
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="email-inbox__area bg-style">
                        <div class="item-top mb-30"><h2>{{ @$title }}</h2></div>
                        <form action="{{route('settings.general_setting.cms.update')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-black row mb-3">
                                <label for="top_instructor_logo" class="col-lg-4">Logo</label>
                                <div class="col-lg-3">
                                    <div class="upload-img-box">
                                        @if(get_option('customer_say_logo') != '')
                                            <img src="{{getImageFile(get_option('customer_say_logo'))}}">
                                        @else
                                            <img src="">
                                        @endif
                                        <input type="file" name="customer_say_logo" id="customer_say_logo" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                            <p class="m-0">Logo</p>
                                        </div>
                                    </div>
                                    @if ($errors->has('customer_say_logo'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('customer_say_logo') }}</span>
                                    @endif

                                    <p><span class="text-black">Accepted Files:</span> PNG <br> <span class="text-black">Accepted Size:</span> 64 x 64</p>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_title" class="col-lg-4">Customer Say Title <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_title" id="customer_say_title" value="{{get_option('customer_say_title')}}" class="form-control" required>
                                </div>
                            </div>

                            <hr>
                            <div class="item-top mb-30"><h2>Customer Comment Section</h2></div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_first_name" class="col-lg-4">First Customer Name <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_first_name" id="customer_say_first_name" value="{{get_option('customer_say_first_name')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_first_position" class="col-lg-4">First Customer Position <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_first_position" id="customer_say_first_position" value="{{get_option('customer_say_first_position')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_first_comment_title" class="col-lg-4">First Customer Comment title <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_first_comment_title" id="customer_say_first_comment_title" value="{{get_option('customer_say_first_comment_title')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_first_comment_description" class="col-lg-4">First Customer Comment Description <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_first_comment_description" id="customer_say_first_comment_description" value="{{get_option('customer_say_first_comment_description')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_first_comment_rating_star" class="col-lg-4">First Customer Rating Star (1-5) <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="number" min="1" max="5" step="any" name="customer_say_first_comment_rating_star" id="customer_say_first_comment_rating_star" value="{{get_option('customer_say_first_comment_rating_star')}}" class="form-control" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_second_name" class="col-lg-4">Second Customer Name <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_second_name" id="customer_say_second_name" value="{{get_option('customer_say_second_name')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_second_position" class="col-lg-4">Second Customer Position <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_second_position" id="customer_say_second_position" value="{{get_option('customer_say_second_position')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_second_comment_title" class="col-lg-4">Second Customer Comment title <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_second_comment_title" id="customer_say_second_comment_title" value="{{get_option('customer_say_second_comment_title')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_second_comment_description" class="col-lg-4">Second Customer Comment Description <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_second_comment_description" id="customer_say_second_comment_description" value="{{get_option('customer_say_second_comment_description')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_second_comment_rating_star" class="col-lg-4">Second Customer Rating Star (1-5) <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="number" min="1" max="5" step="any" name="customer_say_second_comment_rating_star" id="customer_say_second_comment_rating_star" value="{{get_option('customer_say_second_comment_rating_star')}}" class="form-control" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_third_name" class="col-lg-4">Second Customer Name <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_third_name" id="customer_say_third_name" value="{{get_option('customer_say_third_name')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_third_position" class="col-lg-4">Second Customer Position <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_third_position" id="customer_say_third_position" value="{{get_option('customer_say_third_position')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_third_comment_title" class="col-lg-4">Second Customer Comment title <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_third_comment_title" id="customer_say_third_comment_title" value="{{get_option('customer_say_third_comment_title')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_third_comment_description" class="col-lg-4">Second Customer Comment Description <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" name="customer_say_third_comment_description" id="customer_say_third_comment_description" value="{{get_option('customer_say_third_comment_description')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group text-black row mb-3">
                                <label for="customer_say_third_comment_rating_star" class="col-lg-4">Second Customer Rating Star (1-5) <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="number" min="1" max="5" step="any" name="customer_say_third_comment_rating_star" id="customer_say_third_comment_rating_star" value="{{get_option('customer_say_third_comment_rating_star')}}" class="form-control" required>
                                </div>
                            </div>


                            <div class="row justify-content-end">
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-blue float-right">{{__('app.save')}}</button>
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
