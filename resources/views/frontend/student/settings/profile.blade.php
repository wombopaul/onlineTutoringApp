@extends('frontend.layouts.app')

@section('content')
    <div class="bg-page">
        <!-- Page Header Start -->
        @include('frontend.student.settings.header')
        <!-- Page Header End -->

        <!-- Student Profile Page Area Start -->
        <section class="student-profile-page">
            <div class="container">
                <div class="student-profile-page-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="row bg-white">
                                <!-- Student Profile Left part -->
                                @include('frontend.student.settings.sidebar')

                                <!-- Student Profile Right part -->
                                <div class="col-lg-9 p-0">
                                    <div class="student-profile-right-part">
                                        <h6>{{__('app.public_profile')}}</h6>
                                        <form action="{{route('student.save-profile', [$student->uuid])}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="profile-top mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="profile-image radius-50">

                                                        <img class="avater-image" id="target1" src="{{getImageFile($user->image_path)}}" alt="img">
                                                        <div class="custom-fileuplode">
                                                            <label for="fileuplode" class="file-uplode-btn bg-hover text-white radius-50">
                                                                <span class="iconify" data-icon="bx:bx-edit"></span></label>
                                                            <input type="file" id="fileuplode" name="image" accept="image/*" class="putImage1" onchange="previewFile(this)">
                                                        </div>
                                                    </div>
                                                    <div class="author-info">
                                                        <p class="font-medium font-15 color-heading">{{__('app.select_your_picture')}}</p>
                                                        <p class="font-14">Accepted Image Files: JPEG, JPG, PNG <br> Recommend Size: 300 x 228 (1MB)</p>
                                                    </div>
                                                </div>
                                                @if ($errors->has('image'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.first_name')}}</label>
                                                    <input type="text"  name="first_name" value="{{$student->first_name}}" class="form-control" placeholder="{{__('app.first_name')}}">
                                                    @if ($errors->has('first_name'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.last_name')}}</label>
                                                    <input type="text" name="last_name" value="{{$student->last_name}}" class="form-control" placeholder="{{__('app.last_name')}}">
                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.email')}}</label>
                                                    <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Type your email">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.phone_number')}}</label>
                                                    <input type="text" name="phone_number" value="{{$student->phone_number}}" class="form-control" placeholder="Type your phone number">
                                                    @if ($errors->has('phone_number'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('phone_number') }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.country')}}</label>
                                                    <select name="country_id" id="country_id" class="form-select">
                                                        <option value="">{{__('app.select_country')}}</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}" @if(old('country_id'))  {{old('country_id') == $country->id ? 'selected' : '' }} @else  {{$student->country_id == $country->id ? 'selected' : '' }}  @endif >{{$country->country_name}}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('country_id'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('country_id') }}</span>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.state')}}</label>
                                                    <select name="state_id" id="state_id" class="form-select">
                                                        <option value="">{{__('app.select_state')}}</option>
                                                        @if(old('country_id'))
                                                            @foreach($states as $state)
                                                                <option value="{{$state->id}}" {{old('state_id') == $state->id ? 'selected' : '' }} >{{$state->name}}</option>
                                                            @endforeach
                                                        @else
                                                            @if($student->country)
                                                                @foreach($student->country->states as $selected_state)
                                                                    <option value="{{$selected_state->id}}" {{$student->state_id == $selected_state->id ? 'selected' : '' }} >{{$selected_state->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </select>

                                                    @if ($errors->has('state_id'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('state_id') }}</span>
                                                    @endif

                                                </div>
                                                <div class="col-md-4 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.city')}}</label>
                                                    <select name="city_id" id="city_id" class="form-select">
                                                        <option value="">{{__('app.select_city')}}</option>

                                                        @if(old('state_id'))
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' : '' }} >{{$city->name}}</option>
                                                            @endforeach
                                                        @else
                                                            @if($student->state)
                                                                @foreach($student->state->cities as $selected_city)
                                                                    <option value="{{$selected_city->id}}" {{$student->city_id == $selected_city->id ? 'selected' : '' }} >{{$selected_city->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        @endif

                                                    </select>

                                                    @if ($errors->has('city_id'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('city_id') }}</span>
                                                    @endif

                                                </div>
                                                <div class="col-md-4 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.postal_code')}}</label>
                                                    <input type="text" name="postal_code" value="{{$student->postal_code}}" class="form-control" placeholder="{{__('app.postal_code')}}">

                                                    @if ($errors->has('postal_code'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('postal_code') }}</span>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.address')}}</label>
                                                    <input type="text" name="address" value="{{$student->address}}" class="form-control" placeholder="Type your address">

                                                    @if ($errors->has('address'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('address') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <label class="font-medium font-15 color-heading">{{__('app.bio')}}</label>
                                                    <textarea class="form-control" name="about_me" id="exampleFormControlTextarea1" rows="3" placeholder="Type about yourself">{{$student->about_me}}</textarea>
                                                    @if ($errors->has('about_me'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('about_me') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mb-30">
                                                <div class="col-md-12">
                                                    <label class="font-medium font-15 color-heading">{{__('app.gender')}}</label>

                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" {{$student->gender == 'Male' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio1">{{__('app.male')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" {{$student->gender == 'Female' ? 'checked' : '' }} >
                                                            <label class="form-check-label" for="inlineRadio2">{{__('app.female')}}</label>
                                                        </div>
                                                        {{-- <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="Others" {{$student->gender == 'Others' ? 'checked' : '' }} >
                                                            <label class="form-check-label" for="inlineRadio3">{{__('app.others')}}</label>
                                                        </div> --}}
                                                    </div>

                                                    @if ($errors->has('gender'))
                                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('gender') }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold">{{__('app.save_profile_now')}}</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Student Profile Page Area End -->
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom/student-profile.js')}}"></script>
@endpush
