<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class SubjectCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject_id' => 'required|exists:subjects,id',
            'comment' => 'required',
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'subject_id.required' => 'يجب اختيار مادة',
                'subject_id.exists' => ' يجب اختيار مادة موجودة',

                'comment.required' => 'يجب كتابة تعليق',

            ];
        }
        if (App::getLocale() == 'en') {
            return Parent::messages();
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
