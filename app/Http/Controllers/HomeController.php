<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        if (Auth::user()->is_admin())
//        {
//            return redirect(route('admin.dashboard'));
//        } elseif (Auth::user()->is_instructor()) {
//
//            return redirect(route('instructor.dashboard'));
//        } else {
//
//            return redirect(route('student.dashboard'));
//        }


        if (Auth::user()->is_admin())
        {
            return redirect(route('admin.dashboard'));

        } else {
            return redirect(route('main.index'));
        }
    }
}
