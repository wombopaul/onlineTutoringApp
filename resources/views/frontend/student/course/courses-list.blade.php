@extends('frontend.layouts.app')

@section('content')

<div class="bg-page">

<!-- Page Header Start -->
<header class="page-banner-header blank-page-banner-header gradient-bg position-relative">
    <div class="section-overlay">
        <div class="blank-page-banner-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="page-banner-content text-center">
                            <h3 class="page-banner-heading color-heading pb-15">{{__('app.my_courses')}}</h3>

                            <!-- Breadcrumb Start-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item font-14"><a href="{{url('/')}}">{{__('app.home')}}</a></li>
                                    <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.my_courses')}}</li>
                                </ol>
                            </nav>
                            <!-- Breadcrumb End-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Page Header End -->

<!-- Wishlist Page Area Start -->
<section class="wishlist-page-area my-courses-page">
    <div class="container">
        <div class="row">
            <!-- Courses Filter Bar Start-->
            <div class="col-12">
                <div class="courses-filter-bar d-flex align-items-start justify-content-between">
                    <div class="filter-bar-left">
                        <a href="{{ route('courses') }}" class="theme-btn theme-button1 theme-button3">{{__('app.browse_more_course')}}</a>
                    </div>

                    <div class="filter-bar-right">
                        <div class="filter-box d-flex align-items-center justify-content-end bg-white">
                            <div class="filter-box-short-icon d-flex justify-content-start align-items-center"><img src="{{ asset('frontend/assets/img/icons-svg/filter-list-icon.png') }}" alt="short"> <p>Sort by:</p></div>
                            <select class="form-select form-select-sm filterBy" >
                                <option value="">{{__('app.select')}}</option>
                                <option value="1">{{__('app.newest')}}</option>
                                <option value="2">{{__('app.oldest')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Courses Filter Bar End-->

            <div class="appendCourseList">
            @include('frontend.student.course.render-courses-list')
            </div>
        </div>
    </div>
</section>
<!-- Wishlist Page Area End -->

    <!--Write Review Modal Start-->
    <div class="modal fade" id="writeReviewModal" tabindex="-1" aria-labelledby="writeReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="writeReviewModalLabel">Write a Review</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-4">
                            <div class="col-md-12 text-center">
                                <div class="btn-group give-rating-group" role="group" aria-label="Basic checkbox toggle button group">
                                    <input type="checkbox" class="btn-check" id="btncheck1" name="rating">
                                    <label class="give-rating-star" for="btncheck1"><span class="iconify" data-icon="bi:star-fill"></span></label>

                                    <input type="checkbox" class="btn-check" id="btncheck2" name="rating">
                                    <label class="give-rating-star" for="btncheck2"><span class="iconify" data-icon="bi:star-fill"></span></label>

                                    <input type="checkbox" class="btn-check" id="btncheck3" name="rating">
                                    <label class="give-rating-star" for="btncheck3"><span class="iconify" data-icon="bi:star-fill"></span></label>

                                    <input type="checkbox" class="btn-check" id="btncheck4" name="rating">
                                    <label class="give-rating-star" for="btncheck4"><span class="iconify" data-icon="bi:star-fill"></span></label>

                                    <input type="checkbox" class="btn-check" id="btncheck5" name="rating">
                                    <label class="give-rating-star" for="btncheck5"><span class="iconify" data-icon="bi:star-fill"></span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-30">
                            <div class="col-md-12">
                                <label class="font-medium font-15 color-heading">Feedback</label>
                                <textarea class="form-control feedback" id="exampleFormControlTextarea1" rows="3" placeholder="Please write your feedback here"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <button type="button" class="theme-btn theme-button3" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="theme-btn theme-button1 submitReview">Submit review</button>
                </div>
            </div>
        </div>
    </div>
    <!--Write Review Modal End-->

</div>
<input type="hidden" class="course_id">
<input type="hidden" class="studentReviewCreateRoute" value="{{ route('student.review.create') }}">
<input type="hidden" class="courseMyLearningRoute" value="{{ route('student.my-learning') }}">
@endsection

@push('script')
    <script src="{{ asset('frontend/assets/js/course/student-my-learning-filter.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/course/course-review-create.js') }}"></script>
@endpush
