@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> Quiz </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14" aria-current="page"><a href="{{ route('instructor.course') }}">{{__('app.my_courses')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">Quiz List</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-quiz-list-page">
            <div class="row m-0 quiz-list-page-top mb-4">
                <div class="col-md-7">
                    <div class="quiz-list-page-top-left">
                        <h5 class="text-white mb-2"> Course Name: {{ $course->title }}</h5>
                        <p class="text-white mb-4">Quiz List</p>
                        <a href="{{route('exam.create', [$course->uuid])}}" class="create-new-quiz-btn font-medium">{{__('app.create_new_quiz')}}</a>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="quiz-list-page-top-right">
                        <img src="{{ asset('frontend/assets/img/quiz-img/quiz-text-img.png') }}" alt="img" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @if($exams->count() > 0)
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Quiz Name</th>
                                <th scope="col">Quiz Types</th>
                                <th scope="col">Total Question</th>
                                <th scope="col">Status</th>
                                <th scope="col">Add Question</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>{{$exam->name}}</td>
                                    <td>{{ucfirst(str_replace("_", " ", $exam->type))}}</td>
                                    <td>{{$exam->questions->count()}}</td>

                                <td> @if($exam->status == 1) <div class="quiz-status">Publish</div> @else  <div class="quiz-status unpublish">Unpublish</div> @endif </td>
                                <td><a href="{{route('exam.question', [$exam->uuid])}}" class="add-question-btn theme-btn theme-button1 default-hover-btn">Add Question</a></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="iconify" data-icon="charm:menu-meatball"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                                            @if($exam->status == 1)
                                                <li><a class="dropdown-item" href="{{route('exam.status-change', [$exam->uuid, 0])}}"><span class="iconify" data-icon="ic:outline-publish"></span>Unpublish</a></li>
                                            @else
                                                <li><a class="dropdown-item" href="{{route('exam.status-change', [$exam->uuid, 1])}}"><span class="iconify" data-icon="ic:outline-publish"></span>Publish</a></li>
                                            @endif
                                            <li><a class="dropdown-item" href="{{route('exam.view', [$exam->uuid])}}"><span class="iconify" data-icon="carbon:view"></span>View</a></li>
                                            <li><a class="dropdown-item" href="{{route('exam.edit', [$exam->uuid])}}"><span class="iconify" data-icon="clarity:note-edit-line"></span>Edit</a></li>
                                            <li><a href="{{route('exam.delete', [$exam->uuid])}}"  class="dropdown-item"  ><span class="iconify" data-icon="gg:trash"></span>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else
                    <!-- If there is no data Show Empty Design Start -->
                    <div class="empty-data">
                        <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
                        <h5 class="my-3">Empty Quiz</h5>
                    </div>
                    <!-- If there is no data Show Empty Design End -->

                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
