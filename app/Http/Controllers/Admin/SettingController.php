<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Currency;
use App\Models\FaqQuestion;
use App\Models\InstructorFeature;
use App\Models\InstructorProcedure;
use App\Models\Language;
use App\Models\Meta;
use App\Models\Setting;
use App\Models\SupportTicketQuestion;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Auth;

class SettingController extends Controller
{
    use General, ImageSaveTrait;

    protected $metaModel;

    public function __construct(Meta $meta)
    {
        $this->metaModel = new Crud($meta);
    }

    public function GeneralSetting()
    {
        if (!Auth::user()->can('global_setting')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'General Setting';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
        $data['generalSettingsActiveClass'] = 'active';
        $data['currencies'] = Currency::all();
        $data['current_currency'] = Currency::where('current_currency', 'on')->first();
        $data['languages'] = Language::all();
        $data['default_language'] = Language::where('default_language', 'on')->first();

        return view('admin.application_settings.general.general-settings', $data);
    }

    public function GeneralSettingUpdate(Request $request)
    {
        $inputs = Arr::except($request->all(), ['_token']);
        $keys = [];

        foreach ($inputs as $k => $v) {
            $keys[$k] = $k;
        }

        foreach ($inputs as $key => $value) {
            $option = Setting::firstOrCreate(['option_key' => $key]);
            if ($request->hasFile('app_logo') && $key == 'app_logo') {
                $request->validate([
                    'app_logo' => 'mimes:png|file'
                ]);
                $this->deleteFile(get_option('app_logo'));
                $option->option_value = $request->app_logo->move('uploads/setting/', Str::random(20) . '.' . $request->app_logo->extension());
                $option->save();
            } elseif ($request->hasFile('app_fav_icon') && $key == 'app_fav_icon') {
                $request->validate([
                    'app_fav_icon' => 'mimes:png|file'
                ]);
                $this->deleteFile(get_option('app_fav_icon'));
                $option->option_value = $request->app_fav_icon->move('uploads/setting/', Str::random(20) . '.' . $request->app_fav_icon->extension());
                $option->save();
            } elseif ($request->hasFile('banner') && $key == 'banner') {
                $this->deleteFile(get_option('banner'));
                $option->option_value = $request->banner->move('uploads/setting/', Str::random(20) . '.' . $request->banner->extension());
                $option->save();
            } elseif ($request->hasFile('faq_image') && $key == 'faq_image') {
                $request->validate([
                    'faq_image' => 'mimes:png,jpg,jpeg|file'
                ]);

                $this->deleteFile('faq_image');
                $path = $this->saveImage('setting', $request->faq_image, null, 650);
                $option->option_value = $path;
                $option->save();

            } elseif ($request->hasFile('home_special_feature_first_logo') && $key == 'home_special_feature_first_logo') {
                $request->validate([
                    'home_special_feature_first_logo' => 'mimes:png|file|dimensions:min_width=77,min_height=77,max_width=77,max_height=77'
                ]);
                $this->deleteFile(get_option('home_special_feature_first_logo'));
                $option->option_value = $request->home_special_feature_first_logo->move('uploads/setting/', Str::random(20) . '.' . $request->home_special_feature_first_logo->extension());
                $option->save();
            } elseif ($request->hasFile('home_special_feature_second_logo') && $key == 'home_special_feature_second_logo') {
                $request->validate([
                    'home_special_feature_second_logo' => 'mimes:png|file|dimensions:min_width=77,min_height=77,max_width=77,max_height=77'
                ]);
                $this->deleteFile(get_option('home_special_feature_second_logo'));
                $option->option_value = $request->home_special_feature_second_logo->move('uploads/setting/', Str::random(20) . '.' . $request->home_special_feature_second_logo->extension());
                $option->save();
            } elseif ($request->hasFile('home_special_feature_third_logo') && $key == 'home_special_feature_third_logo') {
                $request->validate([
                    'home_special_feature_third_logo' => 'mimes:png|file|dimensions:min_width=77,min_height=77,max_width=77,max_height=77'
                ]);
                $this->deleteFile(get_option('home_special_feature_third_logo'));
                $option->option_value = $request->home_special_feature_third_logo->move('uploads/setting/', Str::random(20) . '.' . $request->home_special_feature_third_logo->extension());
                $option->save();
            } elseif ($request->hasFile('course_logo') && $key == 'course_logo') {
                $request->validate([
                    'course_logo' => 'mimes:png|file|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
                ]);
                $this->deleteFile(get_option('course_logo'));
                $option->option_value = $request->course_logo->move('uploads/setting/', Str::random(20) . '.' . $request->course_logo->extension());
                $option->save();
            } elseif ($request->hasFile('top_category_logo') && $key == 'top_category_logo') {
                $request->validate([
                    'top_category_logo' => 'mimes:png|file|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
                ]);
                $this->deleteFile(get_option('top_category_logo'));
                $option->option_value = $request->top_category_logo->move('uploads/setting/', Str::random(20) . '.' . $request->top_category_logo->extension());
                $option->save();
            } elseif ($request->hasFile('top_instructor_logo') && $key == 'top_instructor_logo') {
                $request->validate([
                    'top_instructor_logo' => 'mimes:png|file|dimensions:min_width=70,min_height=70,max_width=70,max_height=70'
                ]);
                $this->deleteFile(get_option('top_instructor_logo'));
                $option->option_value = $request->top_instructor_logo->move('uploads/setting/', Str::random(20) . '.' . $request->top_instructor_logo->extension());
                $option->save();
            } elseif ($request->hasFile('become_instructor_video_logo') && $key == 'become_instructor_video_logo') {
                $request->validate([
                    'become_instructor_video_logo' => 'mimes:png|file|dimensions:min_width=70,min_height=70,max_width=70,max_height=70'
                ]);
                $this->deleteFile(get_option('become_instructor_video_logo'));
                $option->option_value = $request->become_instructor_video_logo->move('uploads/setting/', Str::random(20) . '.' . $request->become_instructor_video_logo->extension());
                $option->save();
            } elseif ($request->hasFile('customer_say_logo') && $key == 'customer_say_logo') {
                $request->validate([
                    'customer_say_logo' => 'mimes:png|file|dimensions:min_width=64,min_height=64,max_width=64,max_height=64'
                ]);
                $this->deleteFile(get_option('customer_say_logo'));
                $option->option_value = $request->customer_say_logo->move('uploads/setting/', Str::random(20) . '.' . $request->customer_say_logo->extension());
                $option->save();
            } elseif ($request->hasFile('achievement_first_logo') && $key == 'achievement_first_logo') {
                $request->validate([
                    'achievement_first_logo' => 'mimes:png|file|dimensions:min_width=58,min_height=58,max_width=58,max_height=58'
                ]);
                $this->deleteFile(get_option('achievement_first_logo'));
                $option->option_value = $request->achievement_first_logo->move('uploads/setting/', Str::random(20) . '.' . $request->achievement_first_logo->extension());
                $option->save();
            } elseif ($request->hasFile('achievement_second_logo') && $key == 'achievement_second_logo') {
                $request->validate([
                    'achievement_second_logo' => 'mimes:png|file|dimensions:min_width=58,min_height=58,max_width=58,max_height=58'
                ]);
                $this->deleteFile(get_option('achievement_second_logo'));
                $option->option_value = $request->achievement_second_logo->move('uploads/setting/', Str::random(20) . '.' . $request->achievement_second_logo->extension());
                $option->save();
            } elseif ($request->hasFile('achievement_third_logo') && $key == 'achievement_third_logo') {
                $request->validate([
                    'achievement_third_logo' => 'mimes:png|file|dimensions:min_width=58,min_height=58,max_width=58,max_height=58'
                ]);
                $this->deleteFile(get_option('achievement_third_logo'));
                $option->option_value = $request->achievement_third_logo->move('uploads/setting/', Str::random(20) . '.' . $request->achievement_third_logo->extension());
                $option->save();
            } elseif ($request->hasFile('achievement_four_logo') && $key == 'achievement_four_logo') {
                $request->validate([
                    'achievement_four_logo' => 'mimes:png|file|dimensions:min_width=58,min_height=58,max_width=58,max_height=58'
                ]);
                $this->deleteFile(get_option('achievement_four_logo'));
                $option->option_value = $request->achievement_four_logo->move('uploads/setting/', Str::random(20) . '.' . $request->achievement_four_logo->extension());
                $option->save();
            } elseif ($request->hasFile('sign_up_left_image') && $key == 'sign_up_left_image') {
                $request->validate([
                    'sign_up_left_image' => 'mimes:png|file|dimensions:min_width=800,min_height=540,max_width=800,max_height=540'
                ]);
                $this->deleteFile(get_option('sign_up_left_image'));
                $option->option_value = $request->sign_up_left_image->move('uploads/setting/', Str::random(20) . '.' . $request->sign_up_left_image->extension());
                $option->save();
            } elseif ($request->hasFile('become_instructor_video_preview_image') && $key == 'become_instructor_video_preview_image') {
                $request->validate([
                    'become_instructor_video_preview_image' => 'mimes:png|file|dimensions:min_width=835,min_height=630,max_width=835,max_height=630'
                ]);
                $this->deleteFile(get_option('become_instructor_video_preview_image'));
                $option->option_value = $request->become_instructor_video_preview_image->move('uploads/setting/', Str::random(20) . '.' . $request->become_instructor_video_preview_image->extension());
                $option->save();
            } elseif ($request->hasFile('become_instructor_video') && $key == 'become_instructor_video') {
                $this->deleteVideoFile(get_option('become_instructor_video'));
                $option->option_value = $this->uploadFile('setting', $request->become_instructor_video, null, null);
                $option->save();
            } else {
                $option->option_value = $value;
                $option->save();
            }
        }

        if ($request->currency_id)
        {
            Currency::where('id', $request->currency_id)->update(['current_currency' => 'on']);
            Currency::where('id', '!=', $request->currency_id)->update(['current_currency' => 'off']);
        }

        /**  ====== Set Language ====== */
        if ($request->language_id)
        {
            Language::where('id', $request->language_id)->update(['default_language' => 'on']);
            Language::where('id', '!=', $request->language_id)->update(['default_language' => 'off']);
            $language = Language::where('default_language', 'on')->first();
            if ($language) {
                $ln = $language->iso_code;
                session(['local' => $ln]);
                App::setLocale(session()->get('local'));
            }
        }

        $this->showToastrMessage('success', 'Successfully Updated');
        Artisan::call('optimize:clear');
        return redirect()->back();
    }

    public function ZoomSettings()
    {
        $data['title'] = 'Zoom Setting';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
        $data['zoomSettingsActiveClass'] = 'active';
        return view('admin.application_settings.general.zoom-settings', $data);
    }

    public function ZoomSettingsUpdate(Request $request)
    {
        $values['ZOOM_API_URL'] = $request->ZOOM_API_URL;
        $values['ZOOM_API_KEY'] = $request->ZOOM_API_KEY;
        $values['ZOOM_API_SECRET'] = $request->ZOOM_API_SECRET;

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str))
            return false;

