<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    use General, ImageSaveTrait;

    protected $studentModel;
    public function __construct( Student $student)
    {
        $this->studentModel = new Crud($student);
    }
    public function index()
    {
        $data['title'] = 'All Student';
        $data['students'] = $this->studentModel->all();
        return view('admin.student.list', $data);
    }

    public function create()
    {
        $data['title'] = 'Add Student';
        return view('admin.student.add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:2'],
            'image' => 'mimes:jpeg,png,jpg|file|dimensions:min_width=300,min_height=228,max_width=300,max_height=228|max:1024'
        ]);

        $user = new User();
        $user->name = $request->first_name . ' '. $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 3;
        $user->image =  $request->image ? $this->saveImage('user', $request->image, 100, 100) :   null;
        $user->save();


        $student_data = [
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number
        ];

        $this->studentModel->create($student_data);

        $this->showToastrMessage('success', 'Student created successfully');
        return redirect()->route('student.index');
    }

}
