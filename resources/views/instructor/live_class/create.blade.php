@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.my_courses')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('live-class.course-live-class.index') }}">Live Class Course List</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">Create Live</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-quiz-list-page instructor-create-live-class-page">
            <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                <h6>Create Live Class</h6>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('live-class.store', $course->uuid) }}" method="post">
                        @csrf
                        <div class="row mb-30">
                            <div class="col-md-12">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">Live Class Topic</label>
                                <input type="text" name="class_topic" class="form-control topic" placeholder="Enter your topic" required value="{{ old('class_topic') }}">
                                @if ($errors->has('class_topic'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('class_topic') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col-md-12">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">Live Class Date</label>
                                <input type="date" name="date" class="form-control date" placeholder="Selected Date" required>
                                @if ($errors->has('date'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col-md-12">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">Time Duration (Write minutes)</label>
                                <input type="number" name="duration" class="form-control duration" placeholder="Type duration in minutes" required>
                                @if ($errors->has('duration'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('duration') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col-md-12">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">Starting Time</label>
                                <input type="time" name="time" class="form-control start_time" placeholder="Selected Date required" value="{{ old('time') }}" required>
                                @if ($errors->has('time'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('time') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">Live Class Link</label>
                                <div class="row align-items-center">
                                    <div class="col-md-9">
                                        <input type="text" name="join_url" class="form-control join_url" placeholder="Generate your live class link" value="{{ old('join_url') }}">
                                        @if ($errors->has('join_url'))
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('join_url') }}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <button type="button" class="theme-btn theme-button1 default-hover-btn green-theme-btn createLiveLink">Create Live Link</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('live-class.index', $course->uuid) }}" class="theme-btn theme-button3 quiz-back-btn default-hover-btn">Back</a>
                            <button type="submit" class="theme-btn theme-button1 default-hover-btn">Create Meeting</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <input type="hidden" class="getZoomLinkRoute" value="{{ route('live-class.get-zoom-link') }}">
@endsection

@push('script')
    <script src="{{ asset('frontend/assets/js/instructor/create-live-class-zoom-link.js') }}"></script>
@endpush


