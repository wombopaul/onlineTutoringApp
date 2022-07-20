<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Assignment;
use App\Models\AssignmentSubmit;
use App\Models\Certificate;
use App\Models\Certificate_by_instructor;
use App\Models\Course;
use App\Models\Course_lecture;
use App\Models\Course_lecture_views;
use App\Models\Course_lesson;
use App\Models\Discussion;
use App\Models\Exam;
use App\Models\LiveClass;
use App\Models\NoticeBoard;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Question;
use App\Models\Question_option;
use App\Models\Review;
use App\Models\Student_certificate;
use App\Models\Take_exam;
use App\Traits\ImageSaveTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use PDF;

class MyCourseController extends Controller
{
    use ImageSaveTrait;
    public function myLearningCourseList(Request $request)
    {
        $data['pageTitle'] = 'My Learning Courses';

        $orderIds = Order::whereUserId(auth()->id())->where('payment_status','paid')->orWhere('payment_status','free')->pluck('id')->toArray();
        $data['orderItems'] = Order_item::whereIn('order_id', $orderIds);

        if ($request->ajax())
        {
            $sortByID = $request->sortByID; // 1=newest, 2=Oldest
            if ($sortByID){
                $data['orderItems'] = Order_item::whereIn('order_id', $orderIds);
                if ($sortByID == 1){
                    $data['orderItems'] = $data['orderItems']->latest()->paginate();
                }

                if ($sortByID == 2){
                    $data['orderItems'] = $data['orderItems']->paginate();
                }
            }

            return view('frontend.student.course.render-courses-list', $data);
        }

        $data['orderItems'] = $data['orderItems']->latest()->paginate();

        return view('frontend.student.course.courses-list', $data);
    }

    public function downloadInvoice($item_id)
    {
        $item = Order_item::find($item_id);

        $invoice_name = 'invoice' . '.pdf';
        // make sure email invoice is checked.
        $customPaper = array(0, 0, 612, 792);
        $pdf = PDF::loadView('frontend.student.course.invoice', ['item' => $item])->setPaper($customPaper, 'portrait');
        $pdf->save(public_path() . '/uploads/receipt/' . $invoice_name);
        // return $pdf->stream($invoice_name);
        return $pdf->download($invoice_name);
    }

