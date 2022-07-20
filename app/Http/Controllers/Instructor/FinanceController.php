<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order_item;
use App\Models\Withdraw;
use App\Traits\General;
use App\Traits\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class FinanceController extends Controller
{
    use General, SendNotification;

    public function analysisIndex()
    {
        $data['navFinanceActiveClass'] = 'has-open';
        $data['subNavAnalysisActiveClass'] = 'active';
        $data['title'] = 'Analysis';

        $data['total_courses'] = Course::whereUserId(auth()->user()->id)->count();
        $userCourseIds = Course::whereUserId(auth()->user()->id)->pluck('id')->toArray();

        $orderItems = Order_item::whereIn('course_id', $userCourseIds)->whereHas('order', function ($q) {
            $q->where('payment_status', 'paid');
        });

        $data['total_enroll'] = $orderItems->count('id');
        $data['total_earning'] = $orderItems->sum('owner_balance');
        $data['total_withdraw_amount'] = Withdraw::whereUserId(auth()->user()->id)->completed()->sum('amount');
        $data['total_pending_withdraw_amount'] = Withdraw::whereUserId(auth()->user()->id)->pending()->sum('amount');

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

        return view('instructor.finance.analysis-index')->with($data);
    }

    public function withdrawIndex()
    {
        $data['title'] = 'Withdraw History';
        $data['navFinanceActiveClass'] = 'has-open';
        $data['subNavWithdrawActiveClass'] = 'active';
        $data['withdraws'] = Withdraw::whereUserId(auth()->user()->id)->paginate(20);
        return view('instructor.finance.withdraw-history-index')->with($data);
    }

    public function storeWithdraw(Request $request)
    {
        if ($request->amount > instructor_available_balance())
        {
            $this->showToastrMessage('warning', 'Insufficient balance');
            return redirect()->back();
        } else {

            $withdrow = new Withdraw();
            $withdrow->transection_id = rand(1000000, 9999999);;
            $withdrow->amount = $request->amount;
            $withdrow->payment_method = $request->payment_method;
            $withdrow->save();

            $text = "New Withdraw Request Received";
            $taget_url = route('finance.new-withdraw');
            $this->send($text, 1, $taget_url, null);

            $this->showToastrMessage('warming', 'Withdraw request has been saved');
            return redirect()->back();

        }

    }

    public function downloadReceipt($uuid)
    {
        $withdraw = Withdraw::whereUuid($uuid)->first();

        $invoice_name = 'receipt-' . $withdraw->transection_id. '.pdf';
        // make sure email invoice is checked.
        $customPaper = array(0, 0, 612, 792);
        $pdf = PDF::loadView('instructor.finance.receipt-pdf', ['withdraw' => $withdraw])->setPaper($customPaper, 'portrait');
        $pdf->save(public_path() . '/uploads/receipt/' . $invoice_name);
       // return $pdf->stream($invoice_name);
        return $pdf->download($invoice_name);
    }
}
