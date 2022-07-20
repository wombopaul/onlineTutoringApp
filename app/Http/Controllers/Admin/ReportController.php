<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function revenueReportIndex()
    {
        if (!Auth::user()->can('finance')) {
            abort('403');
        } // end permission checking

        $courseIds = Order_item::whereHas('order', function ($q) {
            $q->where('payment_status', 'paid')->orWhere('payment_status', 'free');
        })->pluck('course_id')->toArray();

        $data['courses'] = Course::whereIn('id', $courseIds)->withCount([
            'orderItems as total_admin_commission' => function ($q) {
                $q->select(DB::raw("SUM(admin_commission)"));
            },

            'orderItems as total_owner_balance' => function ($q) {
                $q->select(DB::raw("SUM(owner_balance)"));
            },

            'orderItems as total_purchase_course' => function ($q) {
                $q->select(DB::raw("COUNT(id)"));
            },
        ])->get();

        $data['grand_admin_commission'] = $data['courses']->sum('total_admin_commission');
        $data['grand_instructor_commission'] = $data['courses']->sum('total_owner_balance');
        $data['total_enrolments'] = Order::where('payment_status', 'paid')->orWhere('payment_status', 'free')->count();
        $data['total_courses'] = Course::count();

        return view('admin.report.list', $data);
    }

    public function orderReportIndex()
    {
        if (!Auth::user()->can('finance')) {
            abort('403');
        } // end permission checking

        $data['orders'] = Order::where('payment_status', 'paid')->orWhere('payment_status', 'free')->withCount([
            'items as total_admin_commission' => function ($q) {
                $q->select(DB::raw("SUM(admin_commission)"));
            },

            'items as total_owner_balance' => function ($q) {
                $q->select(DB::raw("SUM(owner_balance)"));
            },
        ])->get();


        $data['grand_total'] = Order::where('payment_status', 'paid')->sum('grand_total');

        $data['total_platform_charge'] = Order::where('payment_status', 'paid')->sum('platform_charge');
        $total_order_admin_commission = Order::where('payment_status', 'paid')->withCount([
            'items as total_sell_commission' => function ($q) {
                $q->select(DB::raw('SUM(admin_commission)'));
            }
        ])->get();
        $data['total_admin_commission'] = $total_order_admin_commission->sum('total_admin_commission');

        $total_admin_sell = Order::where('payment_status', 'paid')->withCount([
            'items as total_admin_commission' => function ($q) {
                $q->select(DB::raw("SUM(admin_commission)"));
            },
        ])->get();
        $data['total_revenue'] = $total_admin_sell->sum(function ($q) {
            return $q->platform_charge + $q->total_admin_commission;
        });

        return view('admin.report.order-report-list', $data);
    }


}
