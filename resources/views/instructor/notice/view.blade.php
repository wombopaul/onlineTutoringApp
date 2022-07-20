@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.view_notice')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('notice-board.course-notice.index') }}">Notice Board Course List</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('notice-board.index', $course->uuid) }}">{{__('app.notice_list')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.view_notice')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
  <div class="instructor-profile-right-part">
      <div class="instructor-quiz-list-page instructor-notice-details-page">

        <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
          <h6>{{ $course->title }}</h6>
      </div>

        <div class="row">
          <div class="col-12">
              <div class="row mb-30">
                <div class="col-md-12">
                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.notice_topic')}}</label>
                    <p>{{ $notice->topic }}</p>
                </div>
              </div>
              <div class="row mb-30">
                <div class="col-md-12">
                    <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.notice_details')}}</label>
                    <p>{{ $notice->details }}</p>
                </div>
              </div>

              <div>
                <a href="{{ route('notice-board.index', $course->uuid) }}" class="theme-btn theme-button3 quiz-back-btn default-hover-btn">Back</a>
                <a href="{{ route('notice-board.edit', [$course->uuid, $notice->uuid]) }}" class="theme-btn theme-button1 default-hover-btn">Edit</a>
              </div>
          </div>
        </div>

      </div>
  </div>
@endsection
