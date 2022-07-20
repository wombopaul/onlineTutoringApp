<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;
use App\Tools\Repositories\Crud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use File;
use Auth;


class LanguageController extends Controller
{
    protected $model;

    public function __construct(Language $language)
    {
        $this->model = new Crud($language);
    }

    public function index()
    {
        if (!Auth::user()->can('manage_language')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'Manage Language';
        $data['languages'] = $this->model->all();
        return view('admin.language.index', $data);
    }

    public function create()
    {
        if (!Auth::user()->can('manage_language')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'Add Language';
        return view('admin.language.create', $data);
    }

    public function store(LanguageRequest $request)
    {
        if (!Auth::user()->can('manage_language')) {
            abort('403');
        } // end permission checking

        $language = new Language();
        $language->fill($request->all());
        $language->rtl = $request->rtl ? 1 : 0;
        if($request->hasFile('flag')){
            $language->flag = $request->flag->move('uploads/flag/', Str::random(40) . '.' . $request->flag->extension());;
        }
        $language->save();

        if(File::exists(base_path().'/resources/lang/'.$language->iso_code)) {
            toastrMessage('warning', 'Language Already Exists');
            return back();
        }else{

             File::makeDirectory(base_path().'/resources/lang/'.$language->iso_code);

            $base_path = base_path().'/resources/lang/en/app.php';
            $destination_path = base_path().'/resources/lang/'.$language->iso_code.'/app.php';
            File::copy($base_path, $destination_path);

            $base_path = base_path().'/resources/lang/en/message.php';
            $destination_path = base_path().'/resources/lang/'.$language->iso_code.'/message.php';
            File::copy($base_path, $destination_path);
        }

        toastrMessage('success', 'Language successfully added');
        return redirect()->route('language.translate', [$language->id]);
    }


    public function translateLanguage($id)
    {
        if (!Auth::user()->can('manage_language')) {
            abort('403');
        } // end permission checking

        $language = Language::findOrFail($id);

        $files = glob(base_path('resources/lang/' . $language->iso_code . '/*.php'));

        $language_array = [];

        foreach ($files as $file) {
            $name  = basename($file, '.php');
            $language_array[$name] = require $file;
        }

        return view('admin.language.translate',[
            'title' => 'Translate',
            'language' => $language,
            'language_array' => $language_array['app'],
        ]);
    }


    public function updateTranslate(Request $request, $id)
    {
        if (!Auth::user()->can('manage_language')) {
            abort('403');
        } // end permission checking

        $language =  Language::findOrFail($id);

        $inputs = Arr::except($request->all(), ['_token', 'language_id']);

        $elements = '';
        foreach ($inputs as $key => $value) {
            $elements .= "'".$key."' => '".$value."',\n";
        }

        /** ====== set lan ===== */
        $setArray = "<?php  return [".$elements."];";

        file_put_contents(base_path("resources/lang/".$language->iso_code."/app.php"), $setArray);
        /** ========= end ======== */
        toastrMessage('success', 'Save Successfully');
        return redirect()->back();
    }


    public function delete($id)
    {
        if (!Auth::user()->can('manage_language')) {
            abort('403');
        } // end permission checking

        if ($id == 1){
            toastrMessage('warning', 'You Cannot delete this language');
            return redirect()->back();
        }

        $lang =  Language::findOrFail($id);
        File::deleteDirectory(base_path().'/resources/lang/'.$lang->iso_code);
        $lang->delete();

        toastrMessage('success', 'Language successfully deleted');
        return redirect()->back();
    }


}