    public function myCourseShow(Request $request, $slug, $action_type = null, $quiz_uuid = null, $answer_id = null)
    {
        $data['pageTitle'] = "Course Details";
        $data['course'] = Course::whereSlug($slug)->firstOrfail();
        $data['total_enrolled_students'] = Order_item::where('course_id', $data['course']->id)->whereHas('order', function ($q) {
            $q->where('payment_status', 'paid');
        })->count();
        $data['enrolled_students'] = Order_item::where('course_id', $data['course']->id)->whereHas('order', function ($q) {
            $q->where('payment_status', 'paid');
        })->take(4)->get();

        //Start:: Assignment
        $data['assignments'] = Assignment::where('course_id', $data['course']->id)->get();
        //End:: Assignment
        //Start:: Notice
        $data['notices'] = NoticeBoard::whereCourseId($data['course']->id)->latest()->get();
        //End:: Notice

        //Start:: Live Class
        $now = now();

        $data['upcoming_live_classes'] = LiveClass::whereCourseId($data['course']->id)
            ->whereDate('date', '>=', $now->toDateString())
            ->whereTime('time', '>', $now->toTimeString())
            ->latest()->get();

        $data['past_live_classes'] = LiveClass::whereCourseId($data['course']->id)
            ->whereDate('date', '<=', $now->toDateString())
            ->whereTime('time', '<', $now->toTimeString())
            ->latest()->get();
        //End:: Live Class

        //Start:: Review
        $data['reviews'] = Review::whereCourseId($data['course']->id)->latest()->paginate(3);
        $data['loadMoreShowButtonReviews'] = Review::whereCourseId($data['course']->id)->paginate(4);
        $data['five_star_count'] = Review::whereCourseId($data['course']->id)->whereRating(5)->count();
        $data['four_star_count'] = Review::whereCourseId($data['course']->id)->whereRating(4)->count();
        $data['three_star_count'] = Review::whereCourseId($data['course']->id)->whereRating(3)->count();
        $data['two_star_count'] = Review::whereCourseId($data['course']->id)->whereRating(2)->count();
        $data['first_star_count'] = Review::whereCourseId($data['course']->id)->whereRating(1)->count();

        $data['total_reviews'] = (5*$data['five_star_count']) + (4*$data['four_star_count']) + (3*$data['three_star_count']) +
            (2*$data['two_star_count']) + (1*$data['first_star_count']);
        $data['total_user_review'] = $data['five_star_count'] + $data['four_star_count'] + $data['three_star_count'] + $data['two_star_count'] + $data['first_star_count'];
        if ($data['total_user_review'] > 0){
            $data['average_rating'] = $data['total_reviews']  / $data['total_user_review'];
        } else {
            $data['average_rating'] = 0;
        }

        $total_reviews = Review::whereCourseId($data['course']->id)->count();

        if ($total_reviews > 0 ) {
            $data['five_star_percentage'] =  ($data['five_star_count'] / $total_reviews) * 100;

            $data['four_star_percentage'] =  100 * ($data['four_star_count'] / $total_reviews);
            $data['three_star_percentage'] = 100 * ($data['three_star_count'] / $total_reviews);
            $data['two_star_percentage'] = 100 * ($data['two_star_count'] / $total_reviews);
            $data['first_star_percentage'] = 100 * ($data['first_star_count'] / $total_reviews);
        } else {
            $data['five_star_percentage'] =  0;
            $data['four_star_percentage'] =  0;
            $data['three_star_percentage'] = 0;
            $data['two_star_percentage'] = 0;
            $data['first_star_percentage'] = 0;
        }

        //End:: Review
        $data['discussions'] = Discussion::whereCourseId($data['course']->id)->whereNull('parent_id')->active()->get();

        if (!is_null($action_type) && !is_null($quiz_uuid))
        {
            $data['exam'] = Exam::whereUuid($quiz_uuid)->first();

            if ($action_type == 'start-quiz')
            {

                if (Take_exam::whereUserId(auth()->user()->id)->whereExamId($data['exam']->id)->count() == 0)
                {
                    $take_exam = new Take_exam();
                    $take_exam->exam_id = $data['exam']->id;
                    $take_exam->save();
                }

                $data['take_exam'] = Take_exam::whereUserId(auth()->user()->id)->whereExamId($data['exam']->id)->orderBy('id', 'DESC')->first();

                $question_ids = Answer::whereUserId(auth()->user()->id)->whereExamId($data['exam']->id)->pluck('question_id')->toArray();
                $data['question'] = Question::whereExamId($data['exam']->id)->whereNotIn('id', $question_ids)->first();
                $data['number_of_answer'] = Answer::whereUserId(auth()->user()->id)->whereExamId($data['exam']->id)->count();


                $now = Carbon::now();
                $expend_second =   $now->diffInSeconds($data['take_exam']->created_at);

                if (Carbon::parse($data['exam']->duration * 60)->subSecond($expend_second)->format('H:i:s') > Carbon::parse($data['exam']->duration * 60)->format('H:i:s'))
                {
                    return redirect(route('student.my-course.show', [$data['course']->slug, 'quiz-result', $data['exam']->uuid]));
                }

            }


            if ($action_type == 'leaderboard')
            {
                $data['top5_take_exams'] = Take_exam::whereExamId($data['exam']->id)->orderBy('number_of_correct_answer', 'DESC')->take(5)->get();
                $data['take_exams'] = Take_exam::whereExamId($data['exam']->id)->orderBy('number_of_correct_answer', 'DESC')->skip(5)->take(500)->get();
            }


        }

        if (!is_null($answer_id))
        {
            $data['answer'] = Answer::find($answer_id);
        }

        $data['action_type'] = $action_type;
        $data['quiz_uuid'] = $quiz_uuid;
        $data['answer_id'] = $answer_id;

        /** ------- save certificate ----------- */

        if ($request->get('lecture_uuid'))
        {
            $lecture = Course_lecture::where('uuid', $request->get('lecture_uuid'))->firstOrFail();
            $nextLectureId = Course_lecture::where('lesson_id', $lecture->lesson_id)->where('id', '>', $lecture->id)->min('id');

            if ($nextLectureId)
            {
                $nextLecture = Course_lecture::find($nextLectureId);
                $data['nextLectureUuid'] = $nextLecture->uuid;
            } else {
                $data['nextLectureUuid'] = null;
            }

            if ($lecture->type == 'video') {
                $data['video_src'] = $lecture->file_path;
            } elseif($lecture->type == 'youtube') {
                $data['youtube_video_src'] = $lecture->url_path;
            } elseif ($lecture->type == 'vimeo') {
                $data['vimeo_video_src'] = $lecture->url_path;
            }
            $data['lecture_type'] = $lecture->type;
            $data['lesson_id_check'] = @$lecture->lesson->id;
            $data['lecture_id_check'] = $lecture->id;
            $data['navLessonActive'] = 'on';
            $data['subNavLectureActiveClass'] = 'show';

        }


        return view('frontend.student.course.course-details', $data);
    }

