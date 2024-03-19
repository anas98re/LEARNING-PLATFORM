<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class SubjectStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject_id' => 'required'
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'subject_id.required' => 'يجب اختيار مادة',
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
