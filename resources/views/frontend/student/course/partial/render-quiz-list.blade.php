<!-- Course Watch Quiz List Start-->
<div class="course-watch-quiz-list-table">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Quiz Name</th>
                <th scope="col">Quiz Types</th>
                <th scope="col">Total Question</th>
                <th scope="col">Time Duration</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->publishedExams as $quiz)
                <tr>
                    <td>{{$quiz->name}}</td>
                    <td>{{ucfirst(str_replace("_", " ", $quiz->type))}}</td>
                    <td>{{$quiz->questions->count()}}</td>
                    <td>{{$quiz->duration}} mins</td>
                    <td>
                        <div class="notice-board-action-btns">
                            @if(take_exam($quiz->id) == 'no')
                                <a href="{{route('student.my-course.show', [$course->slug, 'start-quiz', $quiz->uuid])}}" class="theme-btn theme-button1 default-hover-btn">Start Quiz</a>
                            @else
                                <a href="{{route('student.my-course.show', [$course->slug, 'quiz-result', $quiz->uuid])}}" class="theme-btn theme-button1 green-theme-btn default-hover-btn">See Result</a>
                            @endif
                            <a href="{{route('student.my-course.show', [$course->slug, 'leaderboard', $quiz->uuid])}}" class="theme-btn theme-button1 light-purple-theme-btn default-hover-btn">Leaderboard</a>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
<!-- Course Watch Quiz List End-->