    public function assignmentList(Request $request)
    {
        $data['assignments'] = Assignment::where('course_id', $request->course_id)->get();
        return view('frontend.student.course.partial.assignment.partial-assignment-list', $data);

    }

    public function assignmentDetails(Request $request)
    {
        $data['assignment'] = Assignment::whereCourseId($request->course_id)->whereId($request->assignment_id)->first();
        $data['assignmentSubmit'] = AssignmentSubmit::whereUserId(auth()->id())->whereCourseId($request->course_id)->whereAssignmentId($request->assignment_id)->first();
        return view('frontend.student.course.partial.assignment.partial-assignment-details', $data);

    }

    public function assignmentResult(Request $request)
    {
        $data['assignment'] = Assignment::whereCourseId($request->course_id)->whereId($request->assignment_id)->first();
        $data['assignmentSubmit'] = AssignmentSubmit::whereUserId(auth()->id())->whereCourseId($request->course_id)->whereAssignmentId($request->assignment_id)->first();
        return view('frontend.student.course.partial.assignment.partial-assignment-result', $data);

    }

    public function assignmentSubmit(Request $request)
    {
        $data['course_id'] = $request->course_id;
        $data['assignment'] = Assignment::whereCourseId($request->course_id)->whereId($request->assignment_id)->first();
        $data['assignmentSubmit'] = AssignmentSubmit::whereUserId(auth()->id())->whereCourseId($request->course_id)->whereAssignmentId($request->assignment_id)->first();

        return view('frontend.student.course.partial.assignment.partial-assignment-submit', $data);
    }

