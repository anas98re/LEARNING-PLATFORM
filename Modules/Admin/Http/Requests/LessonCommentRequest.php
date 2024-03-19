<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonCommentRequest extends FormRequest
{

    public function rules()
    {
        return [
            'comment' => 'required',
            'lesson_id' => 'required|exists:lessons,id',
            'student_id' => 'required|exists:students,id',
            'transable' => 'required|boolean',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
