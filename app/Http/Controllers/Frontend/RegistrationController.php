<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SignUpRequest;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\EmailSendTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    use EmailSendTrait;

    protected $model;
    protected $studentModel;

    public function __construct(User $user, Student $student)
    {
        $this->model = new Crud($user);
        $this->studentModel = new Crud($student);
    }


    public function signUp()
    {
        $data['pageTitle'] = 'Sign Up';
        return view('auth.sign-up', $data);
    }

    public function storeSignUp(SignUpRequest $request)
    {
        $user = new User();
        $user->name = $request->first_name . ' '. $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = $request->_token;
        $user->role = 3;
        $user->save();

        Auth::login($user);

        $student_data = [
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        $this->studentModel->create($student_data);

        $this->userEmailVerification(); // Send verification email to user

        return redirect(route('home'));
    }


    public function emailVerification($token)
    {
        if (User::where('remember_token', $token)->count() > 0)
        {
            $user = User::where('remember_token', $token)->first();
            $user->email_verified_at = Carbon::now()->format("Y-m-d H:i:s");
            $user->remember_token = null;
            $user->save();
            Auth::login($user);

            return redirect()->route('home');

        } else {
            return redirect(route('login'));
        }

    }

}
