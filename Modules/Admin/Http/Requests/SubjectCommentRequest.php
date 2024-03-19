<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectCommentRequest extends FormRequest
{

    public function rules()
    {
        return [
            'comment' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|exists:students,id',
            'transable' => 'required|boolean',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
