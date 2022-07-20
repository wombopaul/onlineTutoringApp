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
                    <div class="email-inbox__area bg-style form-horizontal__item bg-style admin-general-settings-page">
                        <div class="item-top mb-30"><h2>{{ @$title }}</h2></div>
                        <form action="{{route('settings.general_setting.cms.update')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">{{__('app.app_name')}} <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="app_name" value="{{get_option('app_name')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">App Email <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="app_email" value="{{get_option('app_email')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">App Contact Number <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="app_contact_number" value="{{get_option('app_contact_number')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">App Location <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="app_location" value="{{get_option('app_location')}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">App Copyright <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="app_copyright" value="{{get_option('app_copyright')}}" class="form-control" required>
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Developed By <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="app_developed" value="{{get_option('app_developed')}}" class="form-control" required>
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label for="app_date_format" class="col-lg-3">{{__('app.date_format')}} <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select name="app_date_format" class="form-control">
                                        <option value="m/d/Y" {{get_option('app_date_format') == 'm/d/Y' ? 'selected' : ''}} >
                                            m/d/Y (eg. {{\Carbon\Carbon::now()->format("m/d/Y")}} )
                                        </option>
                                        <option value="d/m/Y" {{get_option('app_date_format') == 'd/m/Y' ? 'selected' : ''}} >
                                            d/m/Y (eg. {{\Carbon\Carbon::now()->format("d/m/Y")}} )
                                        </option>
                                        <option value="Y/m/d" {{get_option('app_date_format') == 'Y/m/d' ? 'selected' : ''}} >
                                            Y/m/d (eg. {{\Carbon\Carbon::now()->format("Y/m/d")}} )
                                        </option>
                                        <option value="Y/d/m" {{get_option('app_date_format') == 'Y/d/m' ? 'selected' : ''}} >
                                            Y/d/m (eg. {{\Carbon\Carbon::now()->format("Y/d/m")}} )
                                        </option>
                                        <option value="m-d-Y" {{get_option('app_date_format') == 'm-d-Y' ? 'selected' : ''}} >
                                            m-d-Y (eg. {{\Carbon\Carbon::now()->format("m-d-Y")}} )
                                        </option>
                                        <option value="d-m-Y" {{get_option('app_date_format') == 'd-m-Y' ? 'selected' : ''}} >
                                            d-m-Y (eg. {{\Carbon\Carbon::now()->format("d-m-Y")}} )
                                        </option>
                                        <option value="Y-m-d" {{get_option('app_date_format') == 'Y-m-d' ? 'selected' : ''}} >
                                            Y-m-d (eg. {{\Carbon\Carbon::now()->format("Y-m-d")}} )
                                        </option>
                                        <option value="Y-d-m" {{get_option('app_date_format') == 'Y-d-m' ? 'selected' : ''}} >
                                            Y-d-m (eg. {{\Carbon\Carbon::now()->format("Y-d-m")}} )
                                        </option>
                                        <option value="d M, Y" {{get_option('app_date_format') == 'd M, Y' ? 'selected' : ''}} >
                                            d M, Y (eg. {{\Carbon\Carbon::now()->format("d M, Y")}} )
                                        </option>
                                        <option value="M d, Y" {{get_option('app_date_format') == 'M d, Y' ? 'selected' : ''}} >
                                            M d, Y (eg. {{\Carbon\Carbon::now()->format("M d, Y")}} )
                                        </option>
                                        <option value="Y M, d" {{get_option('app_date_format') == 'Y M, d' ? 'selected' : ''}} >
                                            Y M, d (eg. {{\Carbon\Carbon::now()->format("Y M, d")}} )
                                        </option>
                                        <option value="d F, Y" {{get_option('app_date_format') == 'd F, Y' ? 'selected' : ''}} >
                                            d F, Y (eg. {{\Carbon\Carbon::now()->format("d F, Y")}} )
                                        </option>
                                        <option value="Y F, d" {{get_option('app_date_format') == 'Y F, d' ? 'selected' : ''}} >
                                            Y F, d (eg. {{\Carbon\Carbon::now()->format("Y F, d")}} )
                                        </option>
                                    </select>
                                </div>
                            </div>



                            <div class="row input__group mb-25">
                                <label for="app_date_format" class="col-lg-3">{{__('app.default_currency')}} <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select name="currency_id" class="form-control select2">
                                        <option value="">Select option</option>
                                        @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}" {{$currency->id == @$current_currency->id ? 'selected' : ''}} > {{ $currency->symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label for="app_date_format" class="col-lg-3">{{__('app.default_language')}} <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select name="language_id" class="form-control select2">
                                        <option value="">Select option</option>
                                        @foreach($languages as $language)
                                        <option value="{{ $language->id }}" {{$language->id == @$default_language->id ? 'selected' : ''}} > {{ $language->language }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Platform charge (%) <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="number" min="0" max="100" name="platform_charge" value="{{get_option('platform_charge')}}" class="form-control" required>
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">  Sell commission (%) <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="number" min="0" max="100" name="sell_commission" value="{{get_option('sell_commission')}}" class="form-control" required>
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">{{__('app.app_logo')}}</label>
                                <div class="col-lg-4">
                                    <div class="upload-img-box">
                                        @if(get_option('app_logo') != '')
                                            <img src="{{getImageFile(get_option('app_logo'))}}">
                                        @else
                                            <img src="">
                                        @endif
                                        <input type="file" name="app_logo" id="app_logo" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                            <p class="m-0">{{__('app.app_logo')}}</p>
                                        </div>
                                    </div>
                                    @if ($errors->has('app_logo'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('app_logo') }}</span>
                                    @endif
                                    <p><span class="text-black">Accepted Files:</span> PNG <br> <span class="text-black">Recommend Size:</span> 140 x 40</p>
                                </div>
                            </div>


                            <div class="row input__group mb-25">
                                <label class="col-lg-3">{{__('app.app_fav_icon')}} </label>
                                <div class="col-lg-4">
                                    <div class="upload-img-box">
                                        @if(get_option('app_fav_icon') != '')
                                            <img src="{{getImageFile(get_option('app_fav_icon'))}}">
                                        @else
                                            <img src="{{ asset('uploads/default/no-image-found.png') }}">
                                        @endif
                                        <input type="file" name="app_fav_icon" id="app_fav_icon" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                            <p class="m-0">{{__('app.app_fav_icon')}}</p>
                                        </div>
                                    </div>
                                    @if ($errors->has('app_fav_icon'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('app_fav_icon') }}</span>
                                    @endif
                                    <p><span class="text-black">Accepted Files:</span> PNG <br> <span class="text-black">Recommend Size:</span> 16 x 16</p>
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Footer Quote <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="footer_quote" id="" rows="5">{{get_option('footer_quote')}}</textarea>
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Sign up Left Text <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="sign_up_left_text" value="{{get_option('sign_up_left_text')}}" class="form-control" >
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Sign up Left Image </label>
                                <div class="col-lg-4">
                                    <div class="upload-img-box">
                                        @if(get_option('sign_up_left_image') != '')
                                            <img src="{{getImageFile(get_option('sign_up_left_image'))}}">
                                        @else
                                            <img src="{{ asset('uploads/default/no-image-found.png') }}">
                                        @endif
                                        <input type="file" name="sign_up_left_image" id="sign_up_left_image" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('sign_up_left_image'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('sign_up_left_image') }}</span>
                                    @endif
                                    <p><span class="text-black">Accepted Files:</span> PNG <br> <span class="text-black">Recommend Size:</span> 800 x 540 (1MB)</p>
                                </div>
                            </div>

                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Forgot Title <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="forgot_title" value="{{get_option('forgot_title')}}" class="form-control" >
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Forgot Subtitle <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="forgot_subtitle" value="{{get_option('forgot_subtitle')}}" class="form-control" >
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Forgot Button Name <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="forgot_btn_name" value="{{get_option('forgot_btn_name')}}" class="form-control" >
                                </div>
                            </div>

                            <hr>

                            <div class="item-top mb-30"><h2>Social Media Profile Link</h2></div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Facebook URL <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="facebook_url" value="{{get_option('facebook_url')}}" class="form-control">
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Twitter URL <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="twitter_url" value="{{get_option('twitter_url')}}" class="form-control">
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">LinkedIn URL <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="linkedin_url" value="{{get_option('linkedin_url')}}" class="form-control">
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3">Pinterest URL <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="pinterest_url" value="{{get_option('pinterest_url')}}" class="form-control">
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


@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>
@endpush
