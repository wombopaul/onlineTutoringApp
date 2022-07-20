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
                        <div class="item-top mb-30 d-flex justify-content-between">
                            <h2>{{ @$title }}</h2>
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#sendTestMail" class="btn btn-success btn-sm"> <i class="fa fa-envelope"></i> {{__('app.send_test_mail')}} </a>
                        </div>
                        <form action="{{ route('settings.save.setting')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                                    <div class="form-group text-black">
                                        <label>{{__('app.MAIL_DRIVER')}} </label>
                                        <input type="text" name="MAIL_MAILER" value="{{get_option('MAIL_MAILER')}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                                    <div class="form-group text-black">
                                        <label>{{__('app.MAIL_HOST')}} </label>
                                        <input type="text" name="MAIL_HOST" value="{{get_option('MAIL_HOST')}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                                    <div class="form-group text-black">
                                        <label>{{__('app.MAIL_PORT')}} </label>
                                        <input type="text" name="MAIL_PORT" value="{{get_option('MAIL_PORT')}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                                    <div class="form-group text-black">
                                        <label>{{__('app.MAIL_USERNAME')}} </label>
                                        <input type="text" name="MAIL_USERNAME" value="{{get_option('MAIL_USERNAME')}}" class="form-control">
                                    </div>
                                </div>


                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                                    <div class="form-group text-black">
                                        <label>{{__('app.MAIL_PASSWORD')}} </label>
                                        <input type="password" name="MAIL_PASSWORD" value="{{get_option('MAIL_PASSWORD')}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                                    <div class="form-group text-black">
                                        <label>{{__('app.MAIL_ENCRYPTION')}} <span class="text-danger">*</span></label>
                                        <select name="MAIL_ENCRYPTION" class="form-control">
                                            <option value="tls" {{get_option('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }} > tls </option>
                                            <option value="ssl" {{get_option('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }} > ssl </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                                    <div class="form-group text-black">
                                        <label>{{__('app.MAIL_FROM_ADDRESS')}} </label>
                                        <input type="text" name="MAIL_FROM_ADDRESS" value="{{get_option('MAIL_FROM_ADDRESS')}}" class="form-control">
                                    </div>
                                </div>


                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                                    <div class="form-group text-black">
                                        <label>{{__('app.MAIL_FROM_NAME')}} </label>
                                        <input type="text" name="MAIL_FROM_NAME" value="{{get_option('MAIL_FROM_NAME')}}" class="form-control">
                                    </div>
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

    <div class="modal fade" id="sendTestMail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('app.test_mail')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('settings.send.test.mail')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-black">
                            <label for="to" class="col-form-label">{{__('app.recipient')}}:</label>
                            <input type="email" name="to" class="form-control" id="to" placeholder="{{__('app.recipient_mail')}}" required>
                        </div>
                        <div class="mb-3 text-black">
                            <label for="to" class="col-form-label">{{__('app.subject')}}:</label>
                            <input type="text" name="subject" class="form-control" id="to" placeholder="{{__('app.subject')}}" value="Test Mail" required>
                        </div>
                        <div class="mb-3 text-black">
                            <label for="message" class="col-form-label">{{__('app.message')}}:</label>
                            <textarea name="message" class="form-control" id="message-text">Hi, This is a test mail</textarea>
                        </div>
                    </div>
                    <div class="modal-footer button__list">
                        <button type="submit" class="btn btn-warning mx-md-2">Send</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

