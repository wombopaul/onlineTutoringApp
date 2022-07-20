<div class="course-watch-assignment-details-wrap ">
    <div class="course-watch-assgnment-upload-block">
        <div class="watch-course-tab-inside-top-heading d-flex justify-content-between align-items-center">
            <h6>Assignment Upload</h6>
        </div>
        <form id="assignment_file_form" action="post">
            <div class="create-assignment-upload-files">
                <div>
                    <input type="file" name="file" id="assignmentSubmitFile" class="form-control" title="Upload Your Files" />
                </div>
                <p class="font-14 color-heading text-center mt-2 color-gray">Accepted file selected (PDF, ZIP) <span class="d-block">Maximum Image Upload Size is <span
                            class="color-heading">10mb</span></span></p>
            </div>

            <div class="col-12 mt-20">
                <span class="theme-btn default-back-btn default-hover-btn viewAssignmentDetails"
                        data-route="{{ route('student.assignment-details') }}" data-assignment_id="{{ $assignment->id }}">
                    Back</span>
                <button type="button" class="theme-btn theme-button1 default-hover-btn assignmentSubmitStore" data-route="{{ route('student.assignment-submit.store', [$course_id, $assignment->id]) }}">Submit</button>
            </div>
        </form>
    </div>
</div>
