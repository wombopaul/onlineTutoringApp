
@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> Quiz </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14" aria-current="page"><a href="{{ route('instructor.course') }}">{{__('app.my_courses')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('exam.index', $course->uuid) }}">Quiz List</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">Create New Quiz</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-create-new-quiz-page bg-white">
            <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                <h6>{{__('app.create_new_quiz')}}</h6>
                <p>{{ @$course->title }}</p>
            </div>
            <div class="row">
                <div class="col-12">

                        <form method="POST" action="{{route('exam.store', [$course->uuid])}}" class="create-new-quiz-form needs-validation" novalidate>
                            @csrf

                        <div class="row">
                            <div class="col-md-12 mb-30">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.quiz_name')}}</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter your quiz name" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-30">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.quiz_types')}}</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="multiple_choice">Multiple Choice</option>
                                    <option value="true_false">True False</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('type') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-30">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.marks_per_question')}}</label>
                                <input type="number" min="1" name="marks_per_question" class="form-control" placeholder="Enter your marks per question" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-30">
                                <label class="label-text-title color-heading font-medium font-16 mb-3">{{__('app.time_duration')}} (Minutes)</label>
                                <input type="number" min="1" class="form-control" name="duration" placeholder="Enter your time duration" required>
                            </div>
                        </div>

                        <div>
                            <a href="{{route('instructor.course')}}" class="theme-btn theme-button3 quiz-back-btn">{{__('app.back')}}</a>
                            <button type="submit" class="theme-btn theme-button1">{{__('app.create')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('frontend/assets/js/custom/form-validation.js')}}"></script>
@endpush


