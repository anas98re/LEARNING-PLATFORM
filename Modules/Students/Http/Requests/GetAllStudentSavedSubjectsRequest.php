<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class GetAllStudentSavedSubjectsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => 'required|integer|min:2|max:19'
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'limit.required' => 'يجب كتابة حدّ',
                'limit.integer' => 'يجب أن يكون الحدّ عدد صحيح',
                'limit.min' => 'يجب أن يكون الحد على الاقل 2',
                'limit.max' => 'يجب أن يكون الحد على الأكثر 19',
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
