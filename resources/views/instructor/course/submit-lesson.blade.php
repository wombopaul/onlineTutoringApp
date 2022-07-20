@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.upload_course')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('instructor.course') }}">{{__('app.my_courses')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.upload_course')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part instructor-upload-course-box-part">
        <div class="instructor-upload-course-box">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar" class="upload-course-item-block d-flex align-items-center justify-content-center">
                                <li class="active" id="account"><strong>Course Overview</strong></li>
                                <li class="active"  id="personal"><strong>Upload Video</strong></li>
                                <li  class="active"id="confirm"><strong>Submit process</strong></li>
                            </ul>

                            <!-- Upload Course Step-1 Item Start -->
                            <div class="upload-course-step-item upload-course-overview-step-item">
                                <!-- Upload Course Step-3 Item Start -->
                                <div class="upload-course-step-item">
                                    <div class="upload-course-item-block course-overview-step1 radius-8 mb-0 pb-0">
                                        <div class="form-last-step">
                                            <div class="last-step-content-wrap">
                                                <h4 class="mb-3">Finish!</h4>
                                                <div class="stepper-action-btns">
                                                    <a href="{{route('instructor.course')}}" class="theme-btn theme-button3">{{__('app.cancel')}}</a>
                                                    @if($course->status == 1)
                                                    <a href="{{route('course.upload-finished', [$course->uuid])}}" type="button" class="theme-btn theme-button1">Done</a>
                                                    @else
                                                    <a href="{{route('course.upload-finished', [$course->uuid])}}" type="button" class="theme-btn theme-button1">Submit for review</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Upload Course Step-3 Item End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
