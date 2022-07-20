@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.profile')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.profile')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <form method="POST" action="{{route('save.profile', [$instructor->uuid])}}" enctype="multipart/form-data">
            @csrf
            <div class="instructor-profile-info-box">
                <h6 class="instructor-info-box-title">{{__('app.personal_info')}}</h6>

                <div class="profile-top mb-4">
                    <div class="d-flex align-items-center">
                        <div class="profile-image radius-50">
                            <img class="avater-image" id="target1" src="{{getImageFile($user->image_path)}}" alt="img">
                            <div class="custom-fileuplode">
                                <label for="fileuplode" class="file-uplode-btn bg-hover text-white radius-50"><span class="iconify" data-icon="bx:bx-edit"></span></label>
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
                        <input type="text" name="first_name" value="{{$instructor->first_name}}" class="form-control" placeholder="{{__('app.first_name')}}">
                        @if ($errors->has('first_name'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('app.last_name')}}</label>
                        <input type="text" name="last_name" value="{{$instructor->last_name}}" class="form-control" placeholder="{{__('app.last_name')}}">
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
                        <label class="font-medium font-15 color-heading">{{__('app.professional_title')}}</label>
                        <input type="text" name="professional_title" value="{{$instructor->professional_title}}" class="form-control" placeholder="Type your professional title">
                        @if ($errors->has('professional_title'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('professional_title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('app.phone_number')}}</label>
                        <input type="text" name="phone_number" value="{{$instructor->phone_number}}" class="form-control" placeholder="Type your phone number">

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
                                <option value="{{$country->id}}" @if(old('country_id'))
                                    {{old('country_id') == $country->id ? 'selected' : '' }}
                                    @else
                                    {{$instructor->country_id == $country->id ? 'selected' : '' }}
                                    @endif >{{$country->country_name}}</option>
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
                                @if($instructor->country)
                                    @foreach($instructor->country->states as $selected_state)
                                        <option
                                            value="{{$selected_state->id}}" {{$instructor->state_id == $selected_state->id ? 'selected' : '' }} >{{$selected_state->name}}</option>
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
                                @if($instructor->state)
                                    @foreach($instructor->state->cities as $selected_city)
                                        <option value="{{$selected_city->id}}" {{$instructor->city_id == $selected_city->id ? 'selected' : '' }} >{{$selected_city->name}}</option>
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
                        <input type="text" name="postal_code" value="{{$instructor->postal_code}}" class="form-control" placeholder="{{__('app.postal_code')}}">

                        @if ($errors->has('postal_code'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('postal_code') }}</span>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('app.address')}}</label>
                        <input type="text" name="address" value="{{$instructor->address}}" class="form-control" placeholder="Type your address">

                        @if ($errors->has('address'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('address') }}</span>
                        @endif


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <label class="font-medium font-15 color-heading">{{__('app.bio')}}</label>
                        <textarea class="form-control" name="about_me" id="exampleFormControlTextarea1" rows="3" placeholder="Type about yourself">{{$instructor->about_me}}</textarea>
                        @if ($errors->has('about_me'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('about_me') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-30">
                    <label class="font-medium font-15 color-heading">{{__('app.gender')}}</label>
                    <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" {{$instructor->gender == 'Male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" {{$instructor->gender == 'Female' ? 'checked' : '' }} >
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="Others" {{$instructor->gender == 'Others' ? 'checked' : '' }} >
                        <label class="form-check-label" for="inlineRadio3">Others</label>
                    </div>
                    </div>
                    @if ($errors->has('gender'))
                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('gender') }}</span>
                    @endif
                </div>
            </div>

            <div class="instructor-profile-info-box">
                <h6 class="instructor-info-box-title">{{__('app.social_links')}}</h6>

                @php
                    $social_link = json_decode($instructor->social_link);
                @endphp
                <div class="row">
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">Facebook</label>
                        <input type="text" name="social_link[facebook]" value="{{$instructor->social_link ? $social_link->facebook : ''}}" class="form-control"
                               placeholder="https://facebook.com">
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">Twitter</label>
                        <input type="text" name="social_link[twitter]" value="{{$instructor->social_link ? $social_link->twitter : ''}}" class="form-control"
                               placeholder="https://twitter.com">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">Linkedin</label>
                        <input type="text" name="social_link[linkedin]" value="{{$instructor->social_link ? $social_link->linkedin : ''}}" class="form-control"
                               placeholder="https://linkedin.com">
                    </div>
                    <div class="col-md-6 mb-30">
                        <label class="font-medium font-15 color-heading">Pinterest</label>
                        <input type="text" name="social_link[pinterest]" value="{{$instructor->social_link ? $social_link->pinterest : ''}}" class="form-control"
                               placeholder="https://pinterest.com">
                    </div>
                </div>
            </div>

            <div class="instructor-profile-info-box">
                <h6 class="instructor-info-box-title">{{__('app.certifications')}}</h6>
                <div class="certificates">
                    <div class="certificate-item">
                        @if($instructor->certificates)
                            @foreach($instructor->certificates as $certificate)
                                <div class="row mb-30 removable-item">
                                    <div class="col-md-8">
                                        <label class="font-medium font-15 color-heading">{{__('app.title_of_the_certificate')}}</label>
                                        <input type="text" name="certificate_title[]" value="{{$certificate->name}}" class="form-control"
                                               placeholder="{{__('app.title_of_the_certificate')}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="font-medium font-15 color-heading">{{__('app.date')}}</label>
                                        <input type="text" name="certificate_date[]" value="{{$certificate->passing_year}}" class="form-control" placeholder="{{__('app.date')}}">
                                    </div>
                                    <div class="col-md-1">
                                        <div class="mt-45">
                                            <a href="javascript:void(0);" class="remove-item"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <div class="row mb-30">
                                <div class="col-md-8">
                                    <label class="font-medium font-15 color-heading">{{__('app.title_of_the_certificate')}}</label>
                                    <input type="text" name="certificate_title[]" class="form-control" placeholder="{{__('app.title_of_the_certificate')}}">
                                </div>
                                <div class="col-md-3">
                                    <label class="font-medium font-15 color-heading">{{__('app.year')}}</label>
                                    <input type="text" name="certificate_date[]" class="form-control" placeholder="{{__('app.year')}}">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row mb-30">
                        <div class="col-12">
                            <a href="javascript:void(0);" class="theme-btn border-1 theme-border add-more-certificate"><span class="iconify me-2"
                                                                                                                             data-icon="akar-icons:circle-plus"></span>{{__('app.add_more_certificate')}}
                            </a>
                        </div>
                    </div>
                </div>


            </div>

            <div class="instructor-profile-info-box">
                <h6 class="instructor-info-box-title">{{__('app.awards')}}</h6>

                <div class="awards">
                    <div class="award-item">
                        @if($instructor->awards)
                            @foreach($instructor->awards as $award)
                                <div class="instructor-add-extra-field-box mb-30 removable-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="font-medium font-15 color-heading">{{__('app.title_of_the_award')}}</label>
                                            <input type="text" name="award_title[]" value="{{$award->name}}" class="form-control" placeholder="{{__('app.title_of_the_award')}}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="font-medium font-15 color-heading">{{__('app.year')}}</label>
                                            <input type="text" name="award_year[]" value="{{$award->winning_year}}" class="form-control" placeholder="{{__('app.year')}}">
                                        </div>
                                        <div class="col-md-1">
                                            <div class="mt-45">
                                                <a href="javascript:void(0);" class="remove-item"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="instructor-add-extra-field-box mb-30">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="font-medium font-15 color-heading">{{__('app.title_of_the_award')}}</label>
                                        <input type="text" name="award_title[]" class="form-control" placeholder="{{__('app.title_of_the_award')}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="font-medium font-15 color-heading">{{__('app.year')}}</label>
                                        <input type="text" name="award_year[]" class="form-control" placeholder="{{__('app.year')}}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="instructor-add-extra-field-box">
                        <div class="row mb-30">
                            <div class="col-12">
                                <a href="javascript:void(0);" class="theme-btn border-1 theme-border add-more-award"><span class="iconify me-2"
                                                                                                                           data-icon="akar-icons:circle-plus"></span>{{__('app.add_more_award')}}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="col-12">
                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold">{{__('app.save_profile_now')}}</button>
            </div>
        </form>

    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom/instructor-profile.js')}}"></script>
@endpush
