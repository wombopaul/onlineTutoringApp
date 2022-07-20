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
                        <form action="{{route('settings.general_setting.cms.update')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="custom-form-group mb-3 row">
                                <label for="get_in_touch_title" class="col-lg-3 text-lg-right text-black">Get In Touch Title </label>
                                <div class="col-lg-9">
                                    <input type="text" name="get_in_touch_title" id="get_in_touch_title" value="{{ get_option('get_in_touch_title') }}"
                                           class="form-control" placeholder="Type ">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="send_us_msg_title" class="col-lg-3 text-lg-right text-black">Send Us Msg Title </label>
                                <div class="col-lg-9">
                                    <input type="text" name="send_us_msg_title" id="send_us_msg_title" value="{{ get_option('send_us_msg_title') }}"
                                           class="form-control" placeholder="Type ">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="contact_us_location" class="col-lg-3 text-lg-right text-black">Location </label>
                                <div class="col-lg-9">
                                    <input type="text" name="contact_us_location" id="contact_us_location" value="{{ get_option('contact_us_location') }}" class="form-control" placeholder="Type location">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="contact_us_email_one" class="col-lg-3 text-lg-right text-black">Email One </label>
                                <div class="col-lg-9">
                                    <input type="email" name="contact_us_email_one" id="contact_us_email_one" value="{{ get_option('contact_us_email_one') }}" class="form-control" placeholder="Type email">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="contact_us_email_two" class="col-lg-3 text-lg-right text-black">Email Two </label>
                                <div class="col-lg-9">
                                    <input type="email" name="contact_us_email_two" id="contact_us_email_two" value="{{ get_option('contact_us_email_two') }}" class="form-control" placeholder="Type email">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="contact_us_phone_one" class="col-lg-3 text-lg-right text-black">Contact Number One </label>
                                <div class="col-lg-9">
                                    <input type="text" name="contact_us_phone_one" id="contact_us_phone_one" value="{{ get_option('contact_us_phone_one') }}" class="form-control"
                                           placeholder="Type phone one">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="contact_us_phone_two" class="col-lg-3 text-lg-right text-black">Contact Number Two </label>
                                <div class="col-lg-9">
                                    <input type="text" name="contact_us_phone_two" id="contact_us_phone_two" value="{{ get_option('contact_us_phone_two') }}" class="form-control"
                                           placeholder="Type phone two">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="contact_us_map_link" class="col-lg-3 text-lg-right text-black">Location Map Link </label>
                                <div class="col-lg-9">
                                    <input type="text" name="contact_us_map_link" id="contact_us_map_link" value="{{ get_option('contact_us_map_link') }}" class="form-control" placeholder="Type map link">
                                </div>
                            </div>
                            <div class="custom-form-group mb-3 row">
                                <label for="contact_us_description" class="col-lg-3 text-lg-right text-black">Description </label>
                                <div class="col-lg-9">
                                    <textarea name="contact_us_description" id="contact_us_description" rows="5" class="form-control">{{ get_option('contact_us_description') }}</textarea>
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
