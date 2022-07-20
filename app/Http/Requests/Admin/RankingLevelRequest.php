<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RankingLevelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:ranking_levels,name',
            'serial_no' => 'required|max:255|unique:ranking_levels,serial_no',
            'earning' => 'required',
            'student' => 'required',
            'badge_image' => 'mimes:png|file|max:2048'
        ];
    }
}
