<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class CreateStudentTraditionalQuizAnswersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lesson_id' => 'required',
            'image_answers.*' => 'required|image|mimes:jpeg,png,jpg,webp,gif,jfif',
        ];
    }


    public function messages()
    {
        if (App::getLocale() == 'ar') {

            return [
                'lesson_id.required' => 'يجب اختيار درس',
                'image_answers.*.required' => 'يجب اختيار ملفات الإجابة',
                'image_answers.*.image' => 'يجب أن تكون ملفات الإجابة عبارة صور',
                'image_answers.*.mimes' => 'يجب أن تكون لواحد الصور ضمن اللواحق التالية jpeg,png,jpg,webp,gif,jfif',
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
