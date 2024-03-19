<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class RemoveLessonFromStudentSavedLessonsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lesson_id' => 'required|exists:lessons,id'
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'lesson_id.required' => 'يجب ارسال معرفة الدرس',
                'lesson_id.exists' => 'يجب أن يكون معرف الدرس موجود',

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
