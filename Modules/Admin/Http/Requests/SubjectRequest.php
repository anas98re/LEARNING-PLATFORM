<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{

    public function rules()
    {
        return [
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'points' => 'required|integer',
            'description' => 'required',
            'introductory_video' => 'required|mimetypes:video/avi,video/mpeg,video/quicktime|max:102400',
            'requirements' => 'required',
            'sub_section_id' => 'required',
            'transable' => 'required|boolean',
            'price' => 'required|integer',

        ];
    }


    public function authorize()
    {
        return true;
    }
}
