<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StudentLessonQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'lesson_questions_id' => 'required|unique:student_lesson_questions|exists:lesson_questions,id',
            'option_id' => 'required',
        ];
    }


    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'student_id.required' => 'يجب اختيار طالب ',
                'student_id.exists' => 'يجب أن يكون الطالب موجود ',

                'lesson_questions_id.required' => 'يجب اختيار سؤال للدرس ',
                'lesson_questions_id.unique' => 'يجب أن يكون سؤال الدرس فريد',
                'lesson_questions_id.exists' => 'يجب أن يكون سؤال الدرس موجود',


                'option_id.required' => 'يجب وضع خيار ',
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
