@extends('layouts.auth')

@section('content')
    <!-- Sing Up Area Start -->
    <section class="sign-up-page p-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-5">
                    <div class="sign-up-left-content">
                        <div class="sign-up-top-logo">
                            <a href="{{ route('main.index') }}"><img src="{{getImageFile(get_option('app_logo'))}}" alt="logo"></a>
                        </div>
                        <p>{{get_option('sign_up_left_text')}}</p>
                        @if(get_option('sign_up_left_image'))
                            <div class="sign-up-bottom-img">
                                <img src="{{getImageFile(get_option('sign_up_left_image'))}}" alt="hero" class="img-fluid">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="sign-up-right-content bg-white">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <h5 class="mb-1">{{__('app.sign_in')}}</h5>
                            <p class="font-14 mb-30">{{__('app.new_user')}} ? <a href="{{route('sign-up')}}" class="color-hover text-decoration-underline font-medium">{{__('app.create_an_account')}}</a></p>

                            <div class="row mb-30">
                                <div class="col-md-12">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.email')}}</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control email" placeholder="Type your email">
                                    @if ($errors->has('email'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-md-12">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.password')}}</label>
                                    <div class="form-group mb-0 position-relative">
                                        <input class="form-control password" name="password" value="{{old('password')}}" placeholder="*********" type="password">
                                        <span class="toggle cursor fas fa-eye pass-icon"></span>
                                    </div>

                                    @if ($errors->has('password'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-30">
                                <div class="col-md-12"><a href="{{ route('forget-password') }}" class="color-hover text-decoration-underline font-medium">{{__('app.forgot_password')}}?</a></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">{{__('app.sign_in')}}</button>
                                </div>
                            </div>

                            <div class="social-media-login-wrap">
                                @if(env('GOOGLE_LOGIN_STATUS') == 1)
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <a href="{{ route('login.google') }}" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100 google-login">Sign In With Google</a>
                                    </div>
                                </div>
                                @endif
                                {{-- @if(env('FACEBOOK_LOGIN_STATUS') == 1)
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <a href="{{ route('login.facebook') }}" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100 facebook-login">Sign In With Facebook</a>
                                    </div>
                                </div>
                                @endif --}}
                                @if(env('TWITTER_LOGIN_STATUS') == 1)
                                <div class="row mb-0">
                                    <div class="col-md-12">
                                        <a href="{{ route('login.twitter') }}" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100 twitter-login">Sign In With Twitter</a>
                                    </div>
                                </div>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sing Up Area End -->
@endsection