    public function assignmentSubmitStore(Request $request, $course_id, $assignment_id)
    {
        $validation = Validator::make($request->all(), [
            "file" => "mimes:pdf,zip|max:10000"
        ]);

        if ($validation->fails())
        {
            return response()->json([
                'messages' => $validation->errors()->all(),
            ]);
        }


        if ($request->hasFile('file')){
            $assignmentSubmit = AssignmentSubmit::whereUserId(auth()->id())->whereCourseId($course_id)->whereAssignmentId($assignment_id)->first();

            if (!$assignmentSubmit) {
                $assignmentSubmit = new AssignmentSubmit();
            } else {
                $this->deleteFile($assignmentSubmit->file);
            }

            $assignmentSubmit->course_id = $course_id;
            $assignmentSubmit->assignment_id = $assignment_id;

            $file_details = $this->uploadFileWithDetails('assignment_submit', $request->file);
            $assignmentSubmit->file = $file_details['path'];
            $assignmentSubmit->original_filename = $file_details['original_filename'];
            $assignmentSubmit->size = $file_details['size'] . 'MB';
            $assignmentSubmit->save();
        }


        $data['assignment'] = Assignment::whereCourseId($course_id)->whereId($assignment_id)->first();
        $data['assignmentSubmit'] = AssignmentSubmit::whereUserId(auth()->id())->whereCourseId($course_id)->whereAssignmentId($assignment_id)->first();

        return view('frontend.student.course.partial.assignment.partial-assignment-details', $data);
    }

    public function saveExamAnswer(Request $request, $course_uuid, $question_uuid, $take_exam_id)
    {
        $course = Course::whereUuid($course_uuid)->firstOrfail();
        $question = Question::whereUuid($question_uuid)->firstOrfail();
        $option = Question_option::whereUuid($request->selected_option_uuid)->firstOrfail();

        $answer = new Answer();
        $answer->exam_id = $question->exam_id;
        $answer->question_id = $question->id;
        $answer->question_option_id = $option->id;
        $answer->take_exam_id = $take_exam_id;
        $answer->is_correct = $option->is_correct_answer;
        $answer->save();

        if ($option->is_correct_answer == 'yes')
        {
            $take_exam = Take_exam::find($take_exam_id);
            $take_exam->number_of_correct_answer = $take_exam->number_of_correct_answer + 1;
            $take_exam->save();
        }

        $question_ids = Answer::whereUserId(auth()->user()->id)->whereExamId($question->exam_id)->pluck('question_id')->toArray();

        if (Question::whereExamId($question->exam_id)->whereNotIn('id', $question_ids)->count() > 0)
        {
            return redirect(route('student.my-course.show', [$course->slug, 'start-quiz', $question->exam->uuid, $answer->id]));
        } else {
            return redirect(route('student.my-course.show', [$course->slug, 'quiz-result', $question->exam->uuid]));
        }

    }

    public function reviewCreate(Request $request)
    {
        $review_exists_user = Review::whereUserId(auth()->id())->whereCourseId($request->course_id)->first();
        if ($review_exists_user)
        {
            return response()->json([
                'status' => 302,
                'msg' => 'Already you have reviewed. Thank you.'
            ]);
        }

        $request->validate([
            'course_id' => 'required',
            'rating' => 'required',
            'comment' => 'required',
        ]);

        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->course_id = $request->course_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        // Review Calculation and Update

        $data['five_star_count'] = Review::whereCourseId($request->course_id)->whereRating(5)->count();
        $data['four_star_count'] = Review::whereCourseId($request->course_id)->whereRating(4)->count();
        $data['three_star_count'] = Review::whereCourseId($request->course_id)->whereRating(3)->count();
        $data['two_star_count'] = Review::whereCourseId($request->course_id)->whereRating(2)->count();
        $data['first_star_count'] = Review::whereCourseId($request->course_id)->whereRating(1)->count();

        $data['total_reviews'] = (5*$data['five_star_count']) + (4*$data['four_star_count']) + (3*$data['three_star_count']) +
            (2*$data['two_star_count']) + (1*$data['first_star_count']);
        $data['total_user_review'] = $data['five_star_count'] + $data['four_star_count'] + $data['three_star_count'] + $data['two_star_count'] + $data['first_star_count'];

        if ($data['total_user_review'] > 0){
            $average_rating = $data['total_reviews']  / $data['total_user_review'];
        } else {
            $average_rating = 0;
        }

        $course = Course::findOrFail($request->course_id);
        $course->average_rating = number_format($average_rating, 1);
        $course->save();

        // End:: Review Calculation and Update

        return response()->json([
            'status' => 200,
            'msg' => 'Review Created Successful.'
        ]);
    }

