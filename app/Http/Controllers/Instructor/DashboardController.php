<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order_item;
use App\Models\RankingLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $userCourseIds = Course::whereUserId(auth()->user()->id)->pluck('id')->toArray();
        $orderItems = Order_item::whereIn('course_id', $userCourseIds)
            ->whereYear("created_at", now()->year)->whereMonth("created_at", now()->month)
            ->whereHas('order', function ($q) {
                $q->where('payment_status', 'paid');
            });
        $data['total_earning'] = $orderItems->sum('owner_balance');
        $data['total_enroll'] = $orderItems->count('id');
        $data['best_selling_course'] = Order_item::whereIn('course_id', $userCourseIds)->whereHas('order', function ($q) {
            $q->where('payment_status', 'paid');
        })->groupBy("course_id")->selectRaw("COUNT(course_id) as total_course_id, course_id")->orderByRaw("COUNT(course_id) DESC")->first();

        $data['recentCourses'] = Course::whereUserId(auth()->user()->id)->latest()->limit(2)->get();
        $data['updatedCourses'] = Course::whereUserId(auth()->user()->id)->orderBy('updated_at', 'desc')->limit(2)->get();

        $months = collect([]);
        $totalPrice = collect([]);

        Order_item::whereIn('course_id', $userCourseIds)->whereHas('order', function ($q) {
            $q->where('payment_status', 'paid');
        })->select(DB::raw('SUM(owner_balance) as total'), DB::raw('MONTHNAME(created_at) month'))
            ->groupby('month')
            ->get()
            ->map(function ($q) use ($months, $totalPrice) {
                $months->push($q->month);
                $totalPrice->push($q->total);
            });

        $data['months'] = $months;
        $data['totalPrice'] = $totalPrice;

        //Start:: ranking Level
        $allOrderItems = Order_item::whereIn('course_id', $userCourseIds)->whereHas('order', function ($q) {
            $q->where('payment_status', 'paid');
        });

        $data['grand_total_earning'] = $allOrderItems->sum('owner_balance');
        $data['grand_total_enroll'] = $allOrderItems->count('id');

        $data['levels'] = RankingLevel::orderBy('serial_no', 'DESC')->get();
        //End:: ranking Level
        return view('instructor.dashboard', $data);
    }

    public function rankingLevelList()
    {
        $data['title'] = 'Dashboard';
        $data['navDashboardActiveClass'] = 'active';
        $data['levels'] = RankingLevel::orderBy('serial_no', 'asc')->get();
        return view('instructor.ranking-badge-list', $data);
    }
}
