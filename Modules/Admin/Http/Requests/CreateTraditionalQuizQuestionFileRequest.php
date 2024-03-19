<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class CreateTraditionalQuizQuestionFileRequest extends FormRequest
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
            'questions_files' => 'required|array|min:1',
            'questions_files.*' => 'required|file'
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'traditional_quiz_id.exists' => 'يجب اختيار امتحان تقليدي موجود',
                'traditional_quiz_id.required' => 'يجب اختيار امتحان تقليدي',
                'questions_files.required' => 'يجب اختيار ملف للاسئلة',
                'questions_files.file' => 'يجب اختيار ملف للأسئلة.',
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
