<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\LiveClass;
use App\Models\Order_item;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\SendNotification;
use App\Traits\ZoomMeetingTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LiveClassController extends Controller
{
    use General, ZoomMeetingTrait, SendNotification;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
    protected $model, $courseModel;

    public function __construct(LiveClass $liveClass, Course $course)
    {
        $this->model = new CRUD($liveClass);
        $this->courseModel = new CRUD($course);
    }

    public function courseLiveClassIndex()
    {
        $data['pageTitle'] = 'Live Class';
        $data['navLiveClassActiveClass'] = 'active';

        $now = now();

        $data['courses'] = Course::whereUserId(Auth::user()->id);
        $data['courses'] = $data['courses']->withCount([
            'liveClasses as total_upcoming' => function ($q) use ($now) {
                $q->select(DB::raw("COUNT(id) as total_upcoming"));
                $q->whereDate('date', '>=', $now->toDateString());
                $q->whereTime('time', '>', $now->toTimeString());

            },
            'liveClasses as total_past' => function ($q) use ($now) {
                $q->select(DB::raw("COUNT(id) as total_past"));
                $q->whereDate('date', '<=', $now->toDateString());
                $q->whereTime('time', '<', $now->toTimeString());
            },

        ])->paginate();


        return view('instructor.live_class.live-class-course-list', $data);
    }

    public function liveClassIndex(Request $request, $course_uuid)
    {
        $data['pageTitle'] = 'Live Class List';
        $data['navLiveClassActiveClass'] = 'active';
        if ($request->past)
        {
            $data['navPastActive'] = 'active';
            $data['tabPastActive'] = 'show active';
        } else {
            $data['navUpcomingActive'] = 'active';
            $data['tabUpcomingActive'] = 'show active';
        }

        $data['course'] = $this->courseModel->getRecordByUuid($course_uuid);

        $now = now();

        $data['upcoming_live_classes'] = LiveClass::whereCourseId($data['course']->id)->whereUserId(Auth::user()->id)
            ->whereDate('date', '>=', $now->toDateString())
            ->whereTime('time', '>', $now->toTimeString())
            ->latest()->paginate(15, '*', 'upcoming');

        $data['past_live_classes'] = LiveClass::whereCourseId($data['course']->id)->whereUserId(Auth::user()->id)
            ->whereDate('date', '<=', $now->toDateString())
            ->whereTime('time', '<', $now->toTimeString())
            ->latest()->paginate(15, '*', 'past');

        return view('instructor.live_class.live-class-list', $data);
    }

    public function createLiveCLass($course_uuid)
    {
        $data['pageTitle'] = 'Live Class Create';
        $data['navLiveClassActiveClass'] = 'active';
        $data['course'] = $this->courseModel->getRecordByUuid($course_uuid);
        return view('instructor.live_class.create', $data);
    }

    public function store(Request $request, $course_uuid)
    {
        $request->validate([
            'class_topic' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'duration' => 'required',
        ]);

        $course = $this->courseModel->getRecordByUuid($course_uuid);
        $class = new LiveClass();
        $class->course_id = $course->id;
        $class->class_topic = $request->class_topic;
        $class->date = $request->date;
        $class->time = $request->time;
        $class->duration = $request->duration;
        $class->join_url = $request->join_url;
        $class->meeting_id = $request->meeting_id;
        $class->meeting_password = $request->meeting_password;
        $class->save();

        /** ====== send notification to student ===== */
        $students = Order_item::where('course_id', $course->id)->select('user_id')->get();
        foreach ($students as $student)
        {
            $text = "New Live Class Added";
            $taget_url = route('student.my-course.show', $course->slug);
            $this->send($text, 3, $taget_url, $student->user_id);
        }
        /** ====== send notification to student ===== */

        $this->showToastrMessage('success', 'Live Class Created Successfully');
        return redirect()->route('live-class.index', $course_uuid);
    }

    public function view($course_uuid, $uuid)
    {
        $data['pageTitle'] = 'Live Class Details';
        $data['navLiveClassActiveClass'] = 'active';
        $data['course'] = $this->courseModel->getRecordByUuid($course_uuid);
        $data['liveClasses'] = $this->model->getRecordByUuid($uuid);
        return view('instructor.live_class.view', $data);
    }

    public function delete($uuid)
    {
        $this->model->deleteByUuid($uuid);
        $this->showToastrMessage('error', 'Deleted Successfully');
        return redirect()->back();
    }

    public function getZoomMeetingLink(Request $request)
    {
        $response = $this->create($request->all());

        return response()->json([
            'data' => $response['data']['start_url']
        ]);
    }
}
