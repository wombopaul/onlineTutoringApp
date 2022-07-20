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
                                <h2>Course Lessons</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('app.dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('app.approved_instructors')}}</li>
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
                            <h2>Course Lessons and Lectures</h2>
                        </div>

                        <!-- View Curriculum Start -->
                        <div class="admin-course-watch-page-area">
                            <div class="curriculum-content">
                                <div class="accordion" id="accordionExample">
                                    @forelse(@$course->lessons as $key => $lesson)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $key }}">
                                                <button class="accordion-button font-medium font-18 {{ $key == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapseOne">
                                                    {{ $lesson->name }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="play-list">

                                                        <!-- Note End-->
                                                        <!-- If User Logged In then add Class Name in play-list-item = "venobox"-->
                                                        <!-- If Preview has for this course add Class Name in play-list-item = "preview-enabled"-->
                                                        <!-- Note Start-->

                                                        @forelse($lesson->lectures as  $lecture)
                                                            <!-- Play List Item Start-->
                                                            <a class="play-list-item d-flex align-items-center justify-content-between venobox preview-enabled" data-autoplay="true" data-maxwidth="800px" data-vbtype="video" data-href="
                                                            @if($lecture->type == 'video')
                                                                {{getVideoFile($lecture->file_path)}}
                                                            @elseif($lecture->type == 'youtube')
                                                                https://www.youtube.com/embed/{{ $lecture->url_path }}
                                                            @elseif($lecture->type == 'vimeo')
                                                                https://vimeo.com/{{ $lecture->url_path }}
                                                            @endif
                                                            ">
                                                                <div class="play-list-left d-flex align-items-center">
                                                                    <div><img src="{{ asset('frontend/assets/img/courses-img/play.svg') }}" alt="play"></div>
                                                                    <p>{{ $lecture->title }}</p>
                                                                </div>
                                                                <div class="play-list-right d-flex">
                                                                    <span class="show-preview">Preview</span>
                                                                    <span class="video-time-count">{{ $lecture->file_duration }}</span>
                                                                </div>
                                                            </a>
                                                            <!-- Play List Item End-->
                                                        @empty
                                                            <div class="row">
                                                                <p>No Data Found!</p>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="row">
                                            <p>No Data Found!</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!-- View Curriculam Start -->

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Page content area end -->
@endsection

@push('style')
<link rel="stylesheet" href="{{asset('frontend/assets/fonts/feather/feather.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/venobox.min.css')}}">
@endpush

@push('script')
<!--Feather Icon-->
<script src="{{asset('frontend/assets/js/feather.min.js')}}"></script>
<!--Venobox-->
<script src="{{asset('frontend/assets/js/venobox.min.js')}}"></script>
@endpush