        Artisan::call('optimize:clear');

        $this->showToastrMessage('success', 'Successfully Updated');
        return redirect()->back();
    }

    public function socialLoginSettings()
    {
        $data['title'] = 'Social Login Setting';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
        $data['socialLoginSettingsActiveClass'] = 'active';
        return view('admin.application_settings.general.social-login-settings', $data);
    }

    public function socialLoginSettingsUpdate(Request $request)
    {
        $values['GOOGLE_LOGIN_STATUS'] = $request->GOOGLE_LOGIN_STATUS;
        $values['GOOGLE_CLIENT_ID'] = $request->GOOGLE_CLIENT_ID;
        $values['GOOGLE_CLIENT_SECRET'] = $request->GOOGLE_CLIENT_SECRET;
        $values['GOOGLE_REDIRECT_URL'] = $request->GOOGLE_REDIRECT_URL;

        $values['FACEBOOK_LOGIN_STATUS'] = $request->FACEBOOK_LOGIN_STATUS;
        $values['FACEBOOK_CLIENT_ID'] = $request->FACEBOOK_CLIENT_ID;
        $values['FACEBOOK_CLIENT_SECRET'] = $request->FACEBOOK_CLIENT_SECRET;
        $values['FACEBOOK_REDIRECT_URL'] = $request->FACEBOOK_REDIRECT_URL;

        $values['TWITTER_LOGIN_STATUS'] = $request->TWITTER_LOGIN_STATUS;
        $values['TWITTER_CLIENT_ID'] = $request->TWITTER_CLIENT_ID;
        $values['TWITTER_CLIENT_SECRET'] = $request->TWITTER_CLIENT_SECRET;
        $values['TWITTER_REDIRECT_URL'] = $request->TWITTER_REDIRECT_URL;

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str))
            return false;

        Artisan::call('optimize:clear');
        $this->showToastrMessage('success', 'Successfully Updated');
        return redirect()->back();
    }

    public function cookieSettings()
    {
        $data['title'] = 'Cookie Setting';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
        $data['cookieSettingsActiveClass'] = 'active';
        return view('admin.application_settings.general.cookie-settings', $data);
    }

    public function cookieSettingsUpdate(Request $request)
    {
        $values['COOKIE_CONSENT_STATUS'] = $request->COOKIE_CONSENT_STATUS;

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str))
            return false;

        Artisan::call('optimize:clear');
        $this->showToastrMessage('success', 'Successfully Updated');
        return redirect()->back();
    }

    public function awsSettings()
    {
        $data['title'] = 'AWS Setting';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
        $data['awsSettingsActiveClass'] = 'active';
        return view('admin.application_settings.general.aws-s3-settings', $data);
    }

    public function awsSettingsUpdate(Request $request)
    {
        $values['STORAGE_DRIVER'] = $request->STORAGE_DRIVER;
        $values['AWS_ACCESS_KEY_ID'] = $request->AWS_ACCESS_KEY_ID;
        $values['AWS_SECRET_ACCESS_KEY'] = $request->AWS_SECRET_ACCESS_KEY;
        $values['AWS_DEFAULT_REGION'] = $request->AWS_DEFAULT_REGION;
        $values['AWS_BUCKET'] = $request->AWS_BUCKET;

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str))
            return false;

        Artisan::call('optimize:clear');
        $this->showToastrMessage('success', 'Successfully Updated');
        return redirect()->back();
    }

    public function vimeoSettings()
    {
        $data['title'] = 'Vimeo Setting';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
        $data['vimeoSettingsActiveClass'] = 'active';
        return view('admin.application_settings.general.vimeo-settings', $data);
    }

    public function vimeoSettingsUpdate(Request $request)
    {
        $values['VIMEO_CLIENT'] = $request->VIMEO_CLIENT;
        $values['VIMEO_SECRET'] = $request->VIMEO_SECRET;
        $values['VIMEO_TOKEN_ACCESS'] = $request->VIMEO_TOKEN_ACCESS;
        $values['VIMEO_STATUS'] = $request->VIMEO_STATUS;

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str))
            return false;

        Artisan::call('optimize:clear');
        $this->showToastrMessage('success', 'Successfully Updated');
        return redirect()->back();
    }

    public function metaIndex()
    {
        $data['title'] = 'Meta Management';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavGlobalSettingsActiveClass'] = 'mm-active';
        $data['metaIndexActiveClass'] = 'active';

        $data['metas'] = $this->metaModel->all();
        return view('admin.application_settings.meta_manage.index', $data);
    }

    public function editMeta($uuid)
    {
        $data['title'] = 'Edit Meta';
        $data['meta'] = $this->metaModel->getRecordByUuid($uuid);
        return view('admin.application_settings.meta_manage.edit', $data);
    }

    public function updateMeta(Request $request, $uuid)
    {
        $this->metaModel->updateByUuid($request->only($this->metaModel->getModel()->fillable), $uuid);
        toastrMessage('success', 'Successfully Saved');
        return redirect()->route('settings.meta.index');
    }

    public function paymentMethod()
    {
        $data['title'] = 'Payment Method Setting';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavPaymentOptionsSettingsActiveClass'] = 'mm-active';
        $data['paymentMethodSettingsActiveClass'] = 'active';
        return view('admin.application_settings.payment-method', $data);
    }

    public function mailConfiguration()
    {
        $data['title'] = 'Mail Configuration';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavMailConfigSettingsActiveClass'] = 'mm-active';
        $data['mailConfigSettingsActiveClass'] = 'active';
        return view('admin.application_settings.mail-configuration', $data);
    }

    public function sendTestMail(Request $request)
    {
        $data = $request;

        try {
            Mail::to($request->to)->send(new TestMail($data));
        } catch (\Exception $exception) {
            toastrMessage('error', 'Something is wrong. Please check your email settings');
            return redirect()->back();
        }

        toastrMessage('success', 'Mail Successfully send.');
        return redirect()->back();
    }

    public function saveSetting(Request $request)
    {
        $this->updateSettings($request);
        $this->showToastrMessage('success', 'Successfully Saved');
        return redirect()->back();
    }

    private function updateSettings($request)
    {
        $inputs = Arr::except($request->all(), ['_token']);
        $keys = [];

        foreach ($inputs as $k => $v) {
            $keys[$k] = $k;
        }

        foreach ($inputs as $key => $value) {
            $option = Setting::firstOrCreate(['option_key' => $key]);
            $option->option_value = $value;
            $option->save();
            Artisan::call('cache:clear');
            $oldValue = env($key);
            $newValue = str_replace(' ', '', $value);

            $path = base_path('.env');
            if (file_exists($path)) {
                file_put_contents(
                    $path, str_replace($key . '=' . $oldValue, $key . '=' . $newValue, file_get_contents($path))
                );
            }
        }

        Artisan::call('optimize:clear');

    }

    public function instructorFeatureSetting()
    {
        $data['title'] = 'Instructor Feature';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavInstructorSettingsActiveClass'] = 'mm-active';
        $data['instructorFeatureSettingsActiveClass'] = 'active';
        $data['instructorFeatures'] = InstructorFeature::all();

        return view('admin.application_settings.instructor.instructor-feature', $data);
    }

    public function instructorFeatureSettingUpdate(Request $request)
    {
        $now = now();
        if ($request['instructor_features']) {
            if (count(@$request['instructor_features']) > 0) {
                /*
                 * Check every logo in valid
                 */
                foreach ($request['instructor_features'] as $instructor_feature) {
                    if (@$instructor_feature['title'] || @$instructor_feature['subtitle'] || @$instructor_feature['logo']) {
                        if (@$instructor_feature['id']) {
                            $feature = InstructorFeature::find($instructor_feature['id']);
                            if (@$instructor_feature['logo']) {
                                $feature->logo = $this->updateImage('instructor_feature', @$instructor_feature['logo'], $feature->logo, 'null', 'null');
                            }
                        } else {
                            $feature = new InstructorFeature();
                            if (@$instructor_feature['logo']) {
                                $feature->logo = $this->saveImage('instructor_feature', @$instructor_feature['logo'], 'null', 'null');
                            }
                        }
                        $feature->title = @$instructor_feature['title'];
                        $feature->subtitle = @$instructor_feature['subtitle'];
                        $feature->updated_at = $now;
                        $feature->save();
                    }
                }
            }
        }

        InstructorFeature::where('updated_at', '!=', $now)->get()->map(function ($q) {
            $this->deleteFile($q->logo);
            $q->delete();
        });

        $this->showToastrMessage('success', 'Updated Successful');
        return redirect()->back();
    }

    public function instructorProcedureSetting()
    {
        $data['title'] = 'Instructor Procedure';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavInstructorSettingsActiveClass'] = 'mm-active';
        $data['instructorProcedureSettingsActiveClass'] = 'active';
        $data['instructorProcedures'] = InstructorProcedure::all();

        return view('admin.application_settings.instructor.instructor-procedure', $data);
    }

    public function instructorProcedureSettingUpdate(Request $request)
    {
        $now = now();
        if ($request['instructor_procedures']) {
            if (count(@$request['instructor_procedures']) > 0) {
                foreach ($request['instructor_procedures'] as $instructor_procedure) {
                    if (@$instructor_procedure['title'] || @$instructor_procedure['subtitle'] || @$instructor_procedure['image']) {
                        if (@$instructor_procedure['id']) {
                            $procedure = InstructorProcedure::find($instructor_procedure['id']);
                            if (@$instructor_procedure['logo']) {
                                $procedure->image = $this->updateImage('instructor_procedure', @$instructor_procedure['image'], $procedure->image, 'null', 'null');
                            }
                        } else {
                            $procedure = new InstructorProcedure();
                            if (@$instructor_procedure['image']) {
                                $procedure->image = $this->saveImage('instructor_procedure', @$instructor_procedure['image'], 'null', 'null');
                            }
                        }
                        $procedure->title = @$instructor_procedure['title'];
                        $procedure->subtitle = @$instructor_procedure['subtitle'];
                        $procedure->updated_at = $now;
                        $procedure->save();
                    }
                }
            }
        }

        InstructorProcedure::where('updated_at', '!=', $now)->get()->map(function ($q) {
            $this->deleteFile($q->image);
            $q->delete();
        });

        $this->showToastrMessage('success', 'Updated Successful');
        return redirect()->back();
    }

    public function instructorCMSSetting()
    {
        $data['title'] = 'Instructor CMS';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavInstructorSettingsActiveClass'] = 'mm-active';
        $data['instructorCMSSettingsActiveClass'] = 'active';

        return view('admin.application_settings.instructor.cms', $data);
    }

    public function faqCMS()
    {
        if (!Auth::user()->can('content_setting')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'FAQ CMS';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavFAQSettingsActiveClass'] = 'mm-active';
        $data['faqCMSSettingsActiveClass'] = 'active';

        return view('admin.application_settings.faq.cms', $data);
    }

    public function faqTab()
    {
        if (!Auth::user()->can('content_setting')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'FAQ Tab';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavFAQSettingsActiveClass'] = 'mm-active';
        $data['faqCMSTabActiveClass'] = 'active';

        return view('admin.application_settings.faq.tab-service', $data);
    }

    public function faqQuestion()
    {
        if (!Auth::user()->can('content_setting')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'FAQ Question & Answer';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavFAQSettingsActiveClass'] = 'mm-active';
        $data['faqQuestionActiveClass'] = 'active';
        $data['faqQuestions'] = FaqQuestion::all();

        return view('admin.application_settings.faq.question', $data);
    }

    public function faqQuestionUpdate(Request $request)
    {
        if (!Auth::user()->can('content_setting')) {
            abort('403');
        } // end permission checking

        $now = now();
        if ($request['question_answers']) {
            if (count(@$request['question_answers']) > 0) {
                foreach ($request['question_answers'] as $question_answers) {
                    if (@$question_answers['question']) {
                        if (@$question_answers['id']) {
                            $question_answer = FaqQuestion::find($question_answers['id']);
                        } else {
                            $question_answer = new FaqQuestion();
                        }
                        $question_answer->question = @$question_answers['question'];
                        $question_answer->answer = @$question_answers['answer'];
                        $question_answer->updated_at = $now;
                        $question_answer->save();
                    }
                }
            }
        }

        FaqQuestion::where('updated_at', '!=', $now)->get()->map(function ($q) {
            $q->delete();
        });

        $this->showToastrMessage('success', 'Updated Successful');
        return redirect()->back();
    }

    public function supportTicketCMS()
    {
        if (!Auth::user()->can('content_setting')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'Support Ticket CMS';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavSupportSettingsActiveClass'] = 'mm-active';
        $data['supportCMSSettingsActiveClass'] = 'active';

        return view('admin.application_settings.support_ticket.cms', $data);
    }

    public function supportTicketQuesAns()
    {
        $data['title'] = 'Support Ticket Question & Answer';
        $data['navApplicationSettingParentActiveClass'] = 'mm-active';
        $data['subNavSupportSettingsActiveClass'] = 'mm-active';
        $data['supportQuestionActiveClass'] = 'active';
        $data['supportTickets'] = SupportTicketQuestion::all();

        return view('admin.application_settings.support_ticket.question', $data);
    }

    public function supportTicketQuesAnsUpdate(Request $request)
    {
        $now = now();
        if ($request['question_answers']) {
            if (count(@$request['question_answers']) > 0) {
                foreach ($request['question_answers'] as $question_answers) {
                    if (@$question_answers['question']) {
                        if (@$question_answers['id']) {
                            $question_answer = SupportTicketQuestion::find($question_answers['id']);
                        } else {
                            $question_answer = new SupportTicketQuestion();
                        }
                        $question_answer->question = @$question_answers['question'];
                        $question_answer->answer = @$question_answers['answer'];
                        $question_answer->updated_at = $now;
                        $question_answer->save();
                    }
                }
            }
        }

        SupportTicketQuestion::where('updated_at', '!=', $now)->get()->map(function ($q) {
            $q->delete();
        });

        $this->showToastrMessage('success', 'Updated Successful');
        return redirect()->back();
    }
}