    public function reviewPaginate(Request $request, $courseId)
    {
        $data['reviews'] = Review::whereCourseId($courseId)->latest()->paginate(3);
        $response['appendReviews'] = View::make('frontend.student.course.partial.render-partial-review-list', $data)->render();
        $response['reviews'] = Review::whereCourseId($courseId)->latest()->paginate(3);
        return response()->json($response);
    }

    public function discussionCreate(Request $request)
    {
        $discussion = new Discussion();
        $discussion->user_id = Auth::id();
        $discussion->course_id = $request->course_id;
        $discussion->comment = $request->discussionComment;
        $discussion->status = 1;
        $discussion->comment_as = $request->comment_as;
        $discussion->save();

        return redirect()->back();
    }

    public function discussionReply(Request $request, $id)
    {
        $discussion = new Discussion();
        $discussion->user_id = Auth::id();
        $discussion->course_id = $request->course_id;
        $discussion->comment = $request->commentReply;
        $discussion->status = 1;
        $discussion->parent_id = $id;
        $discussion->comment_as = $request->comment_as;
        $discussion->save();

        Discussion::where('id', $id)
            ->update([
                'view' => 2
            ]);
        Discussion::where('parent_id', $id)->update([
            'view' => 2
        ]);

        return redirect()->back();
    }

    public function videoCompleted(Request $request)
    {
        $lecture = Course_lecture::find($request->lecture_id);

        if (Course_lecture_views::where('user_id', auth()->id())->where('course_id', $lecture->course_id)->where('course_lecture_id', $lecture->id)->count() == 0)
        {
            $course_lecture_views = new Course_lecture_views();
            $course_lecture_views->course_id = $lecture->course_id;
            $course_lecture_views->course_lecture_id = $lecture->id;
            $course_lecture_views->save();
        }

        /** === make pdf certificate ===== */
        $course = Course::find($lecture->course_id);
        if (studentCourseProgress($course->id) == 100)
        {
            if (Certificate_by_instructor::where('course_id', $course->id)->count() > 0 && Student_certificate::where('course_id', $course->id)->count() == 0)
            {
                $certificate_by_instructor = Certificate_by_instructor::where('course_id', $course->id)->orderBy('id', 'DESC')->first();
                $certificate = Certificate::find($certificate_by_instructor->certificate_id);
                if ($certificate)
                {
                    $certificate_name = 'certificate-' . $course->uuid. '.pdf';
                    // make sure email invoice is checked.
                    $customPaper = array(0, 0, 612, 500);
                    $pdf = PDF::loadView('frontend.student.course.certificate.pdf', ['certificate' => $certificate, 'certificate_by_instructor' => $certificate_by_instructor, 'course_title' => $course->title])->setPaper($customPaper, 'portrait');;
                    //return $pdf->stream($certificate_name);
                    $pdf->save(public_path() . '/uploads/certificate/student/' . $certificate_name);
                    /** === make pdf certificate ===== */
                    $student_certificate = new Student_certificate();
                    $student_certificate->course_id = $course->id ;
                    $student_certificate->path =  "/uploads/certificate/student/$certificate_name";
                    $student_certificate->save();
                }

            }
        }
        /** ------- end save certificate ----------- */

        return response()->json([
            'success' => 'success'
        ]);
    }

    public function thankYou()
    {
        $data['pageTitle']  = 'New Enroll Course';
        $new_order = Order::whereUserId(auth()->id())->latest()->first();
        $data['new_courses'] = [];
        if ($new_order)
        {
            $newCourseIds = Order_item::whereOrderId($new_order->id)->pluck('course_id')->toArray();
            $data['new_courses'] = Course::whereIn('id', $newCourseIds)->get();
        }
        return view('frontend.thankyou', $data);
    }

}
