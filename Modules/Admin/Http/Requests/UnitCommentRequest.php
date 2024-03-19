<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class unitCommentRequest extends FormRequest
{

    public function rules()
    {
        return [
            'comment' => 'required',
            'unit_id' => 'required|exists:units,id',
            'student_id' => 'required|exists:students,id',
            'transable' => 'required|boolean',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
