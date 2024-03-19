<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StudentAutomatedQuizQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'answers' => 'required',
            'answers.*.question_id' => 'required|unique:student_aqq,aqq_id|exists:automated_quiz_questions,id',
            'answers.*.option_id' => 'required|exists:aqq_options,id',
        ];
    }
    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'answers.required' => 'يجب وضع إجابة ',

                'answers.*.question_id.required' => 'يجب اختيار سؤال',
                'answers.*.question_id.unique' => 'يجب أن يكون السؤال فريد',
                'answers.*.question_id.exists' => 'يجب ان يكون السؤال موجود',


                'answers.*.option_id.required' => 'يجب أن تكون الخيارات موجودة',
                'answers.*.option_id.exists' => 'يجب أن تكون الخيارات موجودة',

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
