@extends('frontend.layouts.app')

@section('content')
<div class="bg-page">
<!-- Page Header Start -->
<header class="page-banner-header blank-page-banner-header gradient-bg position-relative">
    <div class="section-overlay">
        <div class="blank-page-banner-wrap pb-0 min-h-auto">
        </div>
    </div>
</header>
<!-- Page Header End -->

<!-- Cart Page Area Start -->
<section class="thankyou-page-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-7">
                <div class="thankyou-box text-center bg-white px-5 py-5">
                    <img src="{{ asset('frontend/assets/img/thank-you-img.png') }}" alt="img" class="img-fluid">
                    <h5 class="mt-5">Thank you for Purchasing Course</h5>
                </div>
            </div>
            <div class="col-md-12 col-lg-7">
                <div class="thankyou-course-list-area mt-30">
                    <div class="table-responsive">
                        <table class="table bg-white my-courses-page-table">
                            <thead>
                            <tr>
                                <th scope="col" class="color-gray font-15 font-medium">Course</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($new_courses as $course)
                                <tr>
                                    <td class="wishlist-course-item">
                                        <div class="card course-item wishlist-item border-0 d-flex align-items-center">
                                            <div class="course-img-wrap flex-shrink-0 overflow-hidden">
                                                <a href="{{ route('student.my-course.show', Str::Slug($course->title)) }}"><img src="{{ getImageFile($course->image_path) }}" alt="course" class="img-fluid"></a>
                                            </div>
                                            <div class="card-body flex-grow-1">
                                                <h5 class="card-title course-title"><a href="http://localhost:8000/student/my-course/javascript-understanding-the-weird-parts">{{ $course->title }}</a></h5>
                                                <p class="card-text instructor-name-certificate font-medium text-uppercase">{{ @$course->instructor->fullname }}
                                                    @if(get_instructor_ranking_level(@$course->instructor->user_id))
                                                        | {{ get_instructor_ranking_level(@$course->instructor->user_id) }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <a href="{{ route('student.my-learning') }}" class="theme-btn theme-button1 theme-button3 w-100 mt-15">{{ __('app.my_learning') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Cart Page Area End -->
</div>
@endsection
