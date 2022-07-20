<div class="course-watch-assignment-result-wrap">
    <div class="watch-course-tab-inside-top-heading d-flex justify-content-between align-items-center">
        <h6>Assignment Result</h6>
    </div>

    <div class="course-watch-quiz-list-table course-watch-assignment-result-table">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Assignment Topic</th>
                    <th scope="col">Marks</th>
                    <th scope="col">Your Marks</th>
                    <th scope="col">Notes</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ Str::limit($assignment->name, 40) }}</td>
                    <td>{{ $assignment->marks }}</td>
                    <td>{{ @$assignmentSubmit->marks }}</td>
                    <td>
                        <div class="course-watch-assignment-result-notes">
                            {{ @$assignmentSubmit->notes }}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="watch-course-tab-inside-top-heading d-flex justify-content-between align-items-center">
        <div><button class="theme-btn default-back-btn default-hover-btn m-0 viewAssignmentList">Back</button></div>
    </div>

</div>
