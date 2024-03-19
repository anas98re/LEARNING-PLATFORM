<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'points' => 'required|integer',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/quicktime|max:102400',
            'isFree' => 'required|boolean',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'requirements' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'transable' => 'required|boolean',

        ];
    }


    public function authorize()
    {
        return true;
    }
}
