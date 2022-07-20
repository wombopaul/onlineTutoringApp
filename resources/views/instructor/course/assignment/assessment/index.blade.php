@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('app.my_courses')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('main.index')}}">{{__('app.home')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('app.my_courses')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-assignment-assessment-page bg-white">
            <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                <h6>Assignment Assessment</h6>
                <h6 class="font-16"><span class="font-medium">Total:</span> {{ count($assignmentSubmitsPending) + count($assignmentSubmitsDone) }} Persons</h6>
            </div>

            <ul class="nav nav-tabs assignment-nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ @$navPendingActive }}" id="assignment-pending-tab" data-bs-toggle="tab" data-bs-target="#assignment-pending" type="button" role="tab"
                            aria-controls="assignment-pending" aria-selected="true">Pending
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ @$navDoneActive }}" id="assignment-done-tab" data-bs-toggle="tab" data-bs-target="#assignment-done" type="button" role="tab"
                            aria-controls="assignment-done" aria-selected="false">Done
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ @$tabPendingActive }}" id="assignment-pending" role="tabpanel" aria-labelledby="assignment-pending-tab">
                    <div class="appendPendingList">
                        @include('instructor.course.assignment.assessment.render-pending-list')
                    </div>
                </div>
                <div class="tab-pane fade {{ @$tabDoneActive }}" id="assignment-done" role="tabpanel" aria-labelledby="assignment-done-tab">
                    <div class="appendDoneList">
                        @include('instructor.course.assignment.assessment.render-done-list')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
    <!--Assignment Marks Edit Modal Start-->
    <div class="modal fade" id="assignmentEditModal" tabindex="-1" aria-labelledby="assignmentEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="assignmentEditModalLabel">Edit Assignment</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateEditModal" action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <h6 class="card-title mb-2"><span class="user_name"></span></h6>
                        <p class="mb-20">Email : <span class="user_email"></span></p>

                        <div class="assignment-edit-modal-box">
                            <div class="row mb-30">
                                <div class="col-md-12">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">Marks</label>
                                    <input type="number" step="any" min="0" name="marks" class="form-control" placeholder="Type Marks" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="label-text-title color-heading font-medium font-16 mb-3">Notes</label>
                                    <textarea name="notes" class="form-control" cols="30" rows="10" placeholder="Type notes"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <button type="submit" class="theme-btn theme-button1 default-hover-btn">Save Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Assignment Marks Edit Modal End-->

    <input type="hidden" class="downloadAssignmentRoute" value="{{ route('assignment.assessment.download') }}">
@endsection


@push('script')
    <script src="{{ asset('frontend/assets/js/instructor/download-and-update-assignment.js') }}"></script>
@endpush
