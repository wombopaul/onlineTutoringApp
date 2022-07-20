<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Order_item;
use App\Models\Student;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstructorController extends Controller
{
    use General, ImageSaveTrait;

    protected $instructorModel, $studentModel;
    public function __construct(Instructor $instructor, Student $student)
    {
        $this->instructorModel = new Crud($instructor);
        $this->studentModel = new Crud($student);
    }

    public function index()
    {
        if (!Auth::user()->can('all_instructor')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'All Instructors';
        $data['instructors'] = $this->instructorModel->all();
        return view('admin.instructor.index', $data);
    }

    public function view($uuid)
    {
        $data['title'] = 'Instructor Profile';
        $data['instructor'] = $this->instructorModel->getRecordByUuid($uuid);
        $userCourseIds = Course::whereUserId($data['instructor']->user->id)->pluck('id')->toArray();
        if (count($userCourseIds) > 0){
            $orderItems = Order_item::whereIn('course_id', $userCourseIds)
                ->whereYear("created_at", now()->year)->whereMonth("created_at", now()->month)
                ->whereHas('order', function ($q) {
                    $q->where('payment_status', 'paid');
                });
            $data['total_earning'] = $orderItems->sum('owner_balance');
        }

        return view('admin.instructor.view', $data);
    }

    public function pending()
    {
        if (!Auth::user()->can('pending_instructor')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'Pending for Review';
        $data['instructors'] = Instructor::pending()->orderBy('id', 'desc')->paginate(25);
        return view('admin.instructor.pending', $data);
    }

    public function approved()
    {
        if (!Auth::user()->can('approved_instructor')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'Approved Instructor';
        $data['instructors'] = Instructor::approved()->orderBy('id', 'desc')->paginate(25);
        return view('admin.instructor.approved', $data);
    }


    public function changeStatus($uuid, $status)
    {
        $instructor = $this->instructorModel->getRecordByUuid($uuid);
        $instructor->status = $status;
        $instructor->save();

        if ($status == 1)
        {
            $user = User::find($instructor->user_id);
            $user->role = 2;
            $user->save();
        }

        $this->showToastrMessage('success', 'Status has been changed');
        return redirect()->back();
    }


    public function delete($uuid)
    {
        if (!Auth::user()->can('manage_instructor')) {
            abort('403');
        } // end permission checking

        $instructor = $this->instructorModel->getRecordByUuid($uuid);
        Course::where('instructor_id', $instructor->id)->delete();

        $this->model->deleteByUuid($uuid); // delete record

        $this->showToastrMessage('error', 'Instructor has been deleted');
        return redirect()->back();
    }

    public function create()
    {
        $data['title'] = 'Add Instructor';
        return view('admin.instructor.add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:2'],
            'professional_title' => 'required',
            'about_me' => 'required',
            'image' => 'mimes:jpeg,png,jpg|file|dimensions:min_width=300,min_height=228,max_width=300,max_height=228|max:1024'
        ]);

        $user = new User();
        $user->name = $request->first_name . ' '. $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 2;
        $user->image =  $request->image ? $this->saveImage('user', $request->image, 300, 228) :   null;
        $user->save();


        $student_data = [
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        $this->studentModel->create($student_data);

        if (Instructor::where('slug', Str::slug($user->name))->count() > 0)
        {
            $slug = Str::slug($user->name) . '-'. rand(100000, 999999);
        } else {
            $slug = Str::slug($user->name);
        }

        $instructor_data = [
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'professional_title' => $request->professional_title,
            'phone_number' => $request->phone_number,
            'about_me' => $request->about_me,
            'slug' => $slug,
            'status' => 1,
        ];

        $this->instructorModel->create($instructor_data);

        $this->showToastrMessage('success', 'Instructor created successfully');
        return redirect()->route('instructor.index');
    }
}
