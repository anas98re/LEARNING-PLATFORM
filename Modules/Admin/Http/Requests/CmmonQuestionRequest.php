<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class cmmonQuestionRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'question'=>'required',
            'answer'=>'required',
            'unit_id'=>'required',
            'lesson_id'=>'required',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
