@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> Assignment </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('instructor.course') }}">{{__('app.my_courses')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">Assignment List</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-quiz-list-page instructor-add-assignment-page">
            <div class="row m-0 quiz-list-page-top mb-4">
                <div class="col-md-8">
                    <div class="quiz-list-page-top-left">
                        <h5 class="text-white mb-2"> Course Name: {{ $course->title }}</h5>
                        <p class="text-white mb-4">
                           Assignment List
                        </p>
                        <a href="{{ route('assignment.create', [$course->uuid]) }}" class="create-new-quiz-btn font-medium">Create New Assignment</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="quiz-list-page-top-right">
                        <img src="{{ asset('frontend/assets/img/quiz-img/add-assignment-top.png') }}" alt="img" class="img-fluid">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    @if(count($assignments) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Assignment Topic</th>
                                <th scope="col">Marks</th>
                                <th scope="col">Assessment</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assignments as $assignment)
                                <tr>
                                    <td>{{ $assignment->name }}</td>
                                    <td>{{ $assignment->marks }}</td>
                                    <td><a href="{{ route('assignment.assessment.index', [$course->uuid, $assignment->uuid]) }}" class="theme-btn theme-button1 default-hover-btn">Click Here</a></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="iconify" data-icon="charm:menu-meatball"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="{{ route('assignment.edit', [$course->uuid, $assignment->uuid]) }}">
                                                        <span class="iconify" data-icon="clarity:note-edit-line"></span>Edit</a></li>
                                                <li><a class="dropdown-item" href="{{ route('assignment.delete',$assignment->uuid) }}">
                                                        <span class="iconify" data-icon="gg:trash"></span>Delete</a></li>
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
                        <h5 class="my-3">Empty Assignment</h5>
                    </div>
                    <!-- If there is no data Show Empty Design End -->
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

