<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class GetAnswersOfQuizByQuizIdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'traditional_quiz_id' => ['required', Rule::exists('traditional_quizzes', 'id')],
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'traditional_quiz_id.required' => 'يجب اختيار فحص تقليدي',
                'traditional_quiz_id.exists' => 'يجب أن يكون الفحص التقليدي موجود',

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
