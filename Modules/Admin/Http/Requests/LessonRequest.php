<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'points' => 'required|integer',
            'description' => 'required',
            'isFree' => 'required|boolean',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'duration' => 'required|integer',
            'subject_id' => 'required|exists:subjects,id',
            'unit_id' => 'required|exists:units,id',
            'transable' => 'required|boolean',
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/quicktime|max:102400',
            'what_we_will_learn' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
