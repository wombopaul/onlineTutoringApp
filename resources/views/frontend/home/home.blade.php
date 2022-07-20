@extends('frontend.layouts.app')

@section('content')

    <!-- Header Start -->
    <header class="hero-area gradient-bg position-relative">
        <div class="section-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-7 col-lg-5">
                        <div class="hero-content">
                            <h6 class="come-for-learn-text">
                                @foreach(@$home->banner_mini_words_title ?? [] as $banner_mini_word)
                                    <span>{{ $banner_mini_word }}</span>
                                @endforeach
                            </h6>

                            <div class="text">
                                <h1 class="hero-heading">{{ @$home->banner_first_line_title }}</h1>
                                <h1 class="hero-heading">
                                    <span class="main-middle-text">{{ @$home->banner_second_line_title }}</span>
                                    @foreach(@$home->banner_second_line_changeable_words ?? [] as $banner_second_line_changeable_word)
                                    <span class="word">{{ $banner_second_line_changeable_word }}</span>
                                    @endforeach
                                </h1>
                                <h1 class="hero-heading hero-heading-last-word">{{ @$home->banner_third_line_title }}</h1>
                            </div>

                            <p>{{ @$home->banner_subtitle }} </p>
                            <div class="hero-btns">
                                <a href="{{ route('courses') }}" class="theme-btn theme-button1">{{ __('app.browse_course') }} <i data-feather="arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-5 col-lg-7">
                        <div class="hero-right-side">
                            <img src="{{ getImageFile(@$home->banner_image) }}" alt="hero-img" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Special Feature Area Start -->
    <section class="special-feature-area p-0">
        <div class="container">
            <div class="row">
                <!-- Single Feature Item start-->
                <div class="col-md-4">
                    <div class="single-feature-item d-flex align-items-center">
                        <div class="flex-shrink-0 feature-img-wrap">
                            <img src="{{ getImageFile(get_option('home_special_feature_first_logo')) }}" alt="feature">
                        </div>
                        <div class="flex-grow-1 ms-3 feature-content">
                            <h6>{{ get_option('home_special_feature_first_title') }}</h6>
                            <p>{{ get_option('home_special_feature_first_subtitle') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Single Feature Item End-->
                <!-- Single Feature Item start-->
                <div class="col-md-4">
                    <div class="single-feature-item d-flex align-items-center">
                        <div class="flex-shrink-0 feature-img-wrap">
                            <img src="{{ getImageFile(get_option('home_special_feature_second_logo')) }}" alt="feature">
                        </div>
                        <div class="flex-grow-1 ms-3 feature-content">
                            <h6>{{ get_option('home_special_feature_second_title') }}</h6>
                            <p>{{ get_option('home_special_feature_second_subtitle') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Single Feature Item End-->
                <!-- Single Feature Item start-->
                <div class="col-md-4">
                    <div class="single-feature-item d-flex align-items-center">
                        <div class="flex-shrink-0 feature-img-wrap">
                            <img src="{{ getImageFile(get_option('home_special_feature_third_logo')) }}" alt="feature">
                        </div>
                        <div class="flex-grow-1 ms-3 feature-content">
                            <h6>{{ get_option('home_special_feature_third_title') }}</h6>
                            <p>{{ get_option('home_special_feature_third_subtitle') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Single Feature Item End-->

            </div>
        </div>
    </section>
    <!-- Special Feature Area End -->

    <!-- Board Selection of Courses Area Start -->

    <section class="courses-area section-t-space section-b-85-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section-left-align-->
                    <div class="section-left-title-with-btn d-flex justify-content-between align-items-end">
                        <div class="section-title section-title-left d-flex align-items-start">
                            <div class="section-heading-img"><img src="{{ getImageFile(get_option('course_logo')) }}" alt="Course"></div>
                            <div>
                                <h3 class="section-heading">{{ get_option('course_title') }}</h3>
                                <p class="section-sub-heading">{{ get_option('course_subtitle') }}</p>
                            </div>
                        </div>

                        <!-- Tab panel nav list -->
                        <div class="course-tab-nav-wrap d-flex justify-content-between">
                            <ul class="nav nav-tabs tab-nav-list border-0" id="myTab" role="tablist">
                                @foreach($featureCategories as $key => $category)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $category->slug }}-tab" data-bs-toggle="tab" href="#{{ $category->slug }}" role="tab"
                                           aria-controls="{{ $category->slug }}" aria-selected="{{ $key == 0 ? 'true' : 'false' }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Tab panel nav list -->

                    </div>
                    <!-- section-left-align-->
                </div>
            </div>

            <!-- Tab Content-->
            <div class="tab-content" id="myTabContent">
                @foreach($featureCategories as $key => $category)
                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="{{ $category->slug }}" role="tabpanel" aria-labelledby="{{ $category->slug }}-tab">
                            <div class="course-slider-items owl-carousel owl-theme">
                                <!-- Course item start -->
                                @foreach($category->courses as $course)
                                <div class="col-12 col-sm-4 col-lg-3 w-100">
                                    <div class="card course-item border-0 radius-3 bg-white">
                                        <div class="course-img-wrap overflow-hidden">
                                            <?php
                                                $special = @$course->specialPromotionTagCourse->specialPromotionTag->name;
                                            ?>
                                            @if($special)
                                                <span class="course-tag badge radius-3 font-12 font-medium position-absolute bg-orange">
                                                    {{ @$special }}
                                                </span>
                                            @endif
                                            <a href="{{ route('course-details', $course->slug) }}"><img src="{{getImageFile($course->image_path)}}" alt="course" class="img-fluid"></a>
                                            <div class="course-item-hover-btns position-absolute">
                                                <span class="course-item-btn addToWishlist" data-course_id="{{ $course->id }}" data-route="{{ route('student.addToWishlist') }}"
                                                      title="Add to Wishlist">
                                                    <i data-feather="heart"></i>
                                                </span>
                                                <span class="course-item-btn addToCart" data-course_id="{{ $course->id }}" data-route="{{ route('student.addToCart') }}"
                                                      title="Add to Cart">
                                                    <i data-feather="shopping-bag"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title course-title"><a href="{{ route('course-details', $course->slug) }}">{{ Str::limit($course->title, 40) }}</a></h5>
                                            <p class="card-text instructor-name-certificate font-medium text-uppercase font-12">
                                                {{ @$course->instructor->name }}
                                                @if(get_instructor_ranking_level(@$course->instructor->user_id))
                                                    | {{ get_instructor_ranking_level(@$course->instructor->user_id) }}
                                                @endif
                                            </p>
                                            <div class="course-item-bottom">
                                                <div class="course-rating d-flex align-items-center">
                                                    <span class="font-medium font-14 me-2">{{ number_format($course->average_rating, 1) }}</span>
                                                    <ul class="rating-list d-flex align-items-center me-2">
                                                        @include('frontend.course.render-course-rating')
                                                    </ul>
                                                    <span class="rating-count font-14">({{ $course->reviews->count() }})</span>
                                                </div>
                                                @if($course->learner_accessibility == 'paid')
                                                    <?php
                                                        $startDate = date('d-m-Y H:i:s', strtotime(@$course->promotionCourse->promotion->start_date));
                                                        $endDate = date('d-m-Y H:i:s', strtotime(@$course->promotionCourse->promotion->end_date));
                                                        $percentage = @$course->promotionCourse->promotion->percentage;
                                                        $discount_price = number_format($course->price - (($course->price * $percentage) / 100), 2);
                                                    ?>

                                                    @if(now()->gt($startDate) && now()->lt($endDate))
                                                    <div class="instructor-bottom-item font-14 font-semi-bold text-uppercase">
                                                        {{ __('app.price') }}: <span class="color-hover">
                                                            @if(get_currency_placement() == 'after')
                                                                {{ $discount_price }} {{ get_currency_symbol() }}
                                                            @else
                                                                {{ get_currency_symbol() }} {{ $discount_price }}
                                                            @endif

                                                        </span>
                                                        <span class="text-decoration-line-through fw-normal font-14 color-gray ps-3">
                                                            @if(get_currency_placement() == 'after')
                                                                {{ $course->price }} {{ get_currency_symbol() }}
                                                            @else
                                                                {{ get_currency_symbol() }} {{ $course->price }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @else
                                                    <div class="instructor-bottom-item font-14 font-semi-bold text-uppercase">
                                                        {{ __('app.price') }}: <span class="color-hover">
                                                            @if(get_currency_placement() == 'after')
                                                                {{ $course->price }} {{ get_currency_symbol() }}
                                                            @else
                                                                {{ get_currency_symbol() }} {{ $course->price }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @endif
                                                @elseif($course->learner_accessibility == 'free')
                                                    <div class="instructor-bottom-item font-14 font-semi-bold text-uppercase">
                                                        {{ __('app.free') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- Course item end -->
                            </div>
                        </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Board Selection of Courses Area End -->

    <!-- Our Top Categories Area Start -->
    <section class="top-categories-area gradient-bg p-0">
        <div class="section-overlay section-t-space section-b-space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <div class="section-heading-img"><img src="{{ asset(get_option('top_category_logo')) }}" alt="Our categories"></div>
                            <h3 class="section-heading section-heading-light">{{ get_option('top_category_title') }}</h3>
                            <p class="section-sub-heading section-sub-heading-light">{{ get_option('top_category_subtitle') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row top-categories-content-wrap">
                    @foreach(@$firstFourCategories as $firstFourCategory)

                    <!-- Single Feature Item start-->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="single-feature-item top-cat-item align-items-center">
                            <div class="flex-shrink-0 feature-img-wrap">
                                <img src="{{ getImageFile($firstFourCategory->image ?? 'frontend/assets/img/top-categories-icon/1.png') }}" alt="categories">
                            </div>
                            <div class="flex-grow-1 mt-3 feature-content">
                                <h6>{{ Str::limit($firstFourCategory->name, 20) }}</h6>
                                <p>{{ @$firstFourCategory->courses->count() }} {{ __('app.course') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Feature Item End-->

                    @endforeach
                    <!-- section button start-->
                    <div class="col-12 text-center section-btn">
                        <a href="{{ route('courses') }}" class="theme-btn theme-button1">{{ __('app.all_categories') }} <i data-feather="arrow-right"></i></a>
                    </div>
                    <!-- section button end-->

                </div>
            </div>
        </div>
    </section>
    <!-- Our Top Categories Area End -->

    <!-- Our Top Instructor Area Start -->
    <section class="top-instructor-area section-t-space bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section-left-align-->
                    <div class="section-left-title-with-btn d-flex justify-content-between align-items-end">
                        <div class="section-title section-title-left d-flex align-items-start">
                            <div class="section-heading-img"><img src="{{ getImageFile(get_option('top_instructor_logo')) }}" alt="Our categories"></div>
                            <div>
                                <h3 class="section-heading">{{ get_option('top_instructor_title') }}</h3>
                                <p class="section-sub-heading">{{ get_option('top_instructor_subtitle') }}</p>
                            </div>
                        </div>

                        <a href="{{ route('allInstructor') }}" class="theme-btn theme-button2 theme-button3">{{ __('app.view_all_instructor') }} <i data-feather="arrow-right"></i></a>
                    </div>
                    <!-- section-left-align-->
                </div>
            </div>
            <div class="row top-instructor-content-wrap">
                @foreach($userInstructors as $userInstructor)
                <!-- Single Instructor Item start-->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="card instructor-item border-0">
                        <div class="instructor-img-wrap overflow-hidden"><a href="{{ route('instructorDetails', [$userInstructor->id, Str::slug($userInstructor->name)]) }}"><img src="{{ getImageFile($userInstructor->image_path) }}" alt="instructor"></a></div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('instructorDetails', [$userInstructor->id, Str::slug($userInstructor->name)]) }}">{{ $userInstructor->name }}</a></h5>
                            <p class="card-text instructor-designation font-medium text-uppercase">{{ @$userInstructor->instructor->professional_title }}</p>
                            <div class="instructor-bottom d-flex align-items-start justify-content-between">
                                <div class="instructor-bottom-item font-14 font-medium"><img src="{{ asset('frontend/assets/img/icons-svg/rating.svg') }}" alt="star">
                                    <?php
                                        $average_rating = \App\Models\Course::where('user_id', $userInstructor->id)->avg('average_rating');
                                    ?>
                                    {{ number_format(@$average_rating, 1) }}
                                </div>
                                <div class="instructor-bottom-item font-14">{{ @$userInstructor->students->count() }} {{ __('app.students') }}</div>
                                <div class="instructor-bottom-item font-14">{{ @$userInstructor->courses->count() }} {{ __('app.courses') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Instructor Item End-->
                @endforeach
            </div>
        </div>
    </section>
    <!-- Our Top Instructor Area End -->

    <!-- Video Area Start -->
    <section class="video-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7 col-xl-8">
                    <div class="video-area-left position-relative d-flex align-items-center justify-content-center">
                        <img src="{{ getImageFile(get_option('become_instructor_video_preview_image')) }}" alt="video" class="img-fluid">
                        <a class="play-btn position-absolute venobox" data-autoplay="true" data-maxwidth="800px" data-vbtype="video"
                           href="{{ getVideoFile(get_option('become_instructor_video')) }}">
                            <img src="{{ asset('frontend/assets/img/icons-svg/play.svg') }}" alt="play">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-4">
                    <div class="video-area-right position-relative">
                        <div class="section-title">
                            <h3 class="section-heading">{{ Str::limit(get_option('become_instructor_video_title'), 100) }}</h3>
                        </div>

                        <div class="video-floating-img-wrap pe-2 position-relative">
                            <p>{{ Str::limit(get_option('become_instructor_video_subtitle'), 450) }}</p>
                            <img src="{{ getImageFile(get_option('become_instructor_video_logo')) }}" alt="video" class="position-absolute">
                        </div>

                        <!-- section button start-->
                        <div class="col-12 section-btn">
                            <a href="{{ route('student.become-an-instructor') }}" class="theme-btn theme-button1">{{ __('app.become_an_instructor') }} <i data-feather="arrow-right"></i></a>
                        </div>
                        <!-- section button end-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video Area End -->

    <!-- Customers Says/ testimonial Area Start -->
    <section class="customers-says-area gradient-bg p-0">
        <div class="section-overlay section-t-space section-b-space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <div class="section-heading-img"><img src="{{ getImageFile(get_option('customer_say_logo')) }}" alt="Our categories"></div>
                            <h3 class="section-heading section-heading-light mx-auto">{{ get_option('customer_say_title') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row testimonial-content-wrap">

                    <!-- Single Testimonial Item start-->
                    <div class="col-md-4">
                        <div class="testimonial-item">
                            <div class="testimonial-top-content d-flex align-items-center">
                                <div class="flex-shrink-0 quote-img-wrap">
                                    <img src="{{ asset('frontend/assets/img/icons-svg/quote.svg') }}" alt="quote">
                                </div>
                                <div class="flex-grow-1 ms-3 testimonial-content">
                                    <h6 class="text-uppercase font-16">{{ get_option('customer_say_first_name') }}</h6>
                                    <p class="text-uppercase font-13 font-medium">{{ get_option('customer_say_first_position') }}</p>
                                </div>
                            </div>
                            <div class="testimonial-bottom-content">
                                <h6 class="text-white">{{ get_option('customer_say_first_comment_title') }}</h6>
                                <p class="font-17">{{ get_option('customer_say_first_comment_description') }}</p>
                                <ul class="rating-list d-flex align-items-center me-2">
                                    @if(get_option('customer_say_first_comment_rating_star') == 1)
                                    <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_first_comment_rating_star') > 1 && get_option('customer_say_first_comment_rating_star') < 2)
                                    <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_first_comment_rating_star') == 2)
                                    <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_first_comment_rating_star') > 2 && get_option('customer_say_first_comment_rating_star') < 3)
                                    <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_first_comment_rating_star') == 3)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_first_comment_rating_star') > 3 && get_option('customer_say_first_comment_rating_star') < 4)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>

                                    @elseif(get_option('customer_say_first_comment_rating_star') == 4)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_first_comment_rating_star') > 4 && get_option('customer_say_first_comment_rating_star') < 5)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                    @else
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Single Testimonial Item End-->

                    <!-- Single Testimonial Item start-->
                    <div class="col-md-4">
                        <div class="testimonial-item">
                            <div class="testimonial-top-content d-flex align-items-center">
                                <div class="flex-shrink-0 quote-img-wrap">
                                    <img src="{{ asset('frontend/assets/img/icons-svg/quote.svg') }}" alt="quote">
                                </div>
                                <div class="flex-grow-1 ms-3 testimonial-content">
                                    <h6 class="text-uppercase font-16">{{{ get_option('customer_say_second_name') }}}</h6>
                                    <p class="text-uppercase font-13 font-medium">{{{ get_option('customer_say_second_position') }}}</p>
                                </div>
                            </div>
                            <div class="testimonial-bottom-content">
                                <h6 class="text-white">{{ get_option('customer_say_second_comment_title') }}</h6>
                                <p class="font-17">{{ get_option('customer_say_second_comment_description') }}</p>
                                <ul class="rating-list d-flex align-items-center me-2">
                                    @if(get_option('customer_say_second_comment_rating_star') == 1)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_second_comment_rating_star') > 1 && get_option('customer_say_second_comment_rating_star') < 2)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_second_comment_rating_star') == 2)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_second_comment_rating_star') > 2 && get_option('customer_say_second_comment_rating_star') < 3)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_second_comment_rating_star') == 3)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_second_comment_rating_star') > 3 && get_option('customer_say_second_comment_rating_star') < 4)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>

                                    @elseif(get_option('customer_say_second_comment_rating_star') == 4)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_second_comment_rating_star') > 4 && get_option('customer_say_second_comment_rating_star') < 5)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                    @else
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Single Testimonial Item End-->

                    <!-- Single Testimonial Item start-->
                    <div class="col-md-4">
                        <div class="testimonial-item">
                            <div class="testimonial-top-content d-flex align-items-center">
                                <div class="flex-shrink-0 quote-img-wrap">
                                    <img src="{{ asset('frontend/assets/img/icons-svg/quote.svg') }}" alt="quote">
                                </div>
                                <div class="flex-grow-1 ms-3 testimonial-content">
                                    <h6 class="text-uppercase font-16">{{ get_option('customer_say_third_name') }}</h6>
                                    <p class="text-uppercase font-13 font-medium">{{ get_option('customer_say_third_position') }}</p>
                                </div>
                            </div>
                            <div class="testimonial-bottom-content">
                                <h6 class="text-white">{{ get_option('customer_say_third_comment_title') }}</h6>
                                <p class="font-17">{{ get_option('customer_say_third_comment_description') }}</p>
                                <ul class="rating-list d-flex align-items-center me-2">
                                    @if(get_option('customer_say_third_comment_rating_star') == 1)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_third_comment_rating_star') > 1 && get_option('customer_say_third_comment_rating_star') < 2)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_third_comment_rating_star') == 2)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_third_comment_rating_star') > 2 && get_option('customer_say_third_comment_rating_star') < 3)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_third_comment_rating_star') == 3)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_third_comment_rating_star') > 3 && get_option('customer_say_third_comment_rating_star') < 4)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>

                                    @elseif(get_option('customer_say_third_comment_rating_star') == 4)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @elseif(get_option('customer_say_third_comment_rating_star') > 4 && get_option('customer_say_third_comment_rating_star') < 5)
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-half"></span></li>
                                    @else
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                        <li class="star-full"><span class="iconify" data-icon="bi:star-fill"></span></li>
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Single Testimonial Item End-->

                </div>
            </div>
        </div>
    </section>
    <!-- Customers Says/ testimonial Area End -->

    <!-- Achievement Area Start -->
    <section class="achievement-area">
        <div class="container">
            <div class="row achievement-content-area">
                <!-- Achievement Item start-->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="achievement-item d-flex align-items-center">
                        <div class="flex-shrink-0 achievement-img-wrap">
                            <img src="{{ getImageFile(get_option('achievement_first_logo')) }}" alt="achievement">
                        </div>
                        <div class="flex-grow-1 ms-3 achievement-content">
                            <h6>{{ get_option('achievement_first_title') }}</h6>
                            <p>{{ get_option('achievement_first_subtitle') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Achievement Item End-->

                <!-- Achievement Item start-->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="achievement-item d-flex align-items-center">
                        <div class="flex-shrink-0 achievement-img-wrap">
                            <img src="{{ getImageFile(get_option('achievement_second_logo')) }}" alt="achievement">
                        </div>
                        <div class="flex-grow-1 ms-3 achievement-content">
                            <h6>{{ get_option('achievement_second_title') }}</h6>
                            <p>{{ get_option('achievement_second_subtitle') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Achievement Item End-->

                <!-- Achievement Item start-->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="achievement-item d-flex align-items-center">
                        <div class="flex-shrink-0 achievement-img-wrap">
                            <img src="{{ getImageFile(get_option('achievement_third_logo')) }}" alt="achievement">
                        </div>
                        <div class="flex-grow-1 ms-3 achievement-content">
                            <h6>{{ get_option('achievement_third_title') }}</h6>
                            <p>{{ get_option('achievement_third_subtitle') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Achievement Item End-->

                <!-- Achievement Item start-->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="achievement-item d-flex align-items-center">
                        <div class="flex-shrink-0 achievement-img-wrap">
                            <img src="{{ getImageFile(get_option('achievement_four_logo')) }}" alt="achievement">
                        </div>
                        <div class="flex-grow-1 ms-3 achievement-content">
                            <h6>{{ get_option('achievement_four_title') }}</h6>
                            <p>{{ get_option('achievement_four_subtitle') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Achievement Item End-->
            </div>
        </div>
    </section>
    <!-- Achievement Area End -->

    <!-- FAQ Area Start -->
    <section class="faq-area home-page-faq-area section-t-space">
        <div class="container">

            <!-- FAQ Shape Image Start-->
            <div class="faq-area-shape"></div>
            <!-- FAQ Shape Image End-->

            <div class="row align-items-center">
                <div class="col-md-6 col-lg-6 col-xl-5">

                    <div class="section-title">
                        <h3 class="section-heading">{{ get_option('faq_title') }}</h3>
                        <p class="section-sub-heading">{{ get_option('faq_subtitle') }}</p>
                    </div>

                    <div class="accordion" id="accordionExample">
                        @foreach($faqQuestions as $key => $faqQuestion)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_{{ $key }}">
                                    <button class="accordion-button font-medium font-18 {{ $key == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $key }}"
                                            aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapse_{{ $key }}">
                                        {{ $key+1 }}. {{ $faqQuestion->question }}
                                    </button>
                                </h2>
                                <div id="collapse_{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading_{{ $key }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ $faqQuestion->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-7">
                    <div class="faq-area-right position-relative">
                        <img src="{{ getImageFile(get_option('faq_image')) }}" alt="faq" class="img-fluid">
                        <div class="still-no-luck radius-3 bg-white position-absolute">
                            <h6>{{ get_option('faq_image_title') }}</h6>
                            <p>{{ __('app.then_feel_free_to') }} <a href="{{ route('contact') }}" class="text-decoration-underline color-heading">{{ __('app.contact_with_us') }}</a>,
                                {{ __('app.we_are_24/7_for_you') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ Area End -->

    <!-- Course Instructor and Support Area Start -->
    <section class="course-instructor-support-area bg-light section-t-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h3 class="section-heading">{{ @$aboutUsGeneral->instructor_support_title }}</h3>
                        <p class="section-sub-heading">{{ @$aboutUsGeneral->instructor_support_subtitle }}</p>
                    </div>
                </div>
            </div>
            <div class="row course-instructor-support-wrap">
            @foreach($instructorSupports as $instructorSupport)
                <!-- Instructor Support Item start-->
                    <div class="col-md-4">
                        <div class="instructor-support-item bg-white radius-3 text-center">
                            <div class="instructor-support-img-wrap">
                                <img src="{{ getImageFile($instructorSupport->image_path) }}" alt="support">
                            </div>
                            <h6>{{ $instructorSupport->title }}</h6>
                            <p>{{ $instructorSupport->subtitle }} </p>
                            <a href="{{ $instructorSupport->button_link ?? '#' }}" class="theme-btn theme-button1 theme-button3">{{ $instructorSupport->button_name }} <i data-feather="arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- Instructor Support Item End-->
                @endforeach
            </div>

            <!-- Client Logo Area start-->
            <div class="row client-logo-area">
                @foreach($clients as $client)
                    <div class="col">
                        <div class="client-logo-item text-center">
                            <img src="{{ getImageFile($client->image_path) }}" alt="{{ $client->name }}">
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Client Logo Area end-->
        </div>
    </section>
    <!-- Course Instructor and Support Area End -->
@endsection

@push('script')
    <!--Hero text effect-->
    <script src="{{ asset('frontend/assets/js/hero-text-effect.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/course/addToCart.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/course/addToWishlist.js') }}"></script>
@endpush
