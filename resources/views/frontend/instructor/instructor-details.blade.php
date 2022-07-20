@extends('frontend.layouts.app')

@section('content')
    <div class="bg-page">

        <!-- Page Header Start -->
        <header class="page-banner-header gradient-bg position-relative">
            <div class="section-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="page-banner-content text-center">
                                <h3 class="page-banner-heading text-white pb-15">{{ __('app.about_instructor') }}</h3>

                                <!-- Breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item font-14"><a href="{{ url('/') }}">{{ __('app.home') }}</a></li>
                                        <li class="breadcrumb-item font-14 active" aria-current="page">{{ __('app.about_instructor') }}</li>
                                    </ol>
                                </nav>
                                <!-- Breadcrumb End-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Page Header End -->

        <!-- Instructor Details Area Start -->
        <section class="instructor-details-area section-t-space">
            <div class="container">
                <div class="row instructor-details-main-row">
                    <div class="col-12 col-md-12 col-lg-8 col-xl-9">
                        <div class="instructor-details-left-content">

                            <!-- about instructor box -->
                            <div class="instructor-details-left-inner-box about-instructor-box bg-white radius-3">
                                <h5 class="instructor-details-inner-title">{{ __('app.about') }} {{ @$userInstructor->name }}</h5>
                                <p>{{ @$userInstructor->instructor->about_me }}</p>
                            </div>

                            <!-- Certificate and awards -->
                            <div class="instructor-details-left-inner-box certificate-awards-box bg-white radius-3">
                                <div class="row">
                                    <div class="col-md-6 certificate-awards-inner">
                                        <h5 class="instructor-details-inner-title">{{ __('app.certifications') }}</h5>
                                        <ul>
                                            @foreach(@$userInstructor->instructor->certificates as $certificate)
                                                <li class="font-15"><span class="color-heading">{{ $certificate->passing_year }}</span>{{ $certificate->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-6 certificate-awards-inner">
                                        <h5 class="instructor-details-inner-title">{{ __('app.awards') }}</h5>
                                        <ul>
                                            @foreach(@$userInstructor->instructor->awards as $award)
                                                <li class="font-15"><span class="color-heading">{{ $award->winning_year }}</span>{{ $award->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- My others courses -->
                            <div class="instructor-details-left-inner-box my-others-courses bg-white radius-3">
                                <h5 class="instructor-details-inner-title">My courses ({{ @$userInstructor->courses->count() }} )</h5>
                                <div class="row" id="appendInstructorCourses">
                                    @include('frontend.instructor.render-instructor-courses')

                                </div>
                                @if(count($loadMoreButtonShowCourses) > 6)
                                <!-- Load More Button-->
                                <div class="d-block" id="loadMoreBtn"><button type="button" class="theme-btn theme-button2 load-more-btn loadMore">{{ __('app.load_more') }} <i data-feather="arrow-right"></i></button></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-4 col-xl-3">
                        <div class="instructor-details-right-content radius-3">
                            <div class="course-info-box instructor-info-box bg-white">

                                <div class="instructor-details-right-img-box text-center">
                                    <div class="instructor-details-avatar-wrap radius-50 overflow-hidden mx-auto">
                                        <img src="{{ getImageFile($userInstructor->image_path) }}" alt="img" class="radius-50">
                                    </div>
                                    <h6 class="instructor-details-name">{{ $userInstructor->instructor->name }}</h6>
                                    <p class="instructor-details-designation text-uppercase font-12 font-semi-bold">{{ $userInstructor->instructor->professional_title }}</p>
                                </div>

                                <div class="course-includes-box p-0">
                                    <ul>
                                        <li>
                                            <span class="iconify" data-icon="dashicons:book"></span>
                                            <span>{{ @$userInstructor->courses->count() }} {{ __('app.courses') }}</span>
                                        </li>
                                        <li>
                                            <span class="iconify" data-icon="bi:camera-video"></span>
                                            <span>{{@$total_lectures}} {{ __('app.video_lectures') }}</span>
                                        </li>
                                        <li>
                                            <span class="iconify" data-icon="healthicons:i-exam-multiple-choice-outline"></span>
                                            <span>{{ @$total_quizzes }} {{ __('app.quizzes') }}</span>
                                        </li>
                                        <li>
                                            <span class="iconify" data-icon="bi:book"></span>
                                            <span>{{ @$total_assignments }} {{ __('app.assignments') }}</span>
                                        </li>
                                        <li>
                                            <span class="iconify" data-icon="bi:star"></span>
                                            <span>{{ $total_rating }} Reviews ({{ number_format(@$average_rating, 1) }} average)</span>
                                        </li>
                                        <li>
                                            <span class="iconify" data-icon="codicon:globe"></span>
                                            <span>{{ @$userInstructor->instructor->address }}</span>
                                        </li>
                                    </ul>
                                </div>
                                @php
                                    $social_link = json_decode(@$userInstructor->instructor->social_link);
                                @endphp

                                <div class="instructor-social mt-25">
                                    <ul class="d-flex align-items-center">
                                        <li>
                                            <a href="{{@$userInstructor->instructor->social_link ? $social_link->facebook : ''}}">
                                                <span class="iconify" data-icon="ant-design:facebook-filled"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{@$userInstructor->instructor->social_link ? $social_link->twitter : ''}}">
                                                <span class="iconify" data-icon="ant-design:twitter-square-filled"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{@$userInstructor->instructor->social_link ? $social_link->linkedin : ''}}">
                                                <span class="iconify" data-icon="ant-design:linkedin-filled"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{@$userInstructor->instructor->social_link ? $social_link->pinterest : ''}}">
                                                <span class="iconify" data-icon="fa-brands:pinterest-square" data-width="1em" data-height="1em"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Instructor Details Area End -->

    </div>
    <input type="hidden" value="3" class="course_paginate_number">
    <input type="hidden" class="instructorCoursePaginateRoute" value="{{ route('instructorCoursePaginate', $userInstructor->id) }}">
@endsection

@push('script')
    <script src="{{ asset('frontend/assets/js/course/addToCart.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/course/addToWishlist.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom/instructor-course-review-paginate.js') }}"></script>
@endpush
