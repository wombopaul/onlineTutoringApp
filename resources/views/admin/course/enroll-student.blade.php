@extends('layouts.admin')

@section('content')
    <!-- Page content area start -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb__content">
                        <div class="breadcrumb__content__left">
                            <div class="breadcrumb__title">
                                <h2>Add Student in Course</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Student in Course</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="customers__area bg-style mb-30">
                        <div class="item-title d-flex justify-content-between">
                            <h2>Enroll in Course</h2>
                        </div>
                        <form action="{{route('admin.course.enroll.store')}}" method="post" class="form-horizontal" >
                            @csrf

                            <div class="input__group mb-25">
                                <label>Student <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="">
                                    <option value="">--Select Student--</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>{{ @$user->student->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('student_id'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('student_id') }}</span>
                                @endif
                            </div>
                            <div class="input__group mb-25">
                                <label>Course <span class="text-danger">*</span></label>
                                <select name="course_id" id="course_id">
                                    <option value="">--Select Course--</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" @if(old('course_id') == $course->id) selected @endif>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('course_id'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('course_id') }}</span>
                                @endif
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Page content area end -->
@endsection


@push('script')
    <script src="{{ asset('admin/js/standalone/selectize.min.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('admin/css/selectize.bootstrap3.min.css') }}" />
    <script>
        $(document).ready(function () {
            $('select').selectize({
                sortField: 'text'
            });
        })
    </script>
@endpush
