<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Traits\General;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    use General;
    public function privacyPolicy()
    {
        $data['title'] = 'Privacy Policy';
        $data['navPolicyActiveClass'] = 'mm-active';
        $data['subNavPrivacyPolicyActiveClass'] = 'mm-active';
        $data['policy'] = Policy::whereType(1)->first();

        return view('admin.policy.privacy-policy', $data);
    }

    public function privacyPolicyStore(Request $request)
    {
        $policy = Policy::whereType(1)->first();
        if (!$policy)
        {
            $policy = new Policy();
        }

        $policy->type = 1;
        $policy->description = $request->description;
        $policy->save();

        $this->showToastrMessage('success', 'Updated Successfully');
        return redirect()->back();

    }

    public function cookiePolicy()
    {
        $data['title'] = 'Cookie Policy';
        $data['navPolicyActiveClass'] = 'mm-active';
        $data['subNavCookiePolicyActiveClass'] = 'mm-active';
        $data['policy'] = Policy::whereType(2)->first();

        return view('admin.policy.cookie-policy', $data);
    }

    public function cookiePolicyStore(Request $request)
    {
       $policy = Policy::whereType(2)->first();
       if (!$policy)
       {
           $policy = new Policy();
       }

       $policy->type = 2;
       $policy->description = $request->description;
       $policy->save();

       $this->showToastrMessage('success', 'Updated Successfully');
       return redirect()->back();

    }

}
