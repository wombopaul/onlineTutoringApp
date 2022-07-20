@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.notice_list')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('app.dashboard')}}</a></li>
                <li class="breadcrumb-item font-14"><a href="{{ route('notice-board.course-notice.index') }}">Notice Board Course List</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.notice_list')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-quiz-list-page instructor-notice-list-page">

            <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                <h6>{{ @$course->title }}</h6>
            </div>

            <div class="row">
                <div class="col-12">
                    @if(count($notices) > 0)
                        <div class="table-responsive table-responsive-xl">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('app.notice_date')}}</th>
                                    <th scope="col">{{__('app.notice_topic')}}</th>
                                    <th scope="col">{{__('app.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notices as $notice)
                                    <tr>
                                        <td>{{ $notice->created_at->format('d/m/Y') }}</td>
                                        <td>{{ Str::limit($notice->topic, 45) }}</td>
                                        <td>
                                            <div class="red-blue-action-btns">
                                                <a href="{{ route('notice-board.view', [$course->uuid, $notice->uuid]) }}"
                                                   class="theme-btn theme-button1 green-theme-btn default-hover-btn">
                                                    <span class="iconify" data-icon="akar-icons:eye"></span>{{__('app.view')}}</a>
                                                <a href="{{ route('notice-board.edit', [$course->uuid, $notice->uuid]) }}" class="theme-btn default-edit-btn-blue">
                                                    <span class="iconify" data-icon="bxs:edit"></span>{{__('app.edit')}}</a>
                                                <a href="javascript:void(0);" data-url="{{ route('notice-board.delete', [$notice->uuid]) }}"
                                                   class="theme-btn default-delete-btn-red delete">
                                                    <span class="iconify" data-icon="gg:trash"></span>{{__('app.delete')}}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Start -->
                        @if(@$notices->hasPages())
                            {{ @$notices->links('frontend.paginate.paginate') }}
                        @endif
                        <!-- Pagination End -->
                    @else
                        <!-- If there is no data Show Empty Design Start -->
                        <div class="empty-data">
                            <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
                            <h5 class="my-3">{{__('app.empty_notice')}}</h5>
                        </div>
                        <!-- If there is no data Show Empty Design End -->
                    @endif
                    <!-- Add Notice Button Start -->
                    <a href="{{ route('notice-board.course-notice.index') }}" class="theme-btn theme-button3 quiz-back-btn default-hover-btn">{{__('app.back')}}</a>
                    <a href="{{ route('notice-board.create', $course->uuid) }}" class="add-resources-btn theme-btn theme-button1 default-hover-btn">{{__('app.add_notice')}}</a>
                    <!-- Add Notice Button End -->

                </div>
            </div>

        </div>
    </div>
@endsection
