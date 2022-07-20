<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\AccountRequest;
use App\Http\Requests\Instructor\CardRequest;
use App\Models\Email_notification_setting;
use App\Models\Instructor;
use App\Models\User;
use App\Models\User_card;
use App\Models\User_paypal;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    use  ImageSaveTrait, General;

    public function myCard()
    {
        $data['title'] = 'My Card';
        $data['navPaymentActiveClass'] = 'active';
        return view('instructor.account.my-card', $data);
    }

    public function saveMyCard(CardRequest $request)
    {
        User_card::where('user_id', Auth::id())->updateOrCreate([
            'user_id' => Auth::id(),
            'card_number' => $request->card_number,
            'card_holder_name' => $request->card_holder_name,
            'month' => $request->month,
            'year' => $request->year,
        ]);

        $this->showToastrMessage('success', 'Update Successfully');
        return redirect()->back();
    }

    public function savePaypal(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        User_paypal::where('user_id', Auth::id())->updateOrCreate([
            'user_id' => Auth::id(),
            'email' => $request->email
        ]);

        $this->showToastrMessage('success', 'Update Successfully ');
        return redirect()->back();
    }
}
